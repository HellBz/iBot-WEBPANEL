<?php
define("IN_IBOT", true);
session_start();

include 'include/config.php';

include 'include/functions.php';
include 'include/headerinclude.php';
include 'include/header.php';

if(logged_in())
{
	header('Location: index.php ');
}
global $mysql;
$mysql = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if($mysql->connect_errno)
{
	header('Location: error.php?error=Błąd łączenia z bazą danych! ');
	exit;
}

if (isset($_POST['p_logowanie'])) 
{
    $login = $_POST["p_login"];
    $haslo = $_POST["p_haslo"];
    
    $login = addslashes($login);
    $haslo = addslashes($haslo);

    $haslo = md5($haslo);
    
    $result = $mysql->query("SELECT id, username FROM `ibot_users` WHERE username='" . $login . "' AND password='" . $haslo . "'");
    
    if ($result->num_rows == 0) 
    {
        $error = 'Niepoprawny login lub hasło.';
    } 
    else 
    {
        $informacja = $result->fetch_assoc();
        $_SESSION['username'] = $informacja['username'];
        $_SESSION['logged'] = true;
        header('Location: index.php ');
    }
    $result->close();
}

$mysql->close();


include 'pages/page-login.php';

include 'include/footer.php';
?>