-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2021 at 01:05 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flutterdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `condo`
--

CREATE TABLE `condo` (
  `id` int(10) NOT NULL,
  `condo_id` int(20) NOT NULL,
  `condo_name` varchar(200) NOT NULL,
  `condo_price` varchar(50) NOT NULL,
  `condo_detail` text NOT NULL,
  `condo_img` varchar(255) NOT NULL,
  `condo_comment` text NOT NULL,
  `condo_rate` varchar(10) NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `condo`
--

INSERT INTO `condo` (`id`, `condo_id`, `condo_name`, `condo_price`, `condo_detail`, `condo_img`, `condo_comment`,`condo_rate`) VALUES
(28, 'GA4', 'NFS Rivals', 1500, 'Need for Speed Rivals is a 2013 racing video condo set in an open world environment. Developed by Ghost condos and Criterion condos, this is the twentieth installment in the long-running Need for Speed series. The condo was released for Microsoft Windows, PlayStation 3 and Xbox 360 on 19 November 2013. It has also been released for PlayStation 4 and Xbox One as launch titles in the same month.', 'NFS.jpg', 40),
(27, 'GA3', 'GTA V', 2000, 'Grand Theft Auto V is an open world, action-adventure video condo developed by Rockstar North and published by Rockstar condos. It was released on 17 September 2013 for the PlayStation 3 and Xbox 360. It is the fifteenth title in the Grand Theft Auto series, and the first main entry since Grand Theft Auto IV in 2008. Set within the fictional state of San Andreas, based on Southern California, Grand Theft Auto V\'s single-player story follows three criminals and their efforts to execute a number of heists while under pressure from government agencies. The condo\'s use of open world design allows the player to freely roam the state\'s countryside and the city of Los Santos, based on Los Angeles.', 'Gta5.jpg', 30),
(25, 'GA1', 'SkyRim', 1000, 'The Elder Scrolls V: Skyrim is an action role-playing video condo developed by Bethesda condo Studios and published by Bethesda Softworks.', 'Skyrim.jpg', 10),
(26, 'GA2', 'Skyrim', 1500, 'Assassin\'s Creed IV: Black Flag is a 2013 historical action-adventure open world video condo developed by Ubisoft Montreal and published by Ubisoft. It was released worldwide for the PlayStation 3 and Xbox 360 on October 29, 2013; for the Wii U on October 29, 2013 in North America, on November 21, 2013 in Australia, on November 22, 2013 in Europe, and on November 28, 2013 in Japan; for the PlayStation 4 on November 15, 2013 in North America, on November 22, 2013 in Europe, and on November 29, 2013 in Australia; for Microsoft Windows on November 19, 2013 in North America, on November 21, 2013 in Australia, and on November 22, 2013 in Europe; and for the Xbox One on November 22, 2013.', 'Ass4.jpg', 20);

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--
CREATE TABLE `apartment` (
  `id` int(10) NOT NULL,
  `apartment_id` int(20) NOT NULL,
  `apartment_name` varchar(200) NOT NULL,
  `apartment_price` varchar(50) NOT NULL,
  `apartment_detail` text NOT NULL,
  `apartment_img` varchar(255) NOT NULL,
  `apartment_comment` text NOT NULL,
  `apartment_rate` varchar(10) NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`id`, `apartment_id`, `apartment_name`, `apartment_price`, `apartment_detail`, `apartment_img`, `apartment_comment`,`apartment_rate`) VALUES
(28, 'GA4', 'NFS Rivals', 1500, 'Need for Speed Rivals is a 2013 racing video apartment set in an open world environment. Developed by Ghost apartments and Criterion apartments, this is the twentieth installment in the long-running Need for Speed series. The apartment was released for Microsoft Windows, PlayStation 3 and Xbox 360 on 19 November 2013. It has also been released for PlayStation 4 and Xbox One as launch titles in the same month.', 'NFS.jpg', 40),
(27, 'GA3', 'GTA V', 2000, 'Grand Theft Auto V is an open world, action-adventure video apartment developed by Rockstar North and published by Rockstar apartments. It was released on 17 September 2013 for the PlayStation 3 and Xbox 360. It is the fifteenth title in the Grand Theft Auto series, and the first main entry since Grand Theft Auto IV in 2008. Set within the fictional state of San Andreas, based on Southern California, Grand Theft Auto V\'s single-player story follows three criminals and their efforts to execute a number of heists while under pressure from government agencies. The apartment\'s use of open world design allows the player to freely roam the state\'s countryside and the city of Los Santos, based on Los Angeles.', 'Gta5.jpg', 30),
(25, 'GA1', 'SkyRim', 1000, 'The Elder Scrolls V: Skyrim is an action role-playing video apartment developed by Bethesda apartment Studios and published by Bethesda Softworks.', 'Skyrim.jpg', 10),
(26, 'GA2', 'Skyrim', 1500, 'Assassin\'s Creed IV: Black Flag is a 2013 historical action-adventure open world video apartment developed by Ubisoft Montreal and published by Ubisoft. It was released worldwide for the PlayStation 3 and Xbox 360 on October 29, 2013; for the Wii U on October 29, 2013 in North America, on November 21, 2013 in Australia, on November 22, 2013 in Europe, and on November 28, 2013 in Japan; for the PlayStation 4 on November 15, 2013 in North America, on November 22, 2013 in Europe, and on November 29, 2013 in Australia; for Microsoft Windows on November 19, 2013 in North America, on November 21, 2013 in Australia, and on November 22, 2013 in Europe; and for the Xbox One on November 22, 2013.', 'Ass4.jpg', 20);

-- --------------------------------------------------------

--
-- Table structure for table `mantion`
--
CREATE TABLE `mantion` (
  `id` int(10) NOT NULL,
  `mantion_id` int(20) NOT NULL,
  `mantion_name` varchar(200) NOT NULL,
  `mantion_price` varchar(50) NOT NULL,
  `mantion_detail` text NOT NULL,
  `mantion_img` varchar(255) NOT NULL,
  `mantion_comment` text NOT NULL,
  `mantion_rate` varchar(10) NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mantion`
--

INSERT INTO `mantion` (`id`, `mantion_id`, `mantion_name`, `mantion_price`, `mantion_detail`, `mantion_img`, `mantion_comment`,`mantion_rate`) VALUES
(28, 'GA4', 'NFS Rivals', 1500, 'Need for Speed Rivals is a 2013 racing video mantion set in an open world environment. Developed by Ghost mantions and Criterion mantions, this is the twentieth installment in the long-running Need for Speed series. The mantion was released for Microsoft Windows, PlayStation 3 and Xbox 360 on 19 November 2013. It has also been released for PlayStation 4 and Xbox One as launch titles in the same month.', 'NFS.jpg', 40),
(27, 'GA3', 'GTA V', 2000, 'Grand Theft Auto V is an open world, action-adventure video mantion developed by Rockstar North and published by Rockstar mantions. It was released on 17 September 2013 for the PlayStation 3 and Xbox 360. It is the fifteenth title in the Grand Theft Auto series, and the first main entry since Grand Theft Auto IV in 2008. Set within the fictional state of San Andreas, based on Southern California, Grand Theft Auto V\'s single-player story follows three criminals and their efforts to execute a number of heists while under pressure from government agencies. The mantion\'s use of open world design allows the player to freely roam the state\'s countryside and the city of Los Santos, based on Los Angeles.', 'Gta5.jpg', 30),
(25, 'GA1', 'SkyRim', 1000, 'The Elder Scrolls V: Skyrim is an action role-playing video mantion developed by Bethesda mantion Studios and published by Bethesda Softworks.', 'Skyrim.jpg', 10),
(26, 'GA2', 'Skyrim', 1500, 'Assassin\'s Creed IV: Black Flag is a 2013 historical action-adventure open world video mantion developed by Ubisoft Montreal and published by Ubisoft. It was released worldwide for the PlayStation 3 and Xbox 360 on October 29, 2013; for the Wii U on October 29, 2013 in North America, on November 21, 2013 in Australia, on November 22, 2013 in Europe, and on November 28, 2013 in Japan; for the PlayStation 4 on November 15, 2013 in North America, on November 22, 2013 in Europe, and on November 29, 2013 in Australia; for Microsoft Windows on November 19, 2013 in North America, on November 21, 2013 in Australia, and on November 22, 2013 in Europe; and for the Xbox One on November 22, 2013.', 'Ass4.jpg', 20);
-- --------------------------------------------------------

--
-- Table structure for table `dormitory`
--
CREATE TABLE `dormitory` (
  `id` int(10) NOT NULL,
  `dormitory_id` int(20) NOT NULL,
  `dormitory_name` varchar(200) NOT NULL,
  `dormitory_price` varchar(50) NOT NULL,
  `dormitory_detail` text NOT NULL,
  `dormitory_img` varchar(255) NOT NULL,
  `dormitory_comment` text NOT NULL,
  `dormitory_rate` varchar(10) NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dormitory`
--

INSERT INTO `dormitory` (`id`, `dormitory_id`, `dormitory_name`, `dormitory_price`, `dormitory_detail`, `dormitory_img`, `dormitory_comment`,`dormitory_rate`) VALUES
(28, 'GA4', 'NFS Rivals', 1500, 'Need for Speed Rivals is a 2013 racing video dormitory set in an open world environment. Developed by Ghost dormitorys and Criterion dormitorys, this is the twentieth installment in the long-running Need for Speed series. The dormitory was released for Microsoft Windows, PlayStation 3 and Xbox 360 on 19 November 2013. It has also been released for PlayStation 4 and Xbox One as launch titles in the same month.', 'NFS.jpg', 40),
(27, 'GA3', 'GTA V', 2000, 'Grand Theft Auto V is an open world, action-adventure video dormitory developed by Rockstar North and published by Rockstar dormitorys. It was released on 17 September 2013 for the PlayStation 3 and Xbox 360. It is the fifteenth title in the Grand Theft Auto series, and the first main entry since Grand Theft Auto IV in 2008. Set within the fictional state of San Andreas, based on Southern California, Grand Theft Auto V\'s single-player story follows three criminals and their efforts to execute a number of heists while under pressure from government agencies. The dormitory\'s use of open world design allows the player to freely roam the state\'s countryside and the city of Los Santos, based on Los Angeles.', 'Gta5.jpg', 30),
(25, 'GA1', 'SkyRim', 1000, 'The Elder Scrolls V: Skyrim is an action role-playing video dormitory developed by Bethesda dormitory Studios and published by Bethesda Softworks.', 'Skyrim.jpg', 10),
(26, 'GA2', 'Skyrim', 1500, 'Assassin\'s Creed IV: Black Flag is a 2013 historical action-adventure open world video dormitory developed by Ubisoft Montreal and published by Ubisoft. It was released worldwide for the PlayStation 3 and Xbox 360 on October 29, 2013; for the Wii U on October 29, 2013 in North America, on November 21, 2013 in Australia, on November 22, 2013 in Europe, and on November 28, 2013 in Japan; for the PlayStation 4 on November 15, 2013 in North America, on November 22, 2013 in Europe, and on November 29, 2013 in Australia; for Microsoft Windows on November 19, 2013 in North America, on November 21, 2013 in Australia, and on November 22, 2013 in Europe; and for the Xbox One on November 22, 2013.', 'Ass4.jpg', 20);
-- --------------------------------------------------------


--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `name`, `surname`) VALUES
('u1', 'p1', 'Niiiii', 'Wan'),
('niracha', '2608', 'Niracha', 'Wanchitnai'),
--
-- Indexes for dumped tables
--

--
-- Indexes for table `condo`
--
ALTER TABLE `condo`
  ADD PRIMARY KEY (`id`);


-- Indexes for table `mantion`
--
ALTER TABLE `mantion`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `dormitory`
--
ALTER TABLE `dormitory`
  ADD PRIMARY KEY (`id`);  

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `condo`
--
ALTER TABLE `condo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;



-- AUTO_INCREMENT for table `apartment`
--
ALTER TABLE `apartment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

-- AUTO_INCREMENT for table `dormitory`
--
ALTER TABLE `dormitory`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;


-- AUTO_INCREMENT for table `mantion`
--
ALTER TABLE `mantion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
