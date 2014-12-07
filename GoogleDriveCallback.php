<?php
require_once 'config.php';
require_once 'libs/Database/Database.php';
require_once 'Modules/GoogleDriveLogin.php';

$authCode = $_REQUEST['code'];
$moduleInstance = new GoogleDriveLogin();
$appConfig = $moduleInstance->getAppConfig();
$client = new Google_Client();
// Get your credentials from the console
$client->setClientId($appConfig['key']);
$client->setClientSecret($appConfig['secret']);
$client->setRedirectUri($appConfig['redirect']);
$client->setScopes(array('https://www.googleapis.com/auth/drive'));

$accessToken = $client->authenticate($authCode);
$client->setAccessToken($accessToken);
session_start();
$_SESSION['googletoken'] = $accessToken;
$_SESSION['login'] = true;

require_once 'modules/GoogleDrive.php';
$moduleInstance = new GoogleDrive();
$moduleInstance->deleteEntries();
$data = $moduleInstance->getAllFiles();
foreach ($data as $fileInfo) {
    $moduleInstance->updateTable($fileInfo);
}

header('Location: index.php?action=Home');

?>
