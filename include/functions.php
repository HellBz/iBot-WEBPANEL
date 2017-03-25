<?php
if(!defined("IN_IBOT"))
{
	die("Nie możesz tego wykonać.");
}
global $lang, $mysql, $query, $settings;

function logged_in()
{
	if(isset($_SESSION['username']) && isset($_SESSION['logged']))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function getStatus($url) 
{
    if(in_array('curl', get_loaded_extensions())) 
    {
        $curl = curl_init($url) ;
        curl_setopt( $curl, CURLOPT_URL , $url );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $source = curl_exec( $curl );
        curl_close( $curl );
    } 
    else 
    {
        $source = file_get_contents($url);
    }
    return $source;     
}