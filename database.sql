-- phpMyAdmin SQL Dump
-- version 4.7.0-beta1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 25 Mar 2017, 14:00
-- Wersja serwera: 10.1.21-MariaDB-1~jessie
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `inferno24_test`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ibot_settinggroups`
--

CREATE TABLE `ibot_settinggroups` (
  `gid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `isdefault` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ibot_settinggroups`
--

INSERT INTO `ibot_settinggroups` (`gid`, `name`, `title`, `description`, `isdefault`) VALUES
(1, 'teamspeak3connect', 'Ustawienia łączenia z TeamSpeak3', 'Ustawienia danych do połączenia z TeamSpeak 3', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ibot_settings`
--

CREATE TABLE `ibot_settings` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `optionscode` varchar(255) NOT NULL,
  `selectlist` text NOT NULL,
  `value` varchar(255) NOT NULL,
  `gid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ibot_settings`
--

INSERT INTO `ibot_settings` (`sid`, `name`, `title`, `description`, `optionscode`, `selectlist`, `value`, `gid`) VALUES
(1, 'ts3_host', 'Host serwera TS3', 'Podaj host serwera TeamSpeak3', 'text', '', 'localhost', 1),
(2, 'ts3_tcp', 'Port TCP', 'Podaj port TCP serwera TS3', 'text', '', '10011', 1),
(3, 'ts3_udp', 'Port UDP', 'Podaj port UDP serwera TS3', 'text', '', '9987', 1),
(4, 'ts3_loginquery', 'Login query', 'Podaj login query serwera TS3', 'text', '', 'serveradmin', 1),
(5, 'ts3_passwordquery', 'Hasło query', 'Podaj hasło query serwera TS3', 'text', '', 'haslo', 1),
(6, 'bot_name', 'Nazwa bota', 'Podaj nazwę jaka będzie się wyświetlać na serwerze', 'text', '', 'iBot @ BOT', 1),
(7, 'bot_channel', 'Kanał bota', 'Kanał na którym będzie siedział bot.', 'channels', '', '100', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ibot_users`
--

CREATE TABLE `ibot_users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `query` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `ibot_users`
--

INSERT INTO `ibot_users` (`id`, `username`, `password`, `query`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `ibot_settinggroups`
--
ALTER TABLE `ibot_settinggroups`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `ibot_settings`
--
ALTER TABLE `ibot_settings`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `ibot_users`
--
ALTER TABLE `ibot_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ibot_settinggroups`
--
ALTER TABLE `ibot_settinggroups`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `ibot_settings`
--
ALTER TABLE `ibot_settings`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `ibot_users`
--
ALTER TABLE `ibot_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
