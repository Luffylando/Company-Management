-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2018 at 02:49 AM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `kompanija`
--

CREATE TABLE `kompanija` (
  `kompanija_id` int(11) NOT NULL,
  `naziv_kompanije` varchar(255) NOT NULL,
  `grad` varchar(255) NOT NULL,
  `postanski_broj` int(11) NOT NULL,
  `zemlja` varchar(255) NOT NULL,
  `ziro_racun` varchar(255) NOT NULL,
  `pib` int(11) DEFAULT NULL,
  `kontakt_telefon` varchar(110) NOT NULL,
  `logo` text NOT NULL,
  `kontakt_osoba` text,
  `link_kompanije` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompanija`
--

INSERT INTO `kompanija` (`kompanija_id`, `naziv_kompanije`, `grad`, `postanski_broj`, `zemlja`, `ziro_racun`, `pib`, `kontakt_telefon`, `logo`, `kontakt_osoba`, `link_kompanije`) VALUES
(1, 'Filozofski Fakultet', 'Beograd', 11000, 'Srbija', '123456789', 2414, '011 333 555', '/Projekat/Assets/img/companyLogos/rb.png', 'Zoran Markovic\r\nTelefon: 064 4414 124\r\nemail: email@gmail.com', 'https://www.f.bg.ac.rs'),
(2, 'Fakultet Sporta', 'Novi sad', 22000, 'Srbija', '124012040', 42241, '011 2512 222', '/Projekat/Assets/img/companyLogos/l2.png', 'Marko Petrovic\r\ntel: 051251010\r\nmail: mare@gmail.com', 'https://www.fsfvns.rs/'),
(5, 'Tesla D. O. O.', 'Beograd', 11000, 'Srbija', '12041024', 1024, '011 4241 124', '/Projekat/Assets/img/companyLogos/l3.png', 'kontakt,...', 'http://www.google.com'),
(6, 'Fakultet Umetnosti', 'Zrenjanin', 20431, 'Srbija', '21401020014', 4911, '020 2151211', '/Projekat/Assets/img/companyLogos/l4.png', 'kontakt. ..', 'http://www.arts.bg.ac.rs/'),
(7, 'Kompanija I', 'Budva', 55122, 'Crna Gora', '2041041140', 241, '01512 21512', '/Projekat/Assets/img/companyLogos/l5.png', '...', 'http://www.google.com'),
(8, 'Kompanija II', 'Pirot', 52010, 'Srbija', '051025010', 12, '0150502515', '/Projekat/Assets/img/companyLogos/l1.png', 'asd', 'http://www.google.com'),
(9, 'Kompanija X', 'Leskovac', 2401204, 'Srbija', '2041012401', 2020, '0125102501', '/Projekat/Assets/img/companyLogos/l3.png', '...', 'http://www.google.com'),
(10, 'Saobracajni Fakultet', 'Beograd', 1100, 'Srbija', '12319249', 1243, '024150', '/Projekat/Assets/img/companyLogos/l5.png', '...', 'http://www.google.com'),
(11, 'Elektrotehnicki Fakultet', 'odoasod', 412421, 'Srbija', '243124', 412, '45125125', '/Projekat/Assets/img/companyLogos/l4.png', 'asdasd', 'http://www.google.com'),
(13, 'Matematicki Fakultet', 'ADAdsfaf', 11243, 'Srbija', '13245125', 55512, '125616671', '/Projekat/Assets/img/companyLogos/l3.png', 'asdasasddas', 'https://www.google.com'),
(14, 'Filoloski Fakultet', 'Beograd', 11000, 'Srbija', '2412401024', 12410, '064/224112', '/Projekat/Assets/img/companyLogos/l2.png', '...', 'https://www.google.com'),
(15, 'Kompanije III', 'Valjevo', 24000, 'Srbija', '301204210', 4124, '064/2141241', '/Projekat/Assets/img/companyLogos/l5.png', '...', 'http://www.google.com'),
(16, 'Kompanija IV', 'Beograd', 11000, 'Srbija', '024104214', 86786, '064/2425115', '/Projekat/Assets/img/companyLogos/rb.png', '...', 'https://www.google.com'),
(17, 'Kompanija V', 'Uzice', 21000, 'Srbija', '124012041', 4124, '011353533', '/Projekat/Assets/img/companyLogos/l1.png', '...\r\n', 'https://www.google.com'),
(25, 'BIGZ', 'Beograd', 11000, 'Srbija', '12401204', 210142, '0112501250', '/Projekat/Assets/img/companyLogos/rb.png', '...', 'https://www.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `korisnicko_ime` varchar(30) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(100) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `mobilni` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('Administrator','IT menadzer','Clan tima','Gost') NOT NULL DEFAULT 'Gost',
  `prihvacen` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `datum_rodjenja`, `mobilni`, `email`, `role`, `prihvacen`) VALUES
(1, 'Itachi', '$2y$10$YkUJ172Lof86As.93FN54.jAHxeKiKGQRJuJ/ME8aTvp2a.C1qJeW', 'Itachi', 'Uchiha', '1994-01-25', '060/4703999', 'antonije25.01.1994@gmail.com', 'Administrator', 1),
(2, 'Kant', '$2y$10$M5ORLkXZGt9akt.QFgCY2er8NKLIrQcnYDRWEyMhRJ1XY8nsY3ET.', 'Kant', 'Imanuel', '1724-02-24', '06621431222', 'kant@gmail.com', 'IT menadzer', 1),
(3, 'Hegel', '$2y$10$qne3Y6eVcy9LgO958bvNHehS4rWYUOVDLQFzPaBm9l7sF5EreS7nK', 'Vilhelm', 'Hegel', '1730-10-22', '061333555', 'hegel@filozofija.com', 'Clan tima', 1),
(8, 'Sher', '$2y$10$EdbTC7HfQ0L18siSFPokduPOZOvAjS5ZkDj9mPods1gK.h4B6ny6m', 'Sherlock', 'Holmes', '1981-02-25', '066612221', 'sher@gmail.com', 'Gost', 0),
(12, 'snow', '$2y$10$mibp.lIyyZ3FX0FBEGoMwOcnKkmhGuBI1Qx1oE6vG/zikf0.D/y1q', 'Dzon', 'Snow', '2009-01-09', '0642212452', 'snow@gmail.com', 'Clan tima', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `paket_id` int(11) UNSIGNED NOT NULL,
  `vrsta_paketa` enum('Novcani','Donatorski','Drugo') NOT NULL DEFAULT 'Novcani',
  `naziv_paketa` varchar(100) NOT NULL,
  `vrednost_paketa` int(11) DEFAULT NULL,
  `trajanje_paketa` tinyint(4) NOT NULL DEFAULT '1',
  `maksimalan_broj_paketa_u_god` smallint(6) NOT NULL DEFAULT '5',
  `opis_stavki_paketa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`paket_id`, `vrsta_paketa`, `naziv_paketa`, `vrednost_paketa`, `trajanje_paketa`, `maksimalan_broj_paketa_u_god`, `opis_stavki_paketa`) VALUES
