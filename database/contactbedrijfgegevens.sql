-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 dec 2020 om 11:53
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examenopdracht`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contactbedrijfgegevens`
--

CREATE TABLE `contactbedrijfgegevens` (
  `Email` varchar(255) NOT NULL,
  `NaamOrganisatie` varchar(255) NOT NULL,
  `NaamContactPersoon` varchar(255) NOT NULL,
  `VasteTelefoon` varchar(255) NOT NULL,
  `Mobiel` varchar(255) NOT NULL,
  `StraatEnHuisNummer` varchar(255) NOT NULL,
  `Woonplaats` varchar(255) NOT NULL,
  `Postcode` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `contactbedrijfgegevens`
--
ALTER TABLE `contactbedrijfgegevens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `contactbedrijfgegevens`
--
ALTER TABLE `contactbedrijfgegevens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
