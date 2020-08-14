<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}
global $lang, $mysql, $query, $settings;

load_lang(LANGUAGE);

$mysql = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if($mysql->connect_errno)
{
	header('Location: error.php?error=Błąd łączenia z bazą danych! ');
	exit;
}
$mysql->query("SET CHARSET utf8");
$mysql->query("SET NAMES `utf8` COLLATE `utf8_general_ci`");

$result = $mysql->query("SELECT * FROM `ibot_settings`");
if ($result->num_rows != 0)
{
	while ($row = $result->fetch_assoc())
	{
	   	$settings[$row['name']] = $row['value'];
	}
}
$result->close();

$query = new ts3admin($settings['ts3_host'], $settings['ts3_tcp']);
if($query->getElement('success', $query->connect()))
{
	$query->login($settings['ts3_loginquery'],$settings['ts3_passwordquery']);
    $query->selectServer($settings['ts3_udp']);
}

function load_lang($language)
{
	include 'language/'.$language.'.lang.php';
}

function getPluginName($urlplugin)
{
    return substr($urlplugin, 16, -4);
}

function createSettingsCategory($cat)
{
	global $mysql;
	$result = $mysql->query("INSERT INTO ibot_settinggroups (`name`, `title`, `description`, `isdefault`) VALUES ('".$cat['name']."', '".$cat['title']."', '".$cat['description']."', '".$cat['isdefault']."')");

	return getSettingsCategoryID($cat['name']);
}

function deleteSettingsCategory($name)
{
	global $mysql;
	$mysql->query("DELETE FROM ibot_settinggroups WHERE name = '".$name."'");
}

function getSettingsCategoryID($name)
{
	global $mysql;
	$result = $mysql->query("SELECT gid FROM ibot_settinggroups WHERE name = '".$name."' LIMIT 1");
	if ($result->num_rows != 0)
	{
		$row = $result->fetch_assoc();
		return $row['gid'];
	}
	return 0;
}

function getSettingsCategoryName($gid)
{
	global $mysql;
	$result = $mysql->query("SELECT title FROM ibot_settinggroups WHERE gid = '".$gid."' LIMIT 1");
	if ($result->num_rows != 0)
	{
		$row = $result->fetch_assoc();
		return $row['title'];
	}
}


function createSettings($setting)
{
	global $mysql;
	$result = $mysql->query("INSERT INTO ibot_settings (`name`, `title`, `description`, `optionscode`, `value`, `gid` , `selectlist`) 
							VALUES 	(
										'".switch_lang($setting,'name')."', 
										'".switch_lang($setting,'title')."', 
										'".switch_lang($setting,'description')."', 
										'".$setting['optionscode']."',
										'".$setting['value']."',
										'".$setting['gid']."',
										''
									)");

	return getSettingsID($setting['name']);
}

function deleteSettings($name)
{
	global $mysql;
	$mysql->query("DELETE FROM ibot_settings WHERE name = '".$name."'");
}

function getSettingsID($name)
{
	global $mysql;
	$result = $mysql->query("SELECT sid FROM ibot_settings WHERE name = '".$name."' LIMIT 1");
	if ($result->num_rows != 0)
	{
		$row = $result->fetch_assoc();
		return $row['sid'];
	}
	return 0;
}

function getInstalledPlugins()
{
	$list = array();
	foreach (glob("include/plugins/*.php") as $filename)
	{
		include_once $filename;
		$plugin_name = getPluginName($filename);
		$plugin_is_installed = $plugin_name."_is_installed";
		if($plugin_is_installed())
		{
			array_push($list, $plugin_name);
		}
	}
	return $list;
}

function getGroupName($grupa)
{
    global $query;
    $groups = $query->getElement('data', $query->serverGroupList());
    $groupname = '';
    foreach($groups as $group)
    {
        if ($group['sgid'] == $grupa)
        {
            $groupname = $group['name'];
        }
    }

    return $groupname;
}

function isInGroup($usergroups,$group) {
    $diff = count(array_diff($usergroups, $group));
    
    if ($diff < count($usergroups)) {
        return true;
    }
    else {
        return false;
    }
}


function switch_lang($array,$key)
{
    global $lang;
    
    $input = $array[$key];
    
	if ( is_array($input) ) {
                
        if ( array_key_exists( LANGUAGE ,$input) ){
            return $input[LANGUAGE];
        }else{
            if ( array_key_exists( 'en' ,$input) ){
                return $input['en'];
            }else{
                return str_replace("[key]",$key, $lang['plugins_key'] );
            }
        }
        
    }else{
        return $input;
    }
}
