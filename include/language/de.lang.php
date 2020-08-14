<?php
if(!defined("IN_IBOT"))
{
    die("You can't do that.");
}
global $lang;

$lang['main_page'] = "Home page";
$lang['settings_page'] = "Settings";
$lang['plugins_page'] = "Plugins";

$lang['account'] = "Konto";
$lang['acc_adduser'] = "Add User";
$lang['acc_listusers'] = "List Users";
$lang['acc_changepass'] = "Change Password";
$lang['acc_logout'] = "Logout";
$lang['acc_login'] = "Login";

$lang['installed_plugins'] = "Installed Plugins";
$lang['bot_panel'] = "Bot's panel";
$lang['bot_panel_status'] = "Status";
$lang['bot_panel_start'] = "Start";
$lang['bot_panel_restart'] = "Restart";
$lang['bot_panel_stop'] = "Stop";
$lang['select_button'] = "Select Button";

$lang['like_me'] = "Like me on Facebook";

$lang['more_info'] = "More Information";
$lang['main_users'] = "Online Users";
$lang['main_channels'] = "Channels";
$lang['main_rekordonline'] = "Rekord online";
$lang['main_slots'] = "Slots";

$lang['page_main'] = "Main Page";
$lang['page_addcategory'] = "Add a category of settings";
$lang['page_addsettings'] = "Add a Setting";
$lang['page_login'] = "Login";
$lang['page_plginsettings'] = "Plugin Settings";
$lang['page_settings'] = "Bot Settings";

$lang['add'] = "Add";
$lang['back'] = "Back";

$lang['update_warning'] = "Warning!";
$lang['update_warning_desc'] = "Your bot version is outdated and it is recommended to update it. To download the latest version and find out how to upgrade your bot, go to <a href=\"http://inferno24.eu\">inferno24.eu</a>.";
$lang['update_success'] = "Congratulations!";
$lang['update_success_desc'] = "Your version of the bot is current. More information about the bot can be found under <a href=\"http://inferno24.eu\">inferno24.eu</a>.";

$lang['host'] = "Server Host";
$lang['host_desc'] = "Address to connect to the server";
$lang['udp'] = "Server Port";
$lang['udp_desc'] = "Specify the server port";
$lang['tcp'] = "Server query port";
$lang['tcp_desc'] = "Give server query port";
$lang['loginquery'] = "Login query";
$lang['loginquery_desc'] = "Enter login query to the server";
$lang['passwordquery'] = "The slogan query";
$lang['passwordquery_desc'] = "Enter the password query to the server";

$lang['addcategory'] = "Add a category of settings";
$lang['addsetting'] = "Add a setting";
$lang['pluginsettings'] = "Settings";

$lang['turnon'] = "Turn On";
$lang['turnoff'] = "Turn Off";

$lang['name_none'] = "No data in field <strong>Name in database</strong>.";
$lang['title_none'] = "No data in <strong>Name displayed in panel</strong>.";
$lang['desc_none'] = "No data in field <strong>Description displayed in panel</strong>.";
$lang['value_none'] = "No data in the <strong>value</strong> field.";
$lang['nazwasql_multiple'] = "This <strong>name in the database</strong> already exists.";
$lang['category_created'] = "The category has been created";

$lang['botname'] = "Bot's name";
$lang['botname_desc'] = "What's the name of the bot";
$lang['botchannel'] = "Bot Channel";
$lang['botchannel_desc'] = "The channel on which the bot is supposed to sit";

$lang['addcategory_codename'] = "Name in the database";
$lang['addcategory_codename_desc'] = "Enter the name of the category to which the settings will be assigned. Remember that this name should not contain any special characters, uppercase letters, spaces and Polish characters.";
$lang['addcategory_name'] = "Name displayed in the panel";
$lang['addcategory_name_desc'] = "Enter a name to be displayed here in the panel.";
$lang['addcategory_desc'] = "Description displayed in the panel";
$lang['addcategory_desc_desc'] = "Enter the category description that will be displayed in the panel.";
$lang['addcategory_default'] = "Default category";
$lang['addcategory_default_desc'] = "Whether the category is to be displayed as the main category or in the plugin settings";

