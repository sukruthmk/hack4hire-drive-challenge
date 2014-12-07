<?php
chdir(dirname(__FILE__).'/../');
require_once 'config.php';
require_once 'libs/Database/Database.php';
require_once 'Modules/DropBoxLogin.php';

$moduleInstance = new DropBoxLogin();

try {
    list($accessToken, $userId, $urlState) = $moduleInstance->getWebAuth()->finish($_GET);
    // We didn't pass in $urlState to finish, and we're assuming the session can't be
    // tampered with, so this should be null.
    assert($urlState === null);
}
catch (dbx\WebAuthException_BadRequest $ex) {
    respondWithError(400, "Bad Request");
    // Write full details to server error log.
    // IMPORTANT: Never show the $ex->getMessage() string to the user -- it could contain
    // sensitive information.
    error_log("/dropbox-auth-finish: bad request: " . $ex->getMessage());
    exit;
}
catch (dbx\WebAuthException_BadState $ex) {
    // Auth session expired.  Restart the auth process.
    header("Location: index.php?action=DropBoxLogin");
    exit;
}
catch (dbx\WebAuthException_Csrf $ex) {
    respondWithError(403, "Unauthorized", "CSRF mismatch");
    // Write full details to server error log.
    // IMPORTANT: Never show the $ex->getMessage() string to the user -- it contains
    // sensitive information that could be used to bypass the CSRF check.
    error_log("/dropbox-auth-finish: CSRF mismatch: " . $ex->getMessage());
    exit;
}
catch (dbx\WebAuthException_NotApproved $ex) {
    echo renderHtmlPage("Not Authorized?", "Why not?");
    exit;
}
catch (dbx\WebAuthException_Provider $ex) {
    error_log("/dropbox-auth-finish: unknown error: " . $ex->getMessage());
    respondWithError(500, "Internal Server Error");
    exit;
}
catch (dbx\Exception $ex) {
    error_log("/dropbox-auth-finish: error communicating with Dropbox API: " . $ex->getMessage());
    respondWithError(500, "Internal Server Error");
    exit;
}
$userInfo = $moduleInstance->getUserInfo($accessToken);
$email = $userInfo['email'];
if(!$moduleInstance->checkUserExits($userId, $email, 'dropbox')) {
    $db = Database::getInstance();
    $db->query('insert into drive_tokens(userid,access_token,source) values(?,?,?)', array($userId, $accessToken, 'dropbox'));
    $userInfo = $moduleInstance->getUserInfo($accessToken);
    $db->query('insert into drive_users(userid,name,email,source) values(?,?,?,?)', array($userId, $userInfo['display_name'], $userInfo['email'], 'dropbox'));
}

$_SESSION['login'] = true;
$_SESSION['userid'] = $userId;

require_once 'modules/DropBox.php';

directoryIterate();

function directoryIterate($path = '/') {
    $dropBox = new Dropbox();
    $data = $dropBox->getAllInFolder($path);
    
    foreach ($data as $directories) {
        if(empty($directories['is_dir'])) {
           $dropBox->updateTable($directories);
        } else {
            directoryIterate($directories['path']);
        }
    }
}

header("Location: ../index.php?action=Home");
?>
