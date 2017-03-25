<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

function autoregister_info()
{
	return array(
		"name"			=> "Automatyczna rejestracja",
		"description"	=> "Rejestruje użytkownika po X minutach.",
		"author"		=> "Piotr 'Inferno' Grencel",
		"authorsite"	=> "http://www.github.com/inferno211",
		"version"		=> "1.0",
		"interval"		=> array('days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 5)
	);
}

function autoregister_install()
{
	$setting_group = array(
		"name"			=> "autoregister_group",
		"title"			=> "Automatyczna rejestracja",
		"description"	=> "Ustawienia pluginu do automatycznej rejestracji",
		"isdefault"		=> 0
		);

	$gid = createSettingsCategory($setting_group);

	$setting = array(
		"name" => "autoregister_turnon",
		"title" => "Włączony",
		"description" => "Czy plugin ma być włączony?",
		"optionscode" => "onoff",
		"value" => "Reklama",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "autoregister_group",
		"title" => "Grupa",
		"description" => "Jaką grupę nadać gdy ma użytkownik zostać zarejestrowany?",
		"optionscode" => "servergroups",
		"value" => "6",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "autoregister_time",
		"title" => "Czas",
		"description" => "Po ilu minutach online rejestrować użytkownika?",
		"optionscode" => "numeric",
		"value" => "30",
		"gid" => $gid
		);
	createSettings($setting);
}

function autoregister_uninstall()
{
	deleteSettingsCategory("autoregister_group");
	deleteSettings("autoregister_turnon");
}

function autoregister_is_installed()
{
	if(getSettingsCategoryID("autoregister_group") == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function autoregister_core()
{
	global $query, $settings;
	if($settings['autoregister_turnon'])
	{
		$users = $query->getElement('data',$query->clientList('-groups -voice -away -times -uid'));
		foreach($users as $client)
		{
			$to_time = time();
	    	$from_time = $client['client_created'];
			$time = round(abs($to_time - $from_time) / 60,2);
			if($time > $settings['autoregister_time'])
			{
				$query->serverGroupAddClient($settings['autoregister_group'], $client['client_database_id']);
			}
	    }
	}
}