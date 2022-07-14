-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: iun. 24, 2020 la 02:45 PM
-- Versiune server: 10.4.11-MariaDB
-- Versiune PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `test`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `doctorid` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `hour` varchar(10) NOT NULL,
  `more_info` text NOT NULL,
  `contactoption` varchar(20) NOT NULL,
  `verified` int(2) NOT NULL DEFAULT 0,
  `requested_time` datetime DEFAULT NULL,
  `confirmed_hour` varchar(20) DEFAULT NULL,
  `reviewed` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `appointments_results`
--

CREATE TABLE `appointments_results` (
  `id` int(11) NOT NULL,
  `appointmentID` int(11) NOT NULL,
  `diagnostic` text DEFAULT 'camp necompletat',
  `treatment` text NOT NULL DEFAULT 'camp necompletat',
  `recommandation` text NOT NULL DEFAULT 'camp necompletat',
  `next_appointment` text DEFAULT 'camp necompletat',
  `more_informations` text DEFAULT 'camp necompletat',
  `added_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `changemail`
--

CREATE TABLE `changemail` (
  `id` int(11) NOT NULL,
  `ChangeMailKey` varchar(255) NOT NULL DEFAULT '',
  `userid` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `used` int(11) NOT NULL,
  `expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `iplogs_panel`
--

CREATE TABLE `iplogs_panel` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `login_ip` varchar(15) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `creatorid` int(11) NOT NULL,
  `text` text NOT NULL,
  `dateadd` datetime NOT NULL DEFAULT current_timestamp(),
  `photo_path` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `link` varchar(200) DEFAULT NULL,
  `readed_notification` int(2) NOT NULL DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `panel_assets`
--

CREATE TABLE `panel_assets` (
  `ID` int(11) NOT NULL,
  `Name` varchar(512) NOT NULL,
  `Value` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `panel_logs`
--

CREATE TABLE `panel_logs` (
  `id` int(11) NOT NULL,
  `log` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `recover`
--

CREATE TABLE `recover` (
  `RecoverKey` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `timeexpire` int(11) NOT NULL,
  `done` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `reply_tickets`
--

CREATE TABLE `reply_tickets` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `text` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `hide` int(11) NOT NULL DEFAULT 0,
  `lastedit` int(11) NOT NULL,
  `lasteditby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `text` varchar(400) NOT NULL,
  `ratingValue` int(2) NOT NULL,
  `addedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` int(11) NOT NULL,
  `postedip` varchar(64) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nume` varchar(50) NOT NULL,
  `prenume` varchar(50) NOT NULL,
  `picture_path` varchar(250) NOT NULL DEFAULT 'default.jpg',
  `born_date` varchar(20) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `location` varchar(20) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  `adress` text DEFAULT NULL,
  `zipcode` varchar(7) DEFAULT NULL,
  `doctor` int(1) NOT NULL DEFAULT 0,
  `languages` varchar(50) NOT NULL DEFAULT '0|0|0|0',
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `doctor_type1` int(2) NOT NULL DEFAULT 0,
  `doctor_type2` int(11) NOT NULL DEFAULT 0,
  `doctor_type3` int(11) NOT NULL DEFAULT 0,
  `doctor_type4` int(11) NOT NULL DEFAULT 0,
  `devowner` int(1) NOT NULL DEFAULT 0,
  `rating_value` int(11) DEFAULT 0,
  `rating_number` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `validateuser`
--

CREATE TABLE `validateuser` (
  `id` int(11) NOT NULL,
  `ukey` varchar(200) NOT NULL,
  `used` int(1) NOT NULL DEFAULT 0,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `nume` varchar(50) NOT NULL,
  `prenume` varchar(50) NOT NULL,
  `regdate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `working_hours`
--

CREATE TABLE `working_hours` (
  `id` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `minute` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `doctorid` (`doctorid`);

--
-- Indexuri pentru tabele `appointments_results`
--
ALTER TABLE `appointments_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointmentID` (`appointmentID`);

--
-- Indexuri pentru tabele `changemail`
--
ALTER TABLE `changemail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexuri pentru tabele `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`),
  ADD KEY `ip_address` (`ip_address`);

--
-- Indexuri pentru tabele `iplogs_panel`
--
ALTER TABLE `iplogs_panel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexuri pentru tabele `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creatorid` (`creatorid`);

--
-- Indexuri pentru tabele `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexuri pentru tabele `panel_assets`
--
ALTER TABLE `panel_assets`
  ADD PRIMARY KEY (`ID`);

--
-- Indexuri pentru tabele `recover`
--
ALTER TABLE `recover`
  ADD PRIMARY KEY (`RecoverKey`);

--
-- Indexuri pentru tabele `reply_tickets`
--
ALTER TABLE `reply_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tid` (`tid`),
  ADD KEY `clientid` (`clientid`);

--
-- Indexuri pentru tabele `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctorID` (`doctorID`),
  ADD KEY `clientID` (`clientID`);

--
-- Indexuri pentru tabele `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `validateuser`
--
ALTER TABLE `validateuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `working_hours`
--
ALTER TABLE `working_hours`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `appointments_results`
--
ALTER TABLE `appointments_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `changemail`
--
ALTER TABLE `changemail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `iplogs_panel`
--
ALTER TABLE `iplogs_panel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `panel_assets`
--
ALTER TABLE `panel_assets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `reply_tickets`
--
ALTER TABLE `reply_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `validateuser`
--
ALTER TABLE `validateuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `working_hours`
--
ALTER TABLE `working_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`clientid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctorid`) REFERENCES `users` (`id`);

--
-- Constrângeri pentru tabele `appointments_results`
--
ALTER TABLE `appointments_results`
  ADD CONSTRAINT `appointments_results_ibfk_1` FOREIGN KEY (`appointmentID`) REFERENCES `appointments` (`id`);

--
-- Constrângeri pentru tabele `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`creatorid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constrângeri pentru tabele `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constrângeri pentru tabele `reply_tickets`
--
ALTER TABLE `reply_tickets`
  ADD CONSTRAINT `reply_tickets_ibfk_1` FOREIGN KEY (`clientid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reply_tickets_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `tickets` (`id`);

--
-- Constrângeri pentru tabele `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `users` (`id`);

--
-- Constrângeri pentru tabele `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`clientid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
