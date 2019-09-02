-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02 سبتمبر 2019 الساعة 15:12
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `schoolmanagement`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `address` text,
  `phone_number` text,
  `register_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- إرجاع أو استيراد بيانات الجدول `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `address`, `phone_number`, `register_date`) VALUES
(1, 'shaaban', 'shaaban@shaaban.com', '123123123', 'dar-el salam', '01125440068', '2017-04-11 22:00:00');

-- --------------------------------------------------------

--
-- بنية الجدول `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- إرجاع أو استيراد بيانات الجدول `book`
--

INSERT INTO `book` (`id`, `title`, `description`, `image`) VALUES
(1, ' red ridding hood', 'this is a beautiful story for a little girl called Leila with a bad wolf wants to kidnap her', '1491942318little_red_riding_hood_by_v3rc4-d76dz3r.jpg'),
(2, ' Ø³Ø§Ù… Ùˆ Ø§Ù„ÙØ§ØµÙˆÙ„ÙŠØ§Ø¡', 'ØªØ­ÙƒÙŠ Ù‚ØµØ© ÙˆÙ„Ø¯ ØµØºÙŠØ± ÙŠØ³Ù…Ù‰ Ø³Ø§Ù… Ù…Ø¹ Ù…ØºØ§Ù…Ø±Ø§ØªÙ‡ Ø­ÙˆÙ„ Ø´Ø¬Ø±Ø© Ø§Ù„ÙØ§ØµÙˆÙ„ÙŠØ§Ø¡', '1491765982sam.jpg'),
(3, ' spider-man', 'there was a man turn into a spider man .amazing adventure with spider-man should be read\r\nonly in our liberery', '1491776431spiderman.jpg');

-- --------------------------------------------------------

--
-- بنية الجدول `class_management`
--

CREATE TABLE IF NOT EXISTS `class_management` (
  `id_teacher` int(11) NOT NULL DEFAULT '0',
  `id_student` int(11) NOT NULL DEFAULT '0',
  `id_class_room` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_teacher`,`id_class_room`,`id_student`),
  KEY `id_student` (`id_student`),
  KEY `id_class_room` (`id_class_room`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `class_management`
--

INSERT INTO `class_management` (`id_teacher`, `id_student`, `id_class_room`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 4, 1),
(1, 5, 1),
(2, 6, 3),
(4, 6, 2),
(4, 7, 2),
(2, 8, 3),
(4, 8, 2),
(2, 9, 3),
(4, 9, 2),
(2, 10, 3),
(4, 10, 2);

-- --------------------------------------------------------

--
-- بنية الجدول `class_room`
--

CREATE TABLE IF NOT EXISTS `class_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- إرجاع أو استيراد بيانات الجدول `class_room`
--

INSERT INTO `class_room` (`id`, `name`) VALUES
(1, 'class A'),
(2, 'class B'),
(3, 'class C');

-- --------------------------------------------------------

--
-- بنية الجدول `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_date` text,
  `exam_duration` int(2) DEFAULT NULL,
  `grade` int(3) DEFAULT NULL,
  `id_teacher` int(11) DEFAULT NULL,
  `id_subject` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_teacher` (`id_teacher`),
  KEY `id_subject` (`id_subject`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- إرجاع أو استيراد بيانات الجدول `exam`
--

INSERT INTO `exam` (`id`, `exam_date`, `exam_duration`, `grade`, `id_teacher`, `id_subject`) VALUES
(1, '29/5/2017 : 9 am', 2, 60, 3, 2),
(2, '5/6/2017 : 9 am', 3, 60, 4, 4),
(3, '09/07/2017 : 02 pm', 2, 60, 4, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `exam_questions`
--

CREATE TABLE IF NOT EXISTS `exam_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `id_exam` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_exam` (`id_exam`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- إرجاع أو استيراد بيانات الجدول `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `title`, `answer`, `id_exam`) VALUES
(1, 'Chlorophyll is a naturally occurring chelate compound in which central metal is', 'magnesium', 1),
(2, 'Brass gets discoloured in air because of the presence of which of the following gases in air?', 'Hydrogen sulphide', 1),
(3, 'Which of the following is a non metal that remains liquid at room temperature?', 'Bromine', 1),
(4, 'Which of the following is used in pencils?', 'Graphite', 1),
(5, 'Which of the following metals forms an amalgam with other metals?', 'Mercury', 1),
(6, 'Chemical formula for water is', 'H2O', 1),
(7, 'The gas usually filled in the electric bulb is', 'nitrogen', 1),
(8, 'Washing soda is the common name for', 'Sodium carbonate', 1),
(9, 'Quartz crystals normally used in quartz clocks etc. is chemically', 'silicon dioxide', 1),
(10, 'Which of the gas is not known as green house gas?', 'Hydrogen', 1),
(11, 'Which of the following statements should be used to obtain a remainder after dividing 3.14 by 2.1 ?', 'rem = fmod(3.14, 2.1);', 2),
(12, 'What are the types of linkages?', 'External, Internal and None', 2),
(13, ' 	  Which of the following special symbol allowed in a variable name?', '_ (underscore)', 2),
(14, 'Is there any difference between following declarations? 1 : extern int fun(); 2 : int fun();', 'Both are identical', 2),
(15, 'How would you round off a value from 1.66 to 2.0?', 'ceil(1.66)', 2),
(16, 'By default a real number is treated as a', 'double', 2),
(17, 'Which of the following is not user defined data type? ', 'long int l = 2.35;', 2),
(18, 'Is the following statement a declaration or definition? extern int i;', 'Declaration', 2),
(19, ' 	  When we mention the prototype of a function?', 'Declaring', 2),
(20, 'the end of any line in c code almost be ?', ';', 2),
(21, '1+1=', '2', 3),
(22, '2+2=', '4', 3),
(23, '5/5=', '1', 3);

-- --------------------------------------------------------

--
-- بنية الجدول `exam_sitting`
--

CREATE TABLE IF NOT EXISTS `exam_sitting` (
  `id_exam` int(11) NOT NULL DEFAULT '0',
  `status` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_exam`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `exam_sitting`
--

INSERT INTO `exam_sitting` (`id_exam`, `status`) VALUES
(1, 0),
(2, 0),
(3, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `id_student` int(11) NOT NULL DEFAULT '0',
  `id_exam` int(11) NOT NULL DEFAULT '0',
  `grade` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_student`,`id_exam`),
  KEY `id_exam` (`id_exam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `grades`
--

INSERT INTO `grades` (`id_student`, `id_exam`, `grade`) VALUES
(1, 2, 10),
(1, 3, 2),
(2, 2, 8),
(8, 2, 8);

-- --------------------------------------------------------

--
-- بنية الجدول `manage_question_choices`
--

CREATE TABLE IF NOT EXISTS `manage_question_choices` (
  `id_question` int(11) NOT NULL DEFAULT '0',
  `choice` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_question`,`choice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `manage_question_choices`
--

INSERT INTO `manage_question_choices` (`id_question`, `choice`) VALUES
(11, 'rem = 3.14 % 2.1;'),
(11, 'rem = fmod(3.14, 2.1);'),
(11, 'rem = modf(3.14, 2.1);'),
(11, 'Remainder cannot be obtain in floating point division.'),
(12, 'External and None'),
(12, 'External, Internal and None'),
(12, 'Internal'),
(12, 'Internal and External'),
(13, '* (asterisk)'),
(13, '- (hyphen)'),
(13, '_ (underscore)'),
(13, '| (pipeline)'),
(14, 'Both are identical'),
(14, 'int fun(); is overrided with extern int fun();'),
(14, 'No difference, except extern int fun(); is probably in another file'),
(14, 'None of these'),
(15, 'ceil(1.66)'),
(15, 'floor(1.66)'),
(15, 'roundto(1.66)'),
(15, 'roundup(1.66)'),
(16, 'double'),
(16, 'far double'),
(16, 'float'),
(16, 'long double'),
(17, 'Both 1 and 2'),
(17, 'enum day {Sun, Mon, Tue, Wed};'),
(17, 'long int l = 2.35;'),
(17, 'struct book {     char name[10]; float price; int pages;};'),
(18, 'Declaration'),
(18, 'Definition'),
(18, 'Error'),
(18, 'Function'),
(19, 'Calling'),
(19, 'Declaring'),
(19, 'Defining'),
(19, 'Prototyping'),
(20, ','),
(20, '.'),
(20, ';'),
(20, 'end'),
(21, '1'),
(21, '2'),
(21, '3'),
(21, '5'),
(22, '2'),
(22, '4'),
(22, '5'),
(22, '8'),
(23, '0'),
(23, '1'),
(23, '2'),
(23, '5');

-- --------------------------------------------------------

--
-- بنية الجدول `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `address` text,
  `phone_number` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- إرجاع أو استيراد بيانات الجدول `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `password`, `address`, `phone_number`) VALUES
(1, 'reda karim', 'readakarim@reda.com', '123123123', 'Dar El-salam', '01111111111'),
(2, 'tamer ali', 'tamerali@tamer.com', '123123123', 'misr.st', '01111111111'),
(3, 'samir mohamed', 'samirmohamed@samir.com', '123123123', 'Dar El-salam', '01111111111'),
(4, 'ahmed khalid', 'ahmedkhalid@ahmed.com', '123123123', '9th-st.makatam', '01111111111'),
(5, 'kamel mohamed', 'kamelmohamed@kamel.com', '123123123', '12st-maadi-ciro', '01111111111'),
(6, 'alaa kamal', 'alaakamal@alaa.com', '123123123', '12st-maadi-ciro', '01111111111'),
(7, 'moharram ahmed', 'moharramahmed@g.com', '123123123', 'El obor-city', '01111111111'),
(8, 'mohsen ali', 'mohsenali@g.com', '123123123', 'Nasr-city', '01111111111'),
(9, 'salma hashim', 'salmahashim@g.com', '123123123', '6th.october-city', '01222222222'),
(10, 'mansor mohamed', 'mansot@g.com', '123123123', 'salah salem-st.', '01111111111');

-- --------------------------------------------------------

--
-- بنية الجدول `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- إرجاع أو استيراد بيانات الجدول `subject`
--

INSERT INTO `subject` (`id`, `name`) VALUES
(1, 'math'),
(2, 'science'),
(3, 'commerce'),
(4, 'programming language 1'),
(5, 'english');

-- --------------------------------------------------------

--
-- بنية الجدول `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `address` text,
  `phone_number` text,
  `register_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- إرجاع أو استيراد بيانات الجدول `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `email`, `password`, `address`, `phone_number`, `register_date`) VALUES
(1, 'akram mohameden', 'akrammohamed@akram.com', '123123123', 'Dar El-salam', '01111111111', NULL),
(2, 'tarek ahmed', 'arekahmed@tarek.com', '123123123', 'Dar El-salam', '01111111111', NULL),
(3, 'ali ahmed', 'aliahmed@ali.com', '123123123', 'omrania-Giza', '01111111111', NULL),
(4, 'gamila ali', 'gmila@gmalali.com', '123123123', 'Dar El-salam', '01111111111', NULL);

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `class_management`
--
ALTER TABLE `class_management`
  ADD CONSTRAINT `class_management_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `class_management_ibfk_2` FOREIGN KEY (`id_teacher`) REFERENCES `teacher` (`id`),
  ADD CONSTRAINT `class_management_ibfk_3` FOREIGN KEY (`id_class_room`) REFERENCES `class_room` (`id`);

--
-- القيود للجدول `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`id_teacher`) REFERENCES `teacher` (`id`),
  ADD CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id`);

--
-- القيود للجدول `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_ibfk_1` FOREIGN KEY (`id_exam`) REFERENCES `exam` (`id`);

--
-- القيود للجدول `exam_sitting`
--
ALTER TABLE `exam_sitting`
  ADD CONSTRAINT `exam_sitting_ibfk_1` FOREIGN KEY (`id_exam`) REFERENCES `exam` (`id`);

--
-- القيود للجدول `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`id_exam`) REFERENCES `exam` (`id`);

--
-- القيود للجدول `manage_question_choices`
--
ALTER TABLE `manage_question_choices`
  ADD CONSTRAINT `manage_question_choices_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `exam_questions` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
