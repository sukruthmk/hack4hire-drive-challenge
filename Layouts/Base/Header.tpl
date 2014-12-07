{include file="Layouts/Base/Resources.tpl"}
<!-- start navbar -->
<header>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="brand" href="#"></a>
                <ul class="nav navbar-nav">
                    <li {if $ACTION eq 'Home'} class="active" {/if}><a href="#">Home</a></li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li><a href="index.php?action=LogOut">LogOut</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<!--end navbar -->