$lang['addsetting_codename'] = "Name in the database<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_codename_desc'] = "Enter the name of the settings. Remember that the name should not contain any special characters, capital letters, spaces and Polish characters.";
$lang['addsetting_category'] = "Select a category<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_category_desc'] = "Select a category to which this setting will be assigned.";
$lang['addsetting_type'] = "Data type<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_type_desc'] = "Select the data type.";
$lang['addsetting_name'] = "Setting name<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_name_desc'] = "The name of the setting that will be displayed in their list.";
$lang['addsetting_desc'] = "Settings description<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_desc_desc'] = "A description of the settings that will be displayed in their list.";
$lang['addsetting_value'] = "Value<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_value_desc'] = "Enter the value that will be added after entering the setting.";
$lang['addsetting_selectlist'] = "Data for select";
$lang['addsetting_selectlist_desc'] = "The field is only relevant if you select the option \"Checkbox\" <br />E.g: 1=one,2=two,3=three";
$lang['addsetting_created'] = "The setting has been created and assigned to the selected category!";
$lang['settingname_multiple'] = "This <strong>name in the database</strong> already exists.";
$lang['required'] = "Fields marked with an asterisk are required.";
$lang['edit'] = "Edit";


$lang['type_text'] = "Regular Textfield";
$lang['type_numeric'] = "Numeric";
$lang['type_numericpm'] = "Numeric mit -/+";
$lang['type_textarea'] = "Textarea";
$lang['type_yesno'] = "Choice yes or no";
$lang['type_onoff'] = "Selection on or off";
$lang['type_select'] = "Checkbox";
$lang['type_radio'] = "Selection field for Radiobuttons";
$lang['type_checkbox'] = "Checkbox";
$lang['type_channels'] = "Dropdown with Channels";
$lang['type_servergroups'] = "Dropdown with Server Groups";
$lang['type_channelgroups'] = "Dropdown with Channel Groups";

$lang['codename_none'] = "No data in the field <strong>Name in the database</strong>.";
$lang['category_none'] = "No data in the field <strong>Select a category</strong>.";
$lang['type_none'] = "No data in the field <strong>Data type</strong>.";
$lang['name_none'] = "No data in the field <strong>Setting name</strong>.";

$lang['usersonline'] = "Online Users";
$lang['usersonline_login'] = "Login";
$lang['usersonline_id'] = "User-ID";
$lang['usersonline_channel'] = "Channel";
$lang['usersonline_ip'] = "IP";
$lang['usersonline_uid'] = "UID";
$lang['usersonline_created'] = "Created";
$lang['usersonline_functions'] = "Functions";
$lang['usersonline_status'] = "Status";

$lang['plugins'] = "Plug-ins";
$lang['plugins_name'] = "Plugin Name";
$lang['plugins_action'] = "Action";
$lang['plugins_autor'] = "Autor";
$lang['plugins_install'] = "Install";
$lang['plugins_uninstall'] = "Uninstall";
$lang['plugins_key'] = "Der \"<font color=\"red\"><strong>[key]</strong></font>\" Key ist nicht korrekt eingestellt.";

$lang['main_settings'] = "Main settings";
$lang['plugin_settings'] = "Plugin settings";
$lang['inputs'] = "Input";

$lang['no'] = "No";
$lang['yes'] = "Yes";

$lang['edit_settings'] = "Edit settings";

$lang['add_user_login'] = "Login";
$lang['add_user_login_desc'] = "Enter your user login";
$lang['add_user_login_none'] = "No login";

$lang['add_user_pass'] = "The password";
$lang['add_user_pass_desc'] = "Enter your password";
$lang['add_user_pass_none'] = "No password";

$lang['add_user_success'] = "User created successfully.";

$lang['old_pass'] = "The old password";
$lang['old_pass_desc'] = "Enter your old password";
$lang['old_pass_none'] = "No old password";
$lang['new_pass'] = "New password";
$lang['new_pass_desc'] = "Enter a new password";
$lang['new_pass_none'] = "No new password";
$lang['new_pass_reply'] = "Repeat the password";
$lang['new_pass_reply_desc'] = "Repeat your new password";
$lang['new_pass_reply_none'] = "No new password re-entering";

$lang['bad_old_pass'] = "Wrong current password!";
$lang['bad_reply'] = "The new passwords are not matching.";
$lang['change_pass_success'] = "Password successfully changed.";

$lang['delete_user_success'] = "User deleted successfully.";
$lang['delete_query'] = "The master user cannot be deleted.";

?>