<?php 
ini_set('display_errors', 'On'); 
error_reporting(E_ALL);
define("IN_IBOT", true);
session_start();
date_default_timezone_set('Europe/Warsaw');
ini_set('default_charset', 'UTF-8');
setlocale(LC_ALL, 'UTF-8');

global $lang, $mysql, $query, $settings;

include 'include/config.php';
include 'include/ts3admin.class.php';

include 'include/core.php';

include 'include/functions.php';
include 'include/form.php';
include 'include/headerinclude.php';
include 'include/header.php';

if(!logged_in())
{
	header('Location: login.php ');
}
else
{
	$result = $mysql->query("SELECT * FROM `ibot_users` WHERE `username`='".$_SESSION['username']."'");
	if($result->num_rows == 0)
	{
		unset($_SESSION['username']);
		unset($_SESSION['logged']);
		session_destroy();
		header('Location: login.php ');
	}
}

if(isset($_GET['logout']))
{
	unset($_SESSION['username']);
	unset($_SESSION['logged']);
	session_destroy();
	header('Location: login.php ');
}

if(isset($_GET['settings']))
{
	include 'pages/page-settings.php';
}
else if(isset($_GET['addcategory']))
{
	include 'pages/page-addcategory.php';
}
else if(isset($_GET['addsetting']))
{
	include 'pages/page-addsetting.php';
}
else if(isset($_GET['editsettings']))
{
	include 'pages/page-editsettings.php';
}
else if(isset($_GET['usersonline']))
{
	include 'pages/page-usersonline.php';
}
else if(isset($_GET['plugins']))
{
	include 'pages/page-plugins.php';
}
else if(isset($_GET['adduser']))
{
	include 'pages/page-adduser.php';
}
else if(isset($_GET['userslist']))
{
	include 'pages/page-userslist.php';
}
else if(isset($_GET['changepassword']))
{
	include 'pages/page-changepassword.php';
}
else
{
	include 'pages/page-main.php';
}

include 'include/footer.php';
$mysql->close();
?>