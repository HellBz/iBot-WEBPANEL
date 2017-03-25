<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}
global $lang, $mysql;
?>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">iBot Panel</a>
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if(logged_in())
                    {
                    ?>
                    <li>
                        <a href="index.php"><?php echo $lang['main_page']; ?></a>
                    </li>
                    <li>
                        <a href="index.php?settings"><?php echo $lang['settings_page']; ?></a>
                    </li>
                    <li>
                        <a href="index.php?plugins"><?php echo $lang['plugins_page']; ?></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang['account']; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="index.php?adduser"><?php echo $lang['acc_adduser']; ?></a>
                            </li>
                            <li>
                                <a href="index.php?userslist"><?php echo $lang['acc_listusers']; ?></a>
                            </li>
                            <li>
                                <a href="index.php?changepassword"><?php echo $lang['acc_changepass']; ?></a>
                            </li>
                            <li>
                                <a href="index.php?logout"><?php echo $lang['acc_logout']; ?></a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <li>
                        <a href="login.php"><?php echo $lang['acc_login']; ?></a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">