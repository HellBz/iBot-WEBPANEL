<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}
global $lang;

$lang['main_page'] = "Stronga Główna";
$lang['settings_page'] = "Ustawienia";
$lang['plugins_page'] = "Pluginy";

$lang['account'] = "Konto";
$lang['acc_adduser'] = "Dodaj użytkownika";
$lang['acc_listusers'] = "Lista użytkowników";
$lang['acc_changepass'] = "Zmień hasło";
$lang['acc_logout'] = "Wyloguj się";
$lang['acc_login'] = "Zaloguj się";

$lang['installed_plugins'] = "Zainstalowane pluginy";
$lang['bot_panel'] = "Panel Bota";
$lang['bot_panel_status'] = "Status";
$lang['bot_panel_start'] = "Start";
$lang['bot_panel_restart'] = "Restart";
$lang['bot_panel_stop'] = "Stop";
$lang['select_button'] = "Wybierz przycisk";

$lang['like_me'] = "Polub mnie na facebooku";

$lang['more_info'] = "Więcej informacji";
$lang['main_users'] = "Użytkowników online";
$lang['main_channels'] = "Kanałów";
$lang['main_rekordonline'] = "Rekord online";
$lang['main_slots'] = "Slotów";

$lang['page_main'] = "Stronga Główna";
$lang['page_addcategory'] = "Dodaj kategorię ustawień";
$lang['page_addsettings'] = "Dodaj ustawienie";
$lang['page_login'] = "Logowanie";
$lang['page_plginsettings'] = "Ustawienia pluginów";
$lang['page_settings'] = "Ustawienia bota";

$lang['add'] = "Dodaj";
$lang['back'] = "Wróć";

$lang['update_warning'] = "Uwaga!";
$lang['update_warning_desc'] = "Twoja wersja bota jest przestarzała i zaleca się jej aktualizację. Aby pobrać najnowszą wersję i dowiedzieć się jak przeprowadzić aktualizację, wejdź pod adres <a href=\"http://inferno24.eu\">inferno24.eu</a>.";
$lang['update_success'] = "Gratuluję!";
$lang['update_success_desc'] = "Twoja wersja bota jest aktualna. Więcej informacji o bocie znajdziesz pod <a href=\"http://inferno24.eu\">inferno24.eu</a>.";

$lang['host'] = "Host serwera";
$lang['host_desc'] = "Adres do łączenia się z serwerem";
$lang['udp'] = "Port serwera";
$lang['udp_desc'] = "Podaj port serwera";
$lang['tcp'] = "Port qurty serwera";
$lang['tcp_desc'] = "Podaj port query serwera";
$lang['loginquery'] = "Login query";
$lang['loginquery_desc'] = "Podaj login query do serwera";
$lang['passwordquery'] = "Hasło query";
$lang['passwordquery_desc'] = "Podaj hasło query do serwera";

$lang['addcategory'] = "Dodaj kategorię ustawień";
$lang['addsetting'] = "Dodaj ustawienie";
$lang['pluginsettings'] = "Ustawienia";

$lang['turnon'] = "Włączone";
$lang['turnoff'] = "Wyłączone";

$lang['name_none'] = "Brak danych w polu <strong>Nazwa w bazie danych</strong>.";
$lang['title_none'] = "Brak danych w polu <strong>Nazwa wyświetlana w panelu</strong>.";
$lang['desc_none'] = "Brak danych w polu <strong>Opis wyświetlany w panelu</strong>.";
$lang['value_none'] = "Brak danych w polu <strong>Wartość</strong>.";
$lang['nazwasql_multiple'] = "Taka <strong>nazwa w bazie danych</strong> już istnieje.";
$lang['category_created'] = "Kategoria została utworzona";

$lang['botname'] = "Nazwa bota";
$lang['botname_desc'] = "Jaką nazwę ma posiadać bot";
$lang['botchannel'] = "Kanał bota";
$lang['botchannel_desc'] = "Kanał na którym ma siedzieć bot";

$lang['addcategory_codename'] = "Nazwa w bazie danych";
$lang['addcategory_codename_desc'] = "Podaj nazwę kategori do której przypisane będą dane ustawienia. Pamiętaj by nazwa ta nie zawierała żadnych znaków specjalnych, wielkich liter, spacji i polskich znaków.";
$lang['addcategory_name'] = "Nazwa wyświetlana w panelu";
$lang['addcategory_name_desc'] = "Podaj nazwę jaka będzie wyświetlana tutaj w panelu.";
$lang['addcategory_desc'] = "Opis wyświetlany w panelu";
$lang['addcategory_desc_desc'] = "Podaj opis kategorii jaki będzie wyświetlany w panelu.";
$lang['addcategory_default'] = "Kategoria domyślna";
$lang['addcategory_default_desc'] = "Czy kategoria ma być wyświetlana jako główna, czy w ustawieniach pluginów";

$lang['addsetting_codename'] = "Nazwa w bazie danych<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_codename_desc'] = "Podaj nazwę ustawień. Pamiętaj by nazwa ta nie zawierała żadnych znaków specjalnych, wielkich liter, spacji i polskich znaków.";
$lang['addsetting_category'] = "Wybierz kategorię<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_category_desc'] = "Wybierz kategorię do której będzie przypisane to ustawienie.";
$lang['addsetting_type'] = "Typ danych<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_type_desc'] = "Wybierz typ danych.";
$lang['addsetting_name'] = "Nazwa ustawienia<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_name_desc'] = "Nazwa ustawienia która będzie wyświetlana na ich liście.";
$lang['addsetting_desc'] = "Opis ustawień<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_desc_desc'] = "Opis ustawień który będzie wyświetlany na ich liście.";
$lang['addsetting_value'] = "Wartość<font color=\"red\"><strong>*</strong></font>";
$lang['addsetting_value_desc'] = "Podaj wartość jaka będzie dodana po wpisaniu ustawienia.";
$lang['addsetting_selectlist'] = "Dane dla opcji select";
$lang['addsetting_selectlist_desc'] = "Pole ma znaczenie tylko, gdy wybierzesz opcję \"Pole wyboru\"<br />Np: 1=jeden,2=dwa,3=trzy";
$lang['addsetting_created'] = "Ustawienie zostało stworzone i przypisane do wybranej kategorii!";
$lang['settingname_multiple'] = "Taka <strong>nazwa w bazie danych</strong> już istnieje.";
$lang['required'] = "Pole oznaczone gwiazdką są wymagane.";
$lang['edit'] = "Edytuj";


$lang['type_text'] = "Regularne pole tekstowe";
$lang['type_numeric'] = "Liczba";
$lang['type_numericpm'] = "Numeryczny z -/+";
$lang['type_numericdu'] = "Interwał numeryczny";
$lang['type_textarea'] = "Pole tekstowe";
$lang['type_yesno'] = "Wybór tak lub nie";
$lang['type_onoff'] = "Wybór włączony lub wyłączony";
$lang['type_select'] = "Pole wyboru";
$lang['type_radio'] = "Pole wyboru okrągłych przycisków";
$lang['type_checkbox'] = "Pole wyboru bool";
$lang['type_channels'] = "Lista kanałów na TS3";
$lang['type_servergroups'] = "Lista grup serwerowych na TS3";
$lang['type_channelgroups'] = "Lista grup kanałowych na TS3";

$lang['codename_none'] = "Brak danych w polu <strong>Nazwa w bazie danych</strong>.";
$lang['category_none'] = "Brak danych w polu <strong>Wybierz kategorię</strong>.";
$lang['type_none'] = "Brak danych w polu <strong>Typ danych</strong>.";
$lang['name_none'] = "Brak danych w polu <strong>Nazwa ustawienia</strong>.";

$lang['usersonline'] = "Użytkownicy online";
$lang['usersonline_login'] = "Login";
$lang['usersonline_id'] = "ID użytkownika";
$lang['usersonline_channel'] = "Kanał";
$lang['usersonline_ip'] = "IP";
$lang['usersonline_uid'] = "UID";
$lang['usersonline_created'] = "Dołączył";
$lang['usersonline_functions'] = "Akcje";
$lang['usersonline_status'] = "Status";

$lang['plugins'] = "Wtyczki";
$lang['plugins_name'] = "Nazwa dodatku";
$lang['plugins_action'] = "Możliwości";
$lang['plugins_autor'] = "Autor";
$lang['plugins_install'] = "Zainstaluj";
$lang['plugins_uninstall'] = "Odinstaluj";

$lang['lang_key_miss'] = "\"<font color=\"red\"><strong>[key]</strong></font>\" Klucz nie jest prawidłowo ustawiony.";

$lang['main_settings'] = "Ustawienia bota";
$lang['plugin_settings'] = "Ustawienia pluginów";
$lang['inputs'] = "wpisów";

$lang['no'] = "Nie";
$lang['yes'] = "Tak";

$lang['edit_settings'] = "Edytuj ustawienia";

$lang['add_user_login'] = "Login";
$lang['add_user_login_desc'] = "Podaj login użytkownika";
$lang['add_user_login_none'] = "Brak loginu";

$lang['add_user_pass'] = "Hasło";
$lang['add_user_pass_desc'] = "Podaj hasło użytkownika";
$lang['add_user_pass_none'] = "Brak hasła";

$lang['add_user_success'] = "Użytkownik utworzony pomyślnie.";

$lang['old_pass'] = "Stare hasło";
$lang['old_pass_desc'] = "Podaj swoje stare hasło";
$lang['old_pass_none'] = "Brak starego hasła";
$lang['new_pass'] = "Nowe hasło";
$lang['new_pass_desc'] = "Podaj nowe hasło";
$lang['new_pass_none'] = "Brak nowego hasła";
$lang['new_pass_reply'] = "Powtórz hasło";
$lang['new_pass_reply_desc'] = "Powtórz swoje nowe hasło";
$lang['new_pass_reply_none'] = "Brak powtórnego wpisania nowego hasła";

$lang['bad_old_pass'] = "Złe aktualne hasło!";
$lang['bad_reply'] = "Nowe hasła nie są identyczne.";
$lang['change_pass_success'] = "Hasło zmienione pomyślnie.";

$lang['delete_user_success'] = "Użytkownik usunięty pomyślnie.";
$lang['delete_query'] = "Nie można skasować użytkownika głównego.";