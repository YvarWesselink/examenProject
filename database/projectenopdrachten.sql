-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 dec 2020 om 11:54
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
-- Tabelstructuur voor tabel `projectenopdrachten`
--

CREATE TABLE `projectenopdrachten` (
  `project_id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Status` text NOT NULL,
  `Opdracht` text NOT NULL,
  `AantalStudenten` text NOT NULL,
  `Opmerkingen` text NOT NULL,
  `UitvoeringsDagEnDatum` text NOT NULL,
  `active` int(1) NOT NULL,
  `LocatieAdresEnPlaatsVanUitvoering` text NOT NULL,
  `Deadline` text NOT NULL,
  `Budget` text NOT NULL,
  `AkkoordMetVoorwaarden` text NOT NULL,
  `InvoerDatum` text NOT NULL,
  `TakenVoorStudenten` text NOT NULL,
  `Tijd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `projectenopdrachten`
--
ALTER TABLE `projectenopdrachten`
  ADD PRIMARY KEY (`project_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `projectenopdrachten`
--
ALTER TABLE `projectenopdrachten`
  MODIFY `project_id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
