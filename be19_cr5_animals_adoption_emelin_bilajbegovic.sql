-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2023 at 01:30 PM
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
-- Database: `be19_cr5_animals_adoption_emelin_bilajbegovic`
--
CREATE DATABASE IF NOT EXISTS `be19_cr5_animals_adoption_emelin_bilajbegovic` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be19_cr5_animals_adoption_emelin_bilajbegovic`;

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id_pet` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(700) NOT NULL,
  `size` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `vaccinated` tinyint(1) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `fk_animalId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id_pet`, `name`, `image`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`, `fk_animalId`) VALUES
(1, 'Kitty', 'cat.jpg', 'Testtraße 10, Vienna', 'Very nice young cat from a non smoke home.burrower, agile, whiskers, cute, lovely,...', 'small', 1, 1, 'cat', 1, NULL),
(2, 'Mike', 'dog.jpg', 'Testtraße 10, Linz', 'A very cute young dog which loves children and is always happy,burrower,cute,small,...', 'small', 2, 1, 'dog', 1, NULL),
(3, 'Greeny', 'snake.jpg', 'Venezien, Italien', 'A beautiful snake from Amazon area. Likes to eat mouses and insects. Not dangerouse , likes to play', 'medium', 4, 0, 'reptile', 0, NULL),
(4, 'Alex', 'koala.jpg', 'Sidney, Australia', 'Cute, marsupial, eucalyptus, tree-dwelling, sleepy, herbivore, Australia, pouch, fuzzy, iconic.', 'big', 9, 1, 'marsupial', 1, NULL),
(5, 'Arabian Lightning', 'horse.jpg', 'Amman, Jordanian', 'Elegant, swift, Arabian Peninsula, endurance, majestic, intelligent, distinctive, prized, loyal, graceful.', 'big', 12, 1, 'horse', 0, NULL),
(7, 'Nemo', 'clownfish.jpg', 'Roma, Italia', 'Vibrant, coral-dwelling, clownfish, Red Sea, striped, small, symbiotic, playful, marine, colorful.', 'small', 3, 0, 'seafish', 1, NULL),
(10, 'Felix', 'rabbit.jpg', 'Innsbruck, Austria', 'Furry, herbivorous, hopping, cute, social, burrower, gentle, floppy ears, whiskers, active.', 'small', 3, 1, 'rabbit', 0, NULL),
(24, 'Jim', 'donkey.jpg', 'Greece', 'Hardy, sure-footed, gentle, hardworking, patient, friendly, herbivorous, braying, resilient, iconic.', 'big', 13, 1, 'donkey', 0, NULL),
(25, 'Trump', 'turtle.jpg', 'Testtraße 10, Berlin, Germany', 'Shell, reptile, slow-moving, aquatic, ancient, patient, herbivorous, protective, cold-blooded, long-lived.', 'small', 9, 0, 'sea turtle', 1, NULL),
(28, 'Jumbo', 'elefant.jpg', 'Ghambia, Arfica', 'This is an animal which needs a lot space and can only be given to adoptation if you have a big garden :)', 'big', 24, 1, 'elefant', 1, NULL),
(35, 'Aeffili', 'avatar.jpg', 'Grazergasse 1', 'cdvsdvsv\r\nsvsv\r\nvasvasbsdfbdsbbfadbfsdf\r\nagasbgsdbadfbdfgsdafg', 'small', 2, 0, 'mouse', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `adoption_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `adoption_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`adoption_id`, `user_id`, `pet_id`, `adoption_date`) VALUES
(1, 4, 1, '2023-07-29'),
(2, 4, 10, '2023-07-29'),
(3, 4, 25, '2023-07-29'),
(6, 15, 24, '2023-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `sizeId` int(11) NOT NULL,
  `size` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`sizeId`, `size`) VALUES
(1, 'Large'),
(2, 'Small');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `password`, `status`) VALUES
(3, 'Emelin', 'Bilajbeg', 'bilajbeg@gmail.com', 660610549, 'Karajangasse 11', 'emelin.jpg', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'adm'),
(4, 'Murat', 'Arslan', 'murat@gmail.com', 19740510, 'Praterstraße 12', 'man_2.jpg', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user'),
(9, 'Erol', 'Turki', 'erol@gmail.com', 123456, 'Münzgasse 5', 'man_1.jpg', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user'),
(15, 'Hassan', 'Nimsawi', 'hassan@gmail.com', 660123456, 'Müllergasse 5', 'avatar.png', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id_pet`),
  ADD KEY `fk_supplierId` (`fk_animalId`) USING BTREE;

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`sizeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id_pet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `adoption_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `sizeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`fk_animalId`) REFERENCES `size` (`sizeId`);

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `animal` (`id_pet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
