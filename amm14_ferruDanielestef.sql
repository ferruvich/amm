-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Set 03, 2014 alle 11:06
-- Versione del server: 5.5.35
-- Versione PHP: 5.4.6-1ubuntu1.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `amm14_ferruDanieleStef`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `compratore`
--

CREATE TABLE IF NOT EXISTS `compratore` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cognome` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `citta` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `via` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cap` int(11) DEFAULT NULL,
  `provincia` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ncivico` int(11) DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `compratore`
--

INSERT INTO `compratore` (`id`, `nome`, `cognome`, `email`, `citta`, `via`, `cap`, `provincia`, `ncivico`, `username`, `password`) VALUES
(1, 'Nessun', 'Compratore', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Daniele', 'Ferru', 'ferruvich@gmail.com', 'Sestu', 'Loc Marginarbu', 90205, 'Cagliari', 6, 'ferruvich', 'compratore');

-- --------------------------------------------------------

--
-- Struttura della tabella `console`
--

CREATE TABLE IF NOT EXISTS `console` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `console`
--

INSERT INTO `console` (`id`, `nome`) VALUES
(1, 'XBOX360'),
(2, 'PS3'),
(3, 'XBOX ONE'),
(4, 'PS4'),
(5, 'PS Vita'),
(6, 'PC'),
(7, 'Wii U');

-- --------------------------------------------------------

--
-- Struttura della tabella `copia`
--

CREATE TABLE IF NOT EXISTS `copia` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idvideogioco` bigint(20) unsigned NOT NULL,
  `idvenditore` bigint(20) unsigned NOT NULL,
  `idcompratore` bigint(20) unsigned NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `copia_video_fk` (`idvideogioco`),
  KEY `copia_venditore_fk` (`idvenditore`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Rappresenta una copia singola di un videogioco' AUTO_INCREMENT=19 ;

--
-- Dump dei dati per la tabella `copia`
--

INSERT INTO `copia` (`id`, `idvideogioco`, `idvenditore`, `idcompratore`) VALUES
(13, 7, 1, 2),
(14, 8, 1, 2),
(15, 12, 1, 1),
(16, 7, 1, 1),
(17, 12, 1, 1),
(18, 11, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `genere`
--

CREATE TABLE IF NOT EXISTS `genere` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `genere`
--

INSERT INTO `genere` (`id`, `nome`) VALUES
(1, 'FPS'),
(2, 'Survival Horror'),
(3, 'Azione'),
(4, 'GDR'),
(5, 'Casual'),
(6, 'Indie'),
(7, 'Simulatore'),
(8, 'Picchiaduro');

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore`
--

CREATE TABLE IF NOT EXISTS `venditore` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cognome` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(35) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `citta` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `via` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cap` varchar(5) NOT NULL,
  `provincia` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ncivico` int(11) NOT NULL,
  `username` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `venditore`
--

INSERT INTO `venditore` (`id`, `nome`, `cognome`, `email`, `citta`, `via`, `cap`, `provincia`, `ncivico`, `username`, `password`) VALUES
(1, 'Andrea', 'Fenu', 'anfen@gmail.com', 'Capoterra', 'Via Verdi', '09030', 'Cagliari', 3, 'anfen', 'venditore');

-- --------------------------------------------------------

--
-- Struttura della tabella `videogiochi`
--

CREATE TABLE IF NOT EXISTS `videogiochi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `titolo` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `anno` int(11) DEFAULT NULL,
  `trama` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `prezzo` decimal(6,2) DEFAULT NULL,
  `idgenere` bigint(20) unsigned NOT NULL,
  `idconsole` bigint(20) unsigned NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `idgenere` (`idgenere`),
  KEY `idconsole` (`idconsole`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dump dei dati per la tabella `videogiochi`
--

INSERT INTO `videogiochi` (`id`, `titolo`, `anno`, `trama`, `prezzo`, `idgenere`, `idconsole`) VALUES
(7, 'Borderlands', 2008, 'Investi i panni di un cacciatore della cripta! Fantastico FPS/GDR! Da giocare!', 15.00, 1, 6),
(8, 'Borderlands 2', 2010, 'Un gioco assolutamente da provare! Seguito del grande Borderlands', 40.00, 4, 6),
(11, 'Dead Space', 2008, 'Un gioco terrificante, claustrofobico, assolutamente da giocare', 15.00, 2, 2),
(12, 'Dead Space 2', 2010, 'Straordinario Seguito del grandissimo successo Dead Space!', 30.00, 2, 6);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `copia`
--
ALTER TABLE `copia`
  ADD CONSTRAINT `Copia_ibfk_1` FOREIGN KEY (`idvideogioco`) REFERENCES `videogiochi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Copia_ibfk_2` FOREIGN KEY (`idvenditore`) REFERENCES `venditore` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `videogiochi`
--
ALTER TABLE `videogiochi`
  ADD CONSTRAINT `videogiochi_ibfk_2` FOREIGN KEY (`idgenere`) REFERENCES `genere` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `videogiochi_ibfk_4` FOREIGN KEY (`idconsole`) REFERENCES `console` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