(8, 'Novcani', 'Zlatni', 5000, 1, 5, '1.Logo kompanije\r\n2. 5 predavanja godisnje\r\n3. 5 oglasa godisnje\r\n4. Upotreba prostorija\r\n5. Reklamiranje\r\n6. Praksa\r\n'),
(9, 'Novcani', 'Srebrni', 3000, 1, 5, '1. Logo kompanije\r\n2. 4 predavanja godisnje\r\n3. 4 oglasa godisnje'),
(10, 'Novcani', 'Bronzani', 1500, 1, 5, '1. Logo kompanije\r\n2. 2predavanja godisnje\r\n3. 2oglasa godisnje\r\n'),
(11, 'Donatorski', 'Drugo', 0, 1, 5, 'Predmeti koji se doniraju.'),
(12, 'Drugo', 'Ostalo', 0, 1, 5, 'Vrednost paketa zavisice od ponude.');

-- --------------------------------------------------------

--
-- Table structure for table `poslovi`
--

CREATE TABLE `poslovi` (
  `poslovi_id` int(11) NOT NULL,
  `naziv_posla` varchar(255) NOT NULL,
  `naziv_kompanije` varchar(255) NOT NULL,
  `opis_posla` text NOT NULL,
  `datum_dodavanja` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poslovi`
--

INSERT INTO `poslovi` (`poslovi_id`, `naziv_posla`, `naziv_kompanije`, `opis_posla`, `datum_dodavanja`) VALUES
(22, 'Pomocnik u nastavi', 'Elektrotehnicki Fakultet', 'Drzanje vezbi dva puta nedeljno.', '2018-11-06 01:09:43'),
(23, 'Pomocnik u montazi', 'Kompanija II', 'Pruzanje pomoci dodeljenom majstoru.', '2018-11-06 01:09:43'),
(24, 'Junior programer', 'Kompanije III', 'Razvijanje softvera, ucenje i ucestvovanje na sastancima.', '2018-11-08 02:25:27'),
(25, 'Web developer', 'Kompanija V', 'Vodja development tima', '2018-11-08 02:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `predavanja`
--

CREATE TABLE `predavanja` (
  `predavanja_id` int(11) NOT NULL,
  `naziv_predavanja` varchar(255) NOT NULL,
  `naziv_kompanije` varchar(255) NOT NULL,
  `datum_predavanja` datetime NOT NULL,
  `opis_predavanja` text NOT NULL,
  `broj_sale` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `biografija` text,
  `slika` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `predavanja`
--

INSERT INTO `predavanja` (`predavanja_id`, `naziv_predavanja`, `naziv_kompanije`, `datum_predavanja`, `opis_predavanja`, `broj_sale`, `ime`, `prezime`, `biografija`, `slika`) VALUES
(22, 'Sokratov zivot', 'Filozofski Fakultet', '2018-11-15 10:00:00', 'Istorija zlatnog doba i Sokratovo ucenje.,,', 310, 'Irina', 'Deretic', 'bio...', NULL),
(23, 'Statistika i filozofija nauke', 'Filozofski Fakultet', '2018-11-28 14:00:00', 'Neintuitivni zakljucci savremene statistike...', 312, 'Eva', 'Kamerer', 'bio...', NULL),
(24, 'Astrofizika', 'Matematicki Fakultet', '2018-12-12 15:00:00', 'Razmatranje o Vaseljeni', 100, 'Milos', 'Zaovic', 'bios...', '...'),
(25, 'Zenonove Aporije', 'Filozofski Fakultet', '2019-10-10 12:00:00', 'Rasprava o vremenu i prostoru u Zenonovim aporijama', 300, 'Andrej', ' Jandric', 'bio', '...');

-- --------------------------------------------------------

--
-- Table structure for table `ugovori`
--

CREATE TABLE `ugovori` (
  `ugovori_id` int(11) UNSIGNED NOT NULL,
  `naziv_kompanije` varchar(255) NOT NULL,
  `vrsta_ugovora` enum('Novcani','Donatorski','Drugo') NOT NULL DEFAULT 'Novcani',
  `naziv_paketa` varchar(100) NOT NULL,
  `vrednost_ugovora` decimal(10,0) NOT NULL,
  `email` varchar(255) NOT NULL,
  `datum_sklapanja_ugovora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datum_isticanja_ugovora` datetime NOT NULL,
  `status_ugovora` enum('pripremljen','poslat kompaniji','potpisan od strane fakulteta','potpisan od strane kompanije','potpisan sa obe strane','predat arhivi fakulteta') NOT NULL DEFAULT 'pripremljen',
  `ugovor_sklopio` varchar(255) NOT NULL,
  `link_kompanije` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ugovori`
--

INSERT INTO `ugovori` (`ugovori_id`, `naziv_kompanije`, `vrsta_ugovora`, `naziv_paketa`, `vrednost_ugovora`, `email`, `datum_sklapanja_ugovora`, `datum_isticanja_ugovora`, `status_ugovora`, `ugovor_sklopio`, `link_kompanije`) VALUES
(1, 'Filozofski Fakultet', 'Novcani', 'Zlatni', '10000', 'filozofija@gmail.com', '2018-11-10 00:00:00', '2020-11-10 00:00:00', 'pripremljen', 'Itachi', 'http://www.f.bg.ac.rs'),
(2, 'Fakultet Sporta', 'Novcani', 'Srebrni', '3000', 'dif@gmail.com', '2018-11-06 01:30:27', '2018-12-06 01:30:27', 'pripremljen', 'Kant', 'https://www.fsfvns.rs/'),
(3, 'Tesla D. O. O.', 'Donatorski', 'Drugo', '5000', 'tesla@gmail.com', '2018-11-06 01:31:19', '2019-11-06 01:31:19', 'pripremljen', 'Hegel', 'http://www.google.com'),
(4, 'Saobracajni Fakultet', 'Novcani', 'Bronzani', '1500', 'saobracajni@gmail.com', '2018-11-06 01:32:35', '2019-11-06 01:32:35', 'poslat kompaniji', 'Itachi', 'http://www.sf.bg.ac.rs/index.php/sr-rs/\n\n'),
(5, 'Elektrotehnicki Fakultet', 'Drugo', 'Ostalo', '10200', 'etf@gmail.com', '2018-11-06 01:33:15', '2019-11-06 01:33:15', 'pripremljen', 'Kant', 'https://www.etf.bg.ac.rs/\n\n'),
(6, 'Matematicki Fakultet', 'Novcani', 'Bronzani', '2000', 'matematika@gmail.com', '2018-11-06 01:33:49', '2018-12-06 01:33:49', 'pripremljen', 'Hegel', 'http://www.matf.bg.ac.rs/\n\n'),
(7, 'Filoloski Fakultet', 'Donatorski', 'Drugo', '3500', 'fil@gmail.com', '2018-11-06 01:42:21', '2018-11-01 01:42:21', 'pripremljen', 'Kant', 'http://www.fil.bg.ac.rs/\n\n'),
(8, 'Kompanije III', 'Novcani', 'Bronzani', '3000', 'kompanija@gmai.com', '2018-11-06 01:42:54', '2018-12-06 01:42:54', 'pripremljen', 'Itachi', 'http://www.google.com'),
(9, 'Kompanija IV', 'Drugo', 'Ostalo', '9000', 'komp@gmail.com', '2018-11-06 01:43:17', '2019-11-06 01:43:17', 'pripremljen', 'Hegel', 'http://www.google.com'),
(10, 'Kompanija V', 'Novcani', 'Zlatni', '9000', 'k@gmail.com', '2018-11-06 01:43:39', '2018-09-06 01:43:39', 'poslat kompaniji', 'Itachi', 'http://www.google.com'),
(11, 'BIGZ', 'Novcani', 'Zlatni', '5000', 'bigz@gmail.com', '2018-11-06 11:46:41', '2019-11-06 11:46:41', 'pripremljen', 'Itachi', 'http://www.google.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kompanija`
--
ALTER TABLE `kompanija`
  ADD PRIMARY KEY (`kompanija_id`),
  ADD UNIQUE KEY `naziv_kompanije` (`naziv_kompanije`),
  ADD KEY `link_kompanije` (`link_kompanije`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`paket_id`),
  ADD KEY `vrsta_paketa` (`vrsta_paketa`);

--
-- Indexes for table `poslovi`
--
ALTER TABLE `poslovi`
  ADD PRIMARY KEY (`poslovi_id`),
  ADD UNIQUE KEY `naziv_kompanije` (`naziv_kompanije`);

--
-- Indexes for table `predavanja`
--
ALTER TABLE `predavanja`
  ADD PRIMARY KEY (`predavanja_id`),
  ADD KEY `FK_predavanjakompanija` (`naziv_kompanije`);

--
-- Indexes for table `ugovori`
--
ALTER TABLE `ugovori`
  ADD PRIMARY KEY (`ugovori_id`),
  ADD KEY `naziv_kompanije` (`naziv_kompanije`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kompanija`
--
ALTER TABLE `kompanija`
  MODIFY `kompanija_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `paket_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `poslovi`
--
ALTER TABLE `poslovi`
  MODIFY `poslovi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `predavanja`
--
ALTER TABLE `predavanja`
  MODIFY `predavanja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `ugovori`
--
ALTER TABLE `ugovori`
  MODIFY `ugovori_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `poslovi`
--
ALTER TABLE `poslovi`
  ADD CONSTRAINT `FK_poslovikompanija` FOREIGN KEY (`naziv_kompanije`) REFERENCES `kompanija` (`naziv_kompanije`);

--
-- Constraints for table `predavanja`
--
ALTER TABLE `predavanja`
  ADD CONSTRAINT `FK_predavanjakompanija` FOREIGN KEY (`naziv_kompanije`) REFERENCES `kompanija` (`naziv_kompanije`);

--
-- Constraints for table `ugovori`
--
ALTER TABLE `ugovori`
  ADD CONSTRAINT `FK_ugovorkomp` FOREIGN KEY (`naziv_kompanije`) REFERENCES `kompanija` (`naziv_kompanije`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
