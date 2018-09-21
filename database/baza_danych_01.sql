-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Wrz 2018, 21:00
-- Wersja serwera: 10.1.35-MariaDB
-- Wersja PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `baza_danych_01`
--
CREATE DATABASE IF NOT EXISTS `baza_danych_01` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `baza_danych_01`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(32) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_polish_ci NOT NULL,
  `status` varchar(16) COLLATE utf8mb4_polish_ci DEFAULT 'unactive',
  `activation_key` varchar(32) COLLATE utf8mb4_polish_ci NOT NULL,
  `date_registration` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `password`, `email`, `status`, `activation_key`, `date_registration`) VALUES
(51, 'pokemon', '$2y$10$rAUWixG1P2g0hgRLd1K2C.ObkYIG91BT2j3r2/H4fv1ltvMwcwWES', 'przemekdab1993@gmail.com', 'active', '8b7feb3562795a67f6c93259b6548b7c', '2018-09-20 17:52:55');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
