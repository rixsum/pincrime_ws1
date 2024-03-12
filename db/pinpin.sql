-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 04:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinpin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `email`, `username`, `password`) VALUES
(1, 'master@gmail.com', 'master', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `citizens`
--

CREATE TABLE `citizens` (
  `citizenID` int(11) NOT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `lname` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) DEFAULT NULL,
  `street_add` varchar(50) DEFAULT NULL,
  `barangay_add` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `civilstat` varchar(8) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `ban` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizens`
--

INSERT INTO `citizens` (`citizenID`, `pic`, `lname`, `fname`, `mname`, `street_add`, `barangay_add`, `age`, `gender`, `civilstat`, `phone`, `email`, `username`, `password`, `ban`) VALUES
(3, 'images/profile_pics/citizen/Aesthethic Denji.jpg', 'Sumait', 'Janrix', 'Joseph', 'Fidel Ramos St', 'Dilan-Paurido', 21, 'Male', 'Single', '09345345345', 'janrix@gmail.com', 'Janrix', '123456', 'No'),
(4, 'images/profile_pics/citizen/Chainsaw Man Ripped.jpg', 'Dogman', 'Denji', 'Saw', 'McArthur Highway', 'Anonas', 22, 'Male', 'Single', '09345353453', 'denji@gmail.com', 'Denji99', '123', 'No'),
(5, 'images/profile_pics/citizen/thorfinn.png', 'Lodi', 'Idolo', 'Master', 'Honeymoon Road', 'Dilan-Paurido', 24, 'Male', 'Single', '09456546456', 'lods@gmail.com', 'idolo', '000', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `citizen_comments`
--

CREATE TABLE `citizen_comments` (
  `cit_commentID` int(11) NOT NULL,
  `reportID` int(11) NOT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `citizenID` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen_comments`
--

INSERT INTO `citizen_comments` (`cit_commentID`, `reportID`, `pic`, `username`, `citizenID`, `comment`, `date`) VALUES
(7, 2, 'images/profile_pics/citizen/Chainsaw Man Ripped.jpg', 'Denji99', 4, 'Sarap ipukpok sa bato', '2023-12-12 16:26:45'),
(8, 5, 'images/profile_pics/citizen/Chainsaw Man Ripped.jpg', 'Denji99', 4, 'Ay oo kita namin gising pa ng gabi yung matandang yun, sabi nagkatay lang daw ng manok may dala siyang itak', '2023-12-12 16:28:55'),
(13, 5, 'images/profile_pics/citizen/Aesthethic Denji.jpg', 'Janrix', 3, 'Nakakalungkot po ang nangyari. Condolence po.', '2023-12-12 16:50:21'),
(16, 6, 'images/profile_pics/citizen/Chainsaw Man Ripped.jpg', 'Denji99', 4, 'Kita ko nanakaw na kotse mo', '2023-12-13 13:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `police`
--

CREATE TABLE `police` (
  `policeID` int(11) NOT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `lname` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) DEFAULT NULL,
  `street_add` varchar(50) DEFAULT NULL,
  `barangay_add` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `civilstat` varchar(8) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `division` varchar(60) NOT NULL,
  `rank` varchar(60) NOT NULL,
  `badgeID` varchar(6) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `police`
--

INSERT INTO `police` (`policeID`, `pic`, `lname`, `fname`, `mname`, `street_add`, `barangay_add`, `age`, `gender`, `civilstat`, `phone`, `email`, `division`, `rank`, `badgeID`, `password`) VALUES
(1, 'images/profile_pics/police/𝐆𝐮𝐧 𝐃𝐞𝐯𝐢𝐥.jpg', 'Sumanao', 'Bata', 'Nga', '60 Ramos', 'Consolacion', 20, 'Male', 'Married', '09123456999', 'suma@gmail.com', 'Intelligence Group (IG)', 'Police General (PGEN)', '102334', '1234'),
(2, 'images/profile_pics/police/cardo.jpg', 'Dalisay', 'Cardo', 'Poe', '23 Sison St', 'Bayaoas', 20, 'Male', 'Divorced', '09534634354', 'cardo@gmail.com', 'Police Security and Protection Group (PSPG)', 'Police Major (PMAJ)', '466575', '999');

-- --------------------------------------------------------

--
-- Table structure for table `police_comments`
--

CREATE TABLE `police_comments` (
  `pol_commentID` int(11) NOT NULL,
  `reportID` int(11) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `rank` varchar(40) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `policeID` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `police_comments`
--

INSERT INTO `police_comments` (`pol_commentID`, `reportID`, `pic`, `rank`, `fname`, `lname`, `comment`, `policeID`, `date`) VALUES
(1, 6, 'images/profile_pics/police/𝐆𝐮𝐧 𝐃𝐞𝐯𝐢𝐥.jpg', 'Police General (PGEN)', 'Bata', 'Sumanao', 'hello', 1, '2023-12-13 12:56:49'),
(2, 6, 'images/profile_pics/police/𝐆𝐮𝐧 𝐃𝐞𝐯𝐢𝐥.jpg', 'Police General (PGEN)', 'Bata', 'Sumanao', 'Already Caught', 1, '2023-12-13 13:05:49'),
(3, 6, 'images/profile_pics/police/𝐆𝐮𝐧 𝐃𝐞𝐯𝐢𝐥.jpg', 'Police General (PGEN)', 'Bata', 'Sumanao', 'hello', 1, '2023-12-13 13:07:07'),
(4, 6, 'images/profile_pics/police/𝐆𝐮𝐧 𝐃𝐞𝐯𝐢𝐥.jpg', 'Police General (PGEN)', 'Bata', 'Sumanao', 'Imprisonment', 1, '2023-12-13 13:08:49'),
(5, 6, 'images/profile_pics/police/cardo.jpg', 'Police Major (PMAJ)', 'Cardo', 'Dalisay', 'Huli kang loko ka', 2, '2023-12-13 15:35:52'),
(6, 6, 'images/profile_pics/police/𝐆𝐮𝐧 𝐃𝐞𝐯𝐢𝐥.jpg', 'Police General (PGEN)', 'Bata', 'Sumanao', 'tapos na po ang incidente', 1, '2024-01-08 11:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL,
  `crime` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `pic_evidence` varchar(100) DEFAULT NULL,
  `content` varchar(600) NOT NULL,
  `username` varchar(20) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportID`, `title`, `status`, `crime`, `date`, `pic_evidence`, `content`, `username`, `latitude`, `longitude`, `address`) VALUES
(2, 'Lalakeng nakajacket na Magnanakaw sa Bayan', 'Reported', 'Robbery', '2023-12-10 21:54:30', 'images/evidences/robbery.jpg', 'Nakaraang hatinggabi, naganap ang isang krimen sa isang maliit na tindahan dito sa ating bayan. Ayon sa mga ulat, isang grupo ng mga armadong magnanakaw ang pumasok sa establisyimento at nang-agaw ng mahigit sa P100,000 halaga ng pera at mga kalakal. Ayon sa mga saksi, mabilis at maingat ang galaw ng mga suspek habang inuutos sa lahat ng tao sa loob na manatili sa kalmadong estado habang kinokontrol ang sitwasyon. Ipinakita ng mga suspek ang kanilang mga armas upang takutin ang mga tao sa paligid, at mabilis na tinakasan ang lugar pagkatapos.', 'idolo', 15.9698, 120.5751, 'Honeymoon Road, Dilan-Paurido'),
(5, 'Pagpaslang kay Inay', 'Reported', 'Murder', '2023-12-12 14:09:30', 'images/evidences/murder.jpg', 'Tulong pooooo, pinaslang ang aking inay. Walang awa kayo kung sino man gumawa nito, napakahayop mo. Mabulok ka sa impyerno. Sabi ng kapitbahay pinapasok ka daw ni Inay, magkakilala pala kayo bat mo to nagawa. Kaibigan ni Inay ang pumatay, nagngangalang Tisoy', 'idolo', 15.9698, 120.5751, 'Honeymoon Road, Dilan-Paurido'),
(6, 'Nanakawan ako ng kotse', 'In Progress', 'Carnapping', '2023-12-13 11:07:10', 'images/evidences/cyberpunk boy.jpg', 'Tulongggggggggggg', 'Denji99', 15.9698, 120.5751, 'Honeymoon Road, Dilan-Paurido');

-- --------------------------------------------------------

--
-- Table structure for table `type_crimes`
--

CREATE TABLE `type_crimes` (
  `crime_id` int(11) NOT NULL,
  `crime` varchar(100) NOT NULL,
  `description` varchar(2500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_crimes`
--

INSERT INTO `type_crimes` (`crime_id`, `crime`, `description`) VALUES
(1, 'Theft', 'Theft is defined under Article 308 of the Revised Penal Code. Theft is committed by any person who, with intent to gain, takes personal property of another without the latter\'s consent. The law does not specify a minimum amount that must be stolen for the act to qualify as theft.\r\nThe penalties for theft under Philippine law vary based on the value of the property stolen and other circumstances surrounding the theft. Penalties may range from arresto menor (imprisonment for 1 to 30 days) to prision mayor (imprisonment for 6 years and 1 day to 12 years), depending on various factors.'),
(2, 'Rape', 'Rape is a serious criminal offense in the Philippines, punishable under the Revised Penal Code and Republic Act No. 8353, also known as the Anti-Rape Law of 1997. It has elements that must be proven such as: 1) lack of consent; 2) force, threat, or intimidation; and 3) fraud or grave abuse of authority.\r\nRape can occur under various circumstances, generally involving any form of sexual penetration without consent. In the Philippines, this includes:\r\nForced Penetration: Traditional concept of rape involving forced vaginal intercourse.\r\nInstrumental Rape: Insertion of an instrument or object into the genital or anal orifice.\r\nSame-sex Rape: Rape can be committed by any person against anyone, irrespective of gender.\r\nMarital Rape: Spousal rape is also recognized, making it possible to charge a spouse with rape.\r\nindividuals under the age of 12 cannot give legal consent to sexual activities. Additionally, rape charges can be pursued if the victim is over 12 but has a mental disability that prevents informed consent.\r\nPenalties can range from reclusion perpetua to death, depending on the circumstances, such as the use of a deadly weapon or the resultant serious physical harm.'),
(3, 'Physical Injury', 'Altercations and misunderstandings often result in inflicting physical pain upon an individual. Whether the injury is slight or serious, the individual who committed the crime has violated law. Physical injuries have varying degrees.\r\nArt. 262. Mutilation\r\nOffense: Intentional mutilation of another person, either totally or partially, or some essential organ of reproduction.\r\nPenalties:\r\nReclusion temporal to reclusion perpetua for mutilation.\r\nPrision mayor in its medium and maximum periods for other intentional mutilation.\r\nArt. 263. Serious Physical Injuries\r\nOffense: Wounding, beating, or assaulting another resulting in serious physical injuries.\r\nPenalties: Vary based on the consequences of the injuries, ranging from prision correccional to reclusion temporal.\r\nSpecial Cases: Different penalties apply if the offense is committed against specific persons or under certain circumstances.\r\nArt. 264. Administering Injurious Substances or Beverages\r\nOffense: Inflicting serious physical injury by administering injurious substances or beverages knowingly.\r\nPenalties: Same as those in Art. 263, depending on the consequences of the injuries.\r\nArt. 265. Less Serious Physical Injuries\r\nOffense: Inflicting physical injuries that incapacitate the offended party for labor for ten days or more, or require medical assistance for the same period.\r\nPenalty: Arresto mayor.\r\nAggravating Circumstances: Manifest intent to kill or offend, or circumstances adding ignominy, may result in a fine not exceeding 500 pesos.\r\nArt. 266. Slight Physical Injuries and Maltreatment\r\nOffense: Slight physical injuries or ill-treatment without causing injuries.\r\nPenalties:\r\nArresto menor for injuries incapacitating the offended party for one to nine days or requiring medical attendance.\r\nArresto menor or a fine not exceeding 20 pesos and censure for injuries not preventing the offended party from habitual work and not requiring medical assistance.\r\nArresto menor in its minimum period or a fine not exceeding 50 pesos for ill-treatment without causing injury.'),
(4, 'Robbery', 'Robbery in the Philippines is primarily governed by the Revised Penal Code, specifically under Title Ten, Articles 293 to 305. The crime of robbery involves unlawfully taking personal property belonging to another, against their will, through the use of violence, intimidation, or force.\r\nRobbery is categorized into different types, each carrying distinct penalties:\r\nRobbery with Violence or Intimidation of Persons: Imprisonment ranging from reclusion perpetua to reclusion temporal, depending on the level of violence and harm inflicted.\r\nRobbery by the Use of Force Upon Things: Penalties vary based on the value of the items stolen and the manner in which the robbery is conducted, often ranging from arresto mayor to prision correccional.\r\nHighway Robbery or Brigandage: Penalties are more severe for robberies committed on the highway and can range from reclusion temporal to reclusion perpetua.\r\nSpecial Complex Crimes: If the robbery is accompanied by rape, homicide, or other severe crimes, the penalties are generally more stringent, often leading to life imprisonment or death, although the death penalty is currently not implemented in the Philippines.'),
(5, 'Murder', 'ART. 248. Murder. Any person who, not falling within the provisions of Article 246, shall kill another, shall be guilty of murder and shall be punished by reclusion perpetua, to death if committed with any of the following attendant circumstances:\r\nWith treachery, taking advantage of superior strength, with the aid of armed men, or employing means to weaken the defense, or of means or persons to insure or afford impunity;\r\nIn consideration of a price, reward, or promise;\r\nBy means of inundation, fire, poison, explosion, shipwreck, stranding of a vessel, derailment or assault upon a railroad, fall of an airship, by means of motor vehicles, or with the use of any other means involving great waste and ruin;\r\nOn occasion of any calamities enumerated in the preceding paragraph, or of an earthquake, eruption of a volcano, destructive cyclone, epidemic, or any other public calamity;\r\nWith evident premeditation;\r\nWith cruelty, by deliberately and inhumanly augmenting the suffering of the victim, or outraging or scoffing at his person or corpse.\r\nThe penalty imposed for the crime of murder is reclusion perpetua (20 years and 1 day to 40 years, but still indivisible penalty).'),
(6, 'Carnapping', 'Carnapping is a criminal offense involving the theft or illegal taking of a motor vehicle. In the Philippines, this is governed by Republic Act No. 6539, also known as the Anti-Carnapping Act. This statute defines carnapping, outlines penalties, and provides guidelines for prosecution.\r\nTo prosecute for carnapping, the following elements must be established:\r\nActual taking of the vehicle.\r\nThe offender has an intent to gain.\r\nThe owner\'s consent is lacking.\r\nThe means employed involves violence, intimidation, or force upon things.\r\nCertain circumstances elevate the crime to a more serious offense with heavier penalties. These include:\r\nCarnapping where the owner, driver, or occupant of the carnapped vehicle is killed or raped.\r\nCarnapping committed by an organized syndicate.\r\nThe penalties for carnapping are severe and may include imprisonment ranging from fourteen years and eight months to life imprisonment, depending on the circumstances and the presence of qualifying aggravating conditions.'),
(7, 'Homicide', 'Art. 249. Homicide. – Any person who, not falling within the provisions of Article 246, shall kill another, without the attendance of any of the circumstances enumerated in the next preceding article, shall be deemed guilty of homicide and be punished by reclusion temporal.”\r\nThe elements of Homicide are the following:\r\n(a) a person was killed;\r\n(b) the accused killed him without any justifying circumstance;\r\n(c) the accused had the intention to kill, which is presumed; and\r\n(d) the killing was not attended by any of the qualifying circumstances of Murder, or by that of Parricide or Infanticide.\r\nFor homicide, the penalty is reclusion temporal with a duration of 12 years and 1 day to 20 years. ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `citizens`
--
ALTER TABLE `citizens`
  ADD PRIMARY KEY (`citizenID`);

--
-- Indexes for table `citizen_comments`
--
ALTER TABLE `citizen_comments`
  ADD PRIMARY KEY (`cit_commentID`);

--
-- Indexes for table `police`
--
ALTER TABLE `police`
  ADD PRIMARY KEY (`policeID`);

--
-- Indexes for table `police_comments`
--
ALTER TABLE `police_comments`
  ADD PRIMARY KEY (`pol_commentID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportID`);

--
-- Indexes for table `type_crimes`
--
ALTER TABLE `type_crimes`
  ADD PRIMARY KEY (`crime_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `citizens`
--
ALTER TABLE `citizens`
  MODIFY `citizenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `citizen_comments`
--
ALTER TABLE `citizen_comments`
  MODIFY `cit_commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `police`
--
ALTER TABLE `police`
  MODIFY `policeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `police_comments`
--
ALTER TABLE `police_comments`
  MODIFY `pol_commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `type_crimes`
--
ALTER TABLE `type_crimes`
  MODIFY `crime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
