-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 10:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$aRSwtY6GgASt4rEmV5GuQODGMFw315/gOxLO001tArAVNHFaH.SU2');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `cid` int(255) NOT NULL,
  `sid` int(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`cid`, `sid`, `photo`, `phone`, `address`) VALUES
(1, NULL, 'uploads/user.jpg', '980000047', ' Kathmandu'),
(2, NULL, '', '9810000056', 'Kathmandu'),
(3, 3, '', '98470000599', 'Kathmandu');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_staff`
--

CREATE TABLE `delivery_staff` (
  `staff_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_staff`
--

INSERT INTO `delivery_staff` (`staff_id`, `username`, `email`, `password`, `phone`, `address`) VALUES
(1, 'Delivery', 'delivery56@gmail.com', '$2y$10$QdGPnDol8ovdpceobxXsQ.tsNRhjMughEhAHFB5aJML6qyoW2vFm6', '9843000477', 'Kathmandu');

-- --------------------------------------------------------

--
-- Table structure for table `messagedb`
--

CREATE TABLE `messagedb` (
  `mid` int(11) NOT NULL,
  `sid` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messagedb`
--

INSERT INTO `messagedb` (`mid`, `sid`, `message`, `photo`, `created_at`) VALUES
(1, 1, 'Hello can we send our own design for the birthday cake . ', '', '2024-05-25 04:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `orders_table`
--

CREATE TABLE `orders_table` (
  `order_id` int(11) NOT NULL,
  `sid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `product_weight` decimal(10,0) DEFAULT NULL,
  `quantity` varchar(10) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `cake_type` varchar(255) NOT NULL,
  `message` text NOT NULL DEFAULT 'No Message',
  `delivery_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_table`
--

INSERT INTO `orders_table` (`order_id`, `sid`, `cid`, `pid`, `product_weight`, `quantity`, `total_price`, `cake_type`, `message`, `delivery_date`, `created_at`, `status`) VALUES
(1, 1, 1, 12, 1, '2', 1800.00, 'egg', '', '2024-05-26', '2024-05-25 04:07:38', 'cancel'),
(2, 1, 1, 22, 1, '1', 1300.00, 'egg', 'Happy Birthday Oshin.', '2024-05-29', '2024-05-25 04:15:32', 'confirm'),
(3, 2, 2, 16, 1, '1', 780.00, 'egg_less', '', '2024-05-27', '2024-05-25 10:08:39', 'pending'),
(4, 2, 2, 17, 1, '1', 900.00, 'egg', '', '2024-05-29', '2024-05-25 10:09:54', 'shipped'),
(5, 1, 1, 22, 1, '1', 1300.00, 'egg', 'Happy Birthday.', '2024-05-30', '2024-05-25 13:14:39', 'confirmed'),
(6, 3, 3, 12, 1, '1', 900.00, 'egg', '', '2024-05-28', '2024-05-27 03:13:32', 'delivered'),
(7, 3, 3, 11, 1, '1', 780.00, 'egg', '', '2024-05-28', '2024-05-27 04:33:18', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `product_photo` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `product_name`, `category`, `price`, `product_photo`, `description`, `created_at`) VALUES
(11, 'Easter Cake', 'Regular', 780.00, 'easter (1).jpg', 'An Easter cake is a joyful celebration in every slice, featuring layers of moist, pastel-colored sponge cake interspersed with rich, creamy frosting. Adorned with whimsical decorations like fondant bunnies, colorful eggs, and a sprinkle of springtime flowers, this cake is a feast for the eyes and the palate. Each bite offers a sweet, festive flavor that captures the essence of Easter, making it a perfect centerpiece for your holiday gathering.', '2024-05-24'),
(12, 'White Forest', 'Regular', 900.00, 'white forest.jpg', '\r\n A white forest cake is a heavenly confection, marrying layers of fluffy vanilla sponge with delicate whipped cream and luscious cherries. Its a symphony of light, airy texture and sweet, fruity flavor, adorned with snowy peaks of whipped cream and crowned with ruby-red cherries. A classic treat that delights with every bite!\r\n', '2024-05-24'),
(13, 'Truffle Cake', 'Same Day Delivery', 1200.00, 'truffel.jpg', 'Truffle Cake\r\nA truffle cake is a decadent indulgence, featuring rich, moist chocolate layers enveloped in smooth, velvety chocolate ganache. Each bite melts in your mouth, delivering an intense chocolate experience thats pure bliss for chocolate lovers.', '2024-05-24'),
(14, 'Red Velvet Cake', 'Regular', 1200.00, 'red velvet.jpg', 'Red Velvet Cake\r\nA red velvet cake is a visual and culinary delight, with its vibrant red layers of tender, moist cake paired with a tangy cream cheese frosting. The subtle hint of cocoa adds depth, creating a perfect balance of flavors that is both elegant and irresistible.', '2024-05-24'),
(15, 'Oreo Cake', 'Regular', 1350.00, 'oreo.jpg', 'Oreo Cake\r\nAn Oreo cake is a dream come true for cookie lovers, combining layers of moist chocolate cake with creamy, crunchy Oreo-infused frosting. Topped with crumbled Oreo cookies, this cake offers a delightful texture and the beloved taste of everyones favorite cookie.\r\n', '2024-05-24'),
(16, 'Butterscotch Cake', 'Same Day Delivery', 780.00, 'butterscotch.jpg', 'Butterscotch Cake\r\nA butterscotch cake is a sweet symphony of flavors, featuring fluffy layers of butterscotch-flavored sponge cake complemented by a rich, buttery frosting. Drizzled with golden butterscotch sauce, this cake is a delightful treat that satisfies every sweet tooth.', '2024-05-24'),
(17, 'Chocolate Cake', 'Regular', 900.00, 'chocolate.jpg', '\r\nChocolate Cake\r\nA chocolate cake is a timeless classic, boasting rich, moist layers of chocolate sponge cake paired with a luscious chocolate frosting. Each bite is a heavenly experience, delivering deep, intense chocolate flavor that delights the senses.\r\n', '2024-05-24'),
(18, 'Fruit Cake', 'Same Day Delivery', 750.00, 'fruits.jpg', 'Fruits Cake\r\nA fruit cake is a vibrant and refreshing treat, combining light, airy sponge cake with layers of fresh, juicy fruits and whipped cream. Each slice burst\'s with natural sweetness and bright flavors, making it a perfect choice for a delightful and healthy dessert.', '2024-05-24'),
(19, 'Black Forest Cake', 'Regular', 900.00, 'black froest.jpg', 'Black Forest Cake\r\nA black forest cake is a German classic, featuring layers of moist chocolate cake, luscious whipped cream, and tart cherries. Decorated with chocolate shavings and more cherries on top, this cake offers a perfect blend of rich and fruity flavors in every bite.', '2024-05-24'),
(20, 'Flowey Birthday Cake', 'Birthday Cake', 900.00, 'flowery-birthdaycake.jpg', '\r\nBirthday Cake\r\nA birthday cake is a symbol of celebration and joy, tailored to reflect the personality and tastes of the birthday honoree. Whether adorned with colorful fondant decorations, sprinkles, or candles, it\'s a sweet reminder of another year of cherished memories and new beginnings.', '2024-05-24'),
(21, 'Happy Birthday Ballon cake', 'Birthday Cake', 1050.00, 'birthday3cake.jpg', '\r\nBirthday Cake\r\nA birthday cake is a symbol of celebration and joy, tailored to reflect the personality and tastes of the birthday honoree. Whether adorned with colorful fondant decorations, sprinkles, or candles, it\'s a sweet reminder of another year of cherished memories and new beginnings.', '2024-05-24'),
(22, 'Birthday Cake', 'Birthday Cake', 1300.00, 'birthdaycake-1.jpg', '\r\nBirthday Cake\r\nA birthday cake is a symbol of celebration and joy, tailored to reflect the personality and tastes of the birthday honoree. Whether adorned with colorful fondant decorations, sprinkles, or candles, it\'s a sweet reminder of another year of cherished memories and new beginnings.', '2024-05-24'),
(23, 'Cute Anniversary Cake', 'Anniversary Cake', 1350.00, 'anniversarycake3.jpg', 'Anniversary Cake\r\nAn anniversary cake is a sweet tribute to enduring love and cherished memories. Whether celebrating one year or fifty, it\'s a heartfelt expression of commitment and devotion, adorned with meaningful decorations that reflect the couple\'s journey together. Each slice is a reminder of the love and laughter shared over the years.', '2024-05-24'),
(24, 'Anniversary Cake', 'Anniversary Cake', 1350.00, 'anniversary2cake.jpg', 'Anniversary Cake\r\nAn anniversary cake is a sweet tribute to enduring love and cherished memories. Whether celebrating one year or fifty, it\'s a heartfelt expression of commitment and devotion, adorned with meaningful decorations that reflect the couple\'s journey together. Each slice is a reminder of the love and laughter shared over the years.', '2024-05-24'),
(25, 'Anniversary Cake', 'Anniversary Cake', 1250.00, 'anniversary.jpg', 'Anniversary Cake\r\nAn anniversary cake is a sweet tribute to enduring love and cherished memories. Whether celebrating one year or fifty, it\'s a heartfelt expression of commitment and devotion, adorned with meaningful decorations that reflect the couple\'s journey together. Each slice is a reminder of the love and laughter shared over the years.', '2024-05-24'),
(26, 'Two Storey Cake ', 'Wedding Cake', 1350.00, 'white.jpg', 'Wedding Cake\r\nA wedding cake is the centerpiece of a joyous union, embodying love, unity, and elegance. From classic tiered designs adorned with delicate flowers to modern, minimalist creations, each cake is crafted with meticulous attention to detail, symbolizing the couple\'s commitment to each other and their shared journey ahead.', '2024-05-24'),
(27, 'Three Storey cake', 'Wedding Cake', 1650.00, 'wedding3cake.jpg', 'Wedding Cake\r\nA wedding cake is the centerpiece of a joyous union, embodying love, unity, and elegance. From classic tiered designs adorned with delicate flowers to modern, minimalist creations, each cake is crafted with meticulous attention to detail, symbolizing the couple\'s commitment to each other and their shared journey ahead.', '2024-05-24'),
(28, 'Pretty Sweet Wedding Cake', 'Wedding Cake', 1250.00, 'weddingcake.jpg', 'Wedding Cake\r\nA wedding cake is the centerpiece of a joyous union, embodying love, unity, and elegance. From classic tiered designs adorned with delicate flowers to modern, minimalist creations, each cake is crafted with meticulous attention to detail, symbolizing the couple\'s commitment to each other and their shared journey ahead.', '2024-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `sid` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`sid`, `username`, `email`, `password`) VALUES
(1, 'Oshin Lamichhane', 'oshu@gmail.com', '$2y$10$rkI80hHY1jy87kfwp1IqFeG4zRlBQPZ5g7P2IOLXZuOdWGa9cf01u'),
(2, 'Aruna Koirala', 'arunako473@gmail.com', '$2y$10$zwPisww0oF2x5H8JH47AA.kalaCQ7PNFn2uasmcNIq.xrXNKL6bJS'),
(3, 'Anu Rijal', 'anu@gmail.com', '$2y$10$rZMyQKwCr63UqX9Hd3weQOyNfKD19KJJejdes8Y0OvbssQqZiL.Jy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `UNIQUE` (`phone`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `delivery_staff`
--
ALTER TABLE `delivery_staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `UNIQUE_PHONE` (`email`,`phone`);

--
-- Indexes for table `messagedb`
--
ALTER TABLE `messagedb`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `orders_table`
--
ALTER TABLE `orders_table`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `sid` (`sid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `cid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_staff`
--
ALTER TABLE `delivery_staff`
  MODIFY `staff_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messagedb`
--
ALTER TABLE `messagedb`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders_table`
--
ALTER TABLE `orders_table`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `sid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD CONSTRAINT `customer_details_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `signup` (`sid`);

--
-- Constraints for table `messagedb`
--
ALTER TABLE `messagedb`
  ADD CONSTRAINT `messagedb_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `signup` (`sid`);

--
-- Constraints for table `orders_table`
--
ALTER TABLE `orders_table`
  ADD CONSTRAINT `orders_table_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `signup` (`sid`),
  ADD CONSTRAINT `orders_table_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `customer_details` (`cid`),
  ADD CONSTRAINT `orders_table_ibfk_3` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
