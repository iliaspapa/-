-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 06 Ιουν 2019 στις 12:00:16
-- Έκδοση διακομιστή: 10.1.40-MariaDB
-- Έκδοση PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `yolo`
--

-- --------------------------------------------------------

--
-- Στημένη δομή για προβολή `all_about_books`
-- (Δείτε παρακάτω για την πραγματική προβολή)
--
CREATE TABLE `all_about_books` (
`ISBN` int(11)
,`title` text
,`pubYear` year(4)
,`numpages` int(11)
,`pubName` varchar(100)
,`AFirst` text
,`ALast` text
,`categoryName` varchar(100)
);

-- --------------------------------------------------------

--
-- Στημένη δομή για προβολή `all_categories`
-- (Δείτε παρακάτω για την πραγματική προβολή)
--
CREATE TABLE `all_categories` (
`categoryName` varchar(100)
);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `author`
--

CREATE TABLE `author` (
  `authID` int(11) NOT NULL,
  `AFirst` text NOT NULL,
  `ALast` text NOT NULL,
  `Abirthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `author`
--

INSERT INTO `author` (`authID`, `AFirst`, `ALast`, `Abirthdate`) VALUES
(2, 'ioannis', 'papadoganas', '1910-12-14'),
(3, 'hamid', 'nawab', '1930-06-17'),
(4, 'abraham', 'Silberschaz', '1960-07-17'),
(5, 'basiliki', 'kaluba', '1967-09-08'),
(6, 'mixalh', 'kormpos', '1956-04-03');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `belongs_to`
--

CREATE TABLE `belongs_to` (
  `ISBN` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `belongs_to`
--

INSERT INTO `belongs_to` (`ISBN`, `categoryName`) VALUES
(123333, 'mythology'),
(123441, 'physics'),
(123442, 'physics'),
(123443, 'physics'),
(123453, 'computer_science'),
(123455, 'physics'),
(123456, 'computer_science'),
(123457, 'academic'),
(123458, 'computer_science');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `book`
--

CREATE TABLE `book` (
  `ISBN` int(11) NOT NULL,
  `title` text NOT NULL,
  `pubYear` year(4) NOT NULL,
  `numpages` int(11) NOT NULL,
  `pubName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `book`
--

INSERT INTO `book` (`ISBN`, `title`, `pubYear`, `numpages`, `pubName`) VALUES
(123333, 'monsters', 1989, 1232, 'fountas'),
(123441, 'pedia_II', 1987, 234, 'tziola'),
(123442, 'pedia_III', 1988, 345, 'tziola'),
(123443, 'pedia_iv', 2018, 234, 'tziola'),
(123453, 'diakrita', 1999, 567, 'kleidarithmos'),
(123455, 'pedia_I', 1967, 345, 'tziola'),
(123456, 'baseis_dedomenwn', 2018, 129, 'giourda'),
(123457, 'leitourgika', 1999, 500, 'giourda'),
(123458, 'glosses_programmatismou', 2016, 498, 'ekdoseis kritis');

--
-- Δείκτες `book`
--
DELIMITER $$
CREATE TRIGGER `solve_book_update` BEFORE UPDATE ON `book` FOR EACH ROW BEGIN
set foreign_key_checks=0;
UPDATE copies set copies.ISBN=NEW.ISBN WHERE copies.ISBN=OLD.ISBN;
UPDATE borrows set borrows.ISBN=NEW.ISBN WHERE borrows.ISBN=OLD.ISBN;
UPDATE reminder set reminder.ISBN=NEW.ISBN WHERE reminder.ISBN=OLD.ISBN;
UPDATE belongs_to set belongs_to.ISBN=NEW.ISBN WHERE belongs_to.ISBN=OLD.ISBN;
UPDATE written_by set written_by.ISBN=NEW.ISBN WHERE written_by.ISBN=OLD.ISBN;
set foreign_key_checks=1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `borrows`
--

CREATE TABLE `borrows` (
  `memberID` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL,
  `copyNr` int(11) NOT NULL,
  `date_of_borrowing` date NOT NULL,
  `date_of_return` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `borrows`
--

INSERT INTO `borrows` (`memberID`, `ISBN`, `copyNr`, `date_of_borrowing`, `date_of_return`) VALUES
(3, 123441, 1, '2019-06-01', NULL),
(3, 123442, 1, '2019-04-10', '2019-06-04'),
(3, 123443, 1, '2019-05-05', '2019-06-05'),
(3, 123453, 1, '2019-05-28', '2019-06-01'),
(3, 123456, 1, '2019-05-28', '2019-06-01'),
(3, 123457, 1, '2019-06-01', NULL),
(3, 123458, 1, '2019-06-01', NULL),
(4, 123442, 1, '2019-06-05', NULL),
(4, 123456, 4, '2019-06-03', NULL),
(4, 123457, 1, '2019-02-28', '2019-06-01'),
(5, 123456, 3, '2019-06-01', NULL),
(5, 123456, 5, '2019-05-29', '2019-06-01'),
(6, 123453, 1, '2019-06-05', NULL);

--
-- Δείκτες `borrows`
--
DELIMITER $$
CREATE TRIGGER `set_reminder` AFTER INSERT ON `borrows` FOR EACH ROW INSERT INTO reminder (date_of_reminder,empID,ISBN,copyNr,memberID,date_of_borrowing) 
VALUES( 
    DATE_ADD( DATE_ADD(NEW.date_of_borrowing,INTERVAL 1 month) ,INTERVAL -1 day), 
    (SELECT empID FROM employee ORDER BY RAND() LIMIT 1),
    NEW.ISBN,
    NEW.copyNr,
    NEW.memberID,
    NEW.date_of_borrowing
    )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_reminder` AFTER UPDATE ON `borrows` FOR EACH ROW UPDATE reminder SET date_of_reminder=DATE_ADD( DATE_ADD(NEW.date_of_borrowing,INTERVAL 1 month) ,INTERVAL -1 day)
    WHERE ISBN=NEW.ISBN AND
    copyNr=NEW.copyNr AND
    memberID=NEW.memberID AND
    date_of_borrowing=NEW.date_of_borrowing
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `category`
--

CREATE TABLE `category` (
  `categoryName` varchar(100) NOT NULL,
  `supercategoryName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `category`
--

INSERT INTO `category` (`categoryName`, `supercategoryName`) VALUES
('academic', NULL),
('computer_science', NULL),
('ecomonics', NULL),
('mythology', NULL),
('maths', 'academic'),
('physics', 'academic');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `copies`
--

CREATE TABLE `copies` (
  `ISBN` int(11) NOT NULL,
  `copyNr` int(11) NOT NULL,
  `shelf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `copies`
--

INSERT INTO `copies` (`ISBN`, `copyNr`, `shelf`) VALUES
(123333, 1, 5),
(123441, 1, 8),
(123442, 1, 5),
(123443, 1, 5),
(123443, 2, 5),
(123443, 3, 5),
(123453, 1, 5),
(123453, 2, 5),
(123455, 1, 6),
(123456, 1, 1),
(123456, 2, 1),
(123456, 3, 1),
(123456, 4, 1),
(123456, 5, 1),
(123457, 1, 3),
(123458, 1, 2),
(123458, 2, 2),
(123458, 3, 2);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `employee`
--

CREATE TABLE `employee` (
  `empID` int(11) NOT NULL,
  `EFirst` text NOT NULL,
  `ELast` text NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `employee`
--

INSERT INTO `employee` (`empID`, `EFirst`, `ELast`, `salary`) VALUES
(1, 'Maria', 'Papanastasiou', 1000),
(2, 'Klisthenis', 'Rizoulis', 1500),
(3, 'Papagiwtis', 'Kitsios', 3000),
(4, 'Vaggelis', 'Ntouros', 1700),
(5, 'marios', 'dhmou', 1000),
(6, 'maria', 'komninou', 1256),
(7, 'nikos', 'kostopoulos', 2345),
(8, 'paraskeuas', 'georgiou', 2500),
(9, 'maria', 'naupliotou', 3000),
(10, 'eleutheria', 'papandreou', 2345),
(11, 'kostantinos', 'kostantinidis', 1234),
(12, 'aggeliki', 'kexagia', 1345);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `member`
--

CREATE TABLE `member` (
  `memberID` int(11) NOT NULL,
  `MFirst` text NOT NULL,
  `MLast` text NOT NULL,
  `Street` text NOT NULL,
  `number` int(11) NOT NULL,
  `postalCode` int(11) NOT NULL,
  `Mbirthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `member`
--

INSERT INTO `member` (`memberID`, `MFirst`, `MLast`, `Street`, `number`, `postalCode`, `Mbirthdate`) VALUES
(3, 'ilias', 'pap', 'agiaslauras', 11, 15239, '1998-06-17'),
(4, 'ethel', 'goul', 'likabitou', 11, 12345, '1998-12-31'),
(5, 'ioanna', 'papandreou', 'soutsou', 23, 16784, '1995-07-21'),
(6, 'xristina', 'gournari', 'mesogeiwn ', 123, 14235, '1992-03-05'),
(7, 'lambros', 'karanasos', 'agiou_georgiou', 31, 12345, '1989-08-09'),
(8, 'natalia', 'paxinou', 'brauronon', 45, 16789, '1999-07-05');

--
-- Δείκτες `member`
--
DELIMITER $$
CREATE TRIGGER `age_check` BEFORE INSERT ON `member` FOR EACH ROW IF NEW.MBirthdate>DATE_ADD(NOW(),INTERVAL -18 YEAR) THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "too young need to be over 18";
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `age_check_u` BEFORE UPDATE ON `member` FOR EACH ROW IF NEW.MBirthdate>DATE_ADD(NOW(),INTERVAL -18 YEAR) THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "too young need to be over 18";
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `permanent_employee`
--

CREATE TABLE `permanent_employee` (
  `empID` int(11) NOT NULL,
  `HiringDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `permanent_employee`
--

INSERT INTO `permanent_employee` (`empID`, `HiringDate`) VALUES
(1, '2019-01-08'),
(2, '2018-08-01'),
(5, '2017-10-24'),
(6, '2019-03-20'),
(7, '2018-10-23'),
(8, '2017-06-21'),
(9, '2019-04-09');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `publisher`
--

CREATE TABLE `publisher` (
  `pubName` varchar(100) NOT NULL,
  `estYear` year(4) NOT NULL,
  `street` text NOT NULL,
  `number` int(11) NOT NULL,
  `postalCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `publisher`
--

INSERT INTO `publisher` (`pubName`, `estYear`, `street`, `number`, `postalCode`) VALUES
('ekdoseis kritis', 1910, 'Manis', 5, 10681),
('fountas', 1950, 'hrakleiou', 3, 14752),
('giourda', 1920, 'zoodoxou pighs ', 23, 14567),
('kleidarithmos', 1967, 'pathsion', 147, 19742),
('tziola', 1980, 'filipou', 91, 54635);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `reminder`
--

CREATE TABLE `reminder` (
  `empID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL,
  `copyNr` int(11) NOT NULL,
  `date_of_borrowing` date NOT NULL,
  `date_of_reminder` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `reminder`
--

INSERT INTO `reminder` (`empID`, `memberID`, `ISBN`, `copyNr`, `date_of_borrowing`, `date_of_reminder`) VALUES
(1, 3, 123442, 1, '2019-04-10', '2019-05-09'),
(1, 3, 123457, 1, '2019-06-01', '2019-06-30'),
(1, 4, 123457, 1, '2019-02-28', '2019-03-27'),
(1, 5, 123456, 3, '2019-06-01', '2019-06-30'),
(2, 3, 123453, 1, '2019-05-28', '2019-06-27'),
(2, 3, 123456, 1, '2019-05-28', '2019-07-27'),
(2, 3, 123458, 1, '2019-06-01', '2019-06-30'),
(3, 3, 123441, 1, '2019-06-01', '2019-06-30'),
(4, 3, 123443, 1, '2019-05-05', '2019-06-04'),
(4, 4, 123456, 4, '2019-06-03', '2019-07-02'),
(4, 5, 123456, 5, '2019-05-29', '2019-06-28'),
(10, 4, 123442, 1, '2019-06-05', '2019-07-04'),
(12, 6, 123453, 1, '2019-06-05', '2019-07-04');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `temporary_employee`
--

CREATE TABLE `temporary_employee` (
  `empID` int(11) NOT NULL,
  `ContractNr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `temporary_employee`
--

INSERT INTO `temporary_employee` (`empID`, `ContractNr`) VALUES
(3, 123),
(4, 125),
(10, 124),
(11, 126),
(12, 127);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `written_by`
--

CREATE TABLE `written_by` (
  `ISBN` int(11) NOT NULL,
  `authID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `written_by`
--

INSERT INTO `written_by` (`ISBN`, `authID`) VALUES
(123333, 4),
(123441, 2),
(123442, 4),
(123443, 2),
(123453, 2),
(123453, 3),
(123455, 3),
(123456, 3),
(123456, 5),
(123457, 3),
(123458, 3);

-- --------------------------------------------------------

--
-- Δομή για προβολή `all_about_books`
--
DROP TABLE IF EXISTS `all_about_books`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_about_books`  AS  select `b`.`ISBN` AS `ISBN`,`b`.`title` AS `title`,`b`.`pubYear` AS `pubYear`,`b`.`numpages` AS `numpages`,`b`.`pubName` AS `pubName`,`a`.`AFirst` AS `AFirst`,`a`.`ALast` AS `ALast`,`bt`.`categoryName` AS `categoryName` from (((`book` `b` join `written_by` `wb`) join `belongs_to` `bt`) join `author` `a`) where ((`b`.`ISBN` = `wb`.`ISBN`) and (`b`.`ISBN` = `bt`.`ISBN`) and (`wb`.`authID` = `a`.`authID`)) ;

-- --------------------------------------------------------

--
-- Δομή για προβολή `all_categories`
--
DROP TABLE IF EXISTS `all_categories`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_categories`  AS  select `category`.`categoryName` AS `categoryName` from `category` WITH CASCADED CHECK OPTION ;

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authID`),
  ADD KEY `authors` (`AFirst`(100),`ALast`(100));

--
-- Ευρετήρια για πίνακα `belongs_to`
--
ALTER TABLE `belongs_to`
  ADD PRIMARY KEY (`ISBN`,`categoryName`),
  ADD KEY `belongs_to_ibfk_2` (`categoryName`);

--
-- Ευρετήρια για πίνακα `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `book_ibfk_1` (`pubName`),
  ADD KEY `books` (`ISBN`,`title`(100));

--
-- Ευρετήρια για πίνακα `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`memberID`,`ISBN`,`copyNr`,`date_of_borrowing`),
  ADD KEY `borrows_ibfk_3` (`ISBN`,`copyNr`);

--
-- Ευρετήρια για πίνακα `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryName`),
  ADD KEY `supercategoryName` (`supercategoryName`);

--
-- Ευρετήρια για πίνακα `copies`
--
ALTER TABLE `copies`
  ADD PRIMARY KEY (`ISBN`,`copyNr`);

--
-- Ευρετήρια για πίνακα `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`);

--
-- Ευρετήρια για πίνακα `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`);

--
-- Ευρετήρια για πίνακα `permanent_employee`
--
ALTER TABLE `permanent_employee`
  ADD PRIMARY KEY (`empID`);

--
-- Ευρετήρια για πίνακα `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`pubName`);

--
-- Ευρετήρια για πίνακα `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`empID`,`memberID`,`ISBN`,`copyNr`,`date_of_borrowing`,`date_of_reminder`),
  ADD KEY `reminder_ibfk_4` (`ISBN`,`copyNr`),
  ADD KEY `reminder_ibfk_5` (`memberID`,`ISBN`,`copyNr`,`date_of_borrowing`);

--
-- Ευρετήρια για πίνακα `temporary_employee`
--
ALTER TABLE `temporary_employee`
  ADD PRIMARY KEY (`empID`);

--
-- Ευρετήρια για πίνακα `written_by`
--
ALTER TABLE `written_by`
  ADD PRIMARY KEY (`ISBN`,`authID`),
  ADD KEY `written_by_ibfk_2` (`authID`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `author`
--
ALTER TABLE `author`
  MODIFY `authID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT για πίνακα `employee`
--
ALTER TABLE `employee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT για πίνακα `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `belongs_to`
--
ALTER TABLE `belongs_to`
  ADD CONSTRAINT `belongs_to_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `belongs_to_ibfk_2` FOREIGN KEY (`categoryName`) REFERENCES `category` (`categoryName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`pubName`) REFERENCES `publisher` (`pubName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrows_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrows_ibfk_3` FOREIGN KEY (`ISBN`,`copyNr`) REFERENCES `copies` (`ISBN`, `copyNr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`supercategoryName`) REFERENCES `category` (`categoryName`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Περιορισμοί για πίνακα `copies`
--
ALTER TABLE `copies`
  ADD CONSTRAINT `copies_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `permanent_employee`
--
ALTER TABLE `permanent_employee`
  ADD CONSTRAINT `permanent_employee_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `reminder`
--
ALTER TABLE `reminder`
  ADD CONSTRAINT `reminder_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reminder_ibfk_2` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reminder_ibfk_3` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reminder_ibfk_4` FOREIGN KEY (`ISBN`,`copyNr`) REFERENCES `copies` (`ISBN`, `copyNr`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reminder_ibfk_5` FOREIGN KEY (`memberID`,`ISBN`,`copyNr`,`date_of_borrowing`) REFERENCES `borrows` (`memberID`, `ISBN`, `copyNr`, `date_of_borrowing`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `temporary_employee`
--
ALTER TABLE `temporary_employee`
  ADD CONSTRAINT `temporary_employee_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `written_by`
--
ALTER TABLE `written_by`
  ADD CONSTRAINT `written_by_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `written_by_ibfk_2` FOREIGN KEY (`authID`) REFERENCES `author` (`authID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
