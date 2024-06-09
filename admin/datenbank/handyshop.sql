-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 02:36 PM
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
-- Database: `handyshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorie`
--

CREATE TABLE `kategorie` (
  `k_id` int(11) NOT NULL,
  `k_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`k_id`, `k_name`) VALUES
(1, 'lowbudget'),
(2, 'medium'),
(3, 'highend');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `order_date`) VALUES
(1, 16, 400.00, '2024-05-25 14:12:42'),
(2, 15, 2049.00, '2024-05-25 14:18:40'),
(3, 15, 1099.00, '2024-05-25 14:20:20'),
(4, 15, 1398.00, '2024-05-25 22:10:12'),
(5, 16, 400.00, '2024-06-03 06:30:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 15, 1, 400.00),
(2, 2, 15, 1, 400.00),
(3, 2, 23, 1, 450.00),
(4, 2, 4, 1, 1199.00),
(5, 3, 26, 1, 199.00),
(6, 3, 23, 2, 450.00),
(7, 4, 4, 1, 1199.00),
(8, 4, 26, 1, 199.00),
(9, 5, 15, 1, 400.00);

-- --------------------------------------------------------

--
-- Table structure for table `produkte`
--

CREATE TABLE `produkte` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `beschreibung` varchar(255) NOT NULL,
  `marke` varchar(50) NOT NULL,
  `kategorie` int(50) NOT NULL,
  `preis` decimal(20,2) NOT NULL,
  `bild` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkte`
--

INSERT INTO `produkte` (`id`, `name`, `beschreibung`, `marke`, `kategorie`, `preis`, `bild`) VALUES
(2, 'iPhone 14 256GB White', 'Diese Variante, wahrscheinlich in einer neutralen Farbe, bietet mehr Speicherplatz für Anwendungen, Fotos und Videos. Mit 256GB ist es eine gute Wahl für Benutzer, die mehr Inhalte speichern möchten, ohne auf Cloud-Dienste angewiesen zu sein.', 'Apple', 3, 979.00, 'apple/Iphone_14_256gb.png'),
(3, 'iPhone 14 512GB in Rot', 'Ein markantes und leidenschaftliches Rot unterstreicht das Design dieses Modells. Mit einer beeindruckenden Speicherkapazität von 512GB ist dieses iPhone ideal für Power-User, die eine große Menge an Daten und umfangreiche App-Sammlungen haben.', 'Apple', 3, 1223.00, 'apple/Iphone_14_512gb_Red.png'),
(4, 'iPhone 15 Pro 128GB in Schwarzem Titan', 'Diese Pro-Variante sticht mit ihrem raffinierten schwarzen Titan-Finish hervor. Mit 128GB bietet es genug Speicherplatz für den durchschnittlichen Nutzer und kommt mit fortschrittlichen Funktionen, die für die Pro Serie typisch sind, wie verbesserte Kamer', 'Apple', 3, 1199.00, 'apple/Iphone_15_Pro_128gb_BlackTitanium.png'),
(5, 'iPhone 11 128GB in Lila', 'Ein charmantes Smartphone in einem einzigartigen Lila, das Persönlichkeit und Stil ausstrahlt. Mit 128GB bietet es genügend Raum für die Bedürfnisse des täglichen Gebrauchs. Es ist eine kostengünstigere Option für diejenigen, die ein iPhone mit guter Leis', 'Apple', 2, 328.00, 'apple/Iphone_11_128gb_Purple.png'),
(6, 'iPhone 12 Pro in Gold', 'Ein Symbol für Luxus und Eleganz, dieses goldene iPhone 12 Pro ist für diejenigen, die einen Hauch von Opulenz im täglichen Leben schätzen. Es verbindet Ästhetik mit Performance und ist mit Features ausgestattet, die es von den Standardmodellen abheben.', 'Apple', 2, 516.00, 'apple/Iphone_12_Pro_Goldpng.png'),
(7, 'iPhone 12 Pro Max 128GB in Graphit', 'Dieses Gerät ist das größte und leistungsstärkste der 12er-Serie, angeboten in einem tiefen Graphitton, der für einen raffinierten Look sorgt. Das iPhone 12 Pro Max hat ein größeres Display und zusätzliche Features, die es ideal für Multimedia-Konsum und ', 'Apple', 3, 802.00, 'apple/Iphone_12_ProMax_128gb_Graphite.png'),
(8, 'iPhone 13 256GB in Sternenlicht', 'Ein elegantes und minimalistisches Design in einem sanften Sternenlicht-Farbton. Mit einer verdoppelten Speicherkapazität von 256GB ist es für diejenigen, die ihre digitale Welt erweitern möchten, ohne dabei an Stil einzubüßen.', 'Apple', 3, 705.00, 'apple/Iphone_13_256gb_Starlight.png'),
(9, 'iPhone 13 Pro 256GB in Mitternachtsblau', 'Dieses iPhone kombiniert ein tiefes Blau mit der Leistungsfähigkeit eines Pro-Modells. Es bietet fortschrittliche Kamera-Systeme und einen schnellen Prozessor für Benutzer, die ein leistungsstarkes Gerät benötigen, das gleichzeitig eine starke optische Au', 'Apple', 3, 859.00, 'apple/Iphone_13_Pro_256gb_Midnightblue.png'),
(10, 'Huawei Nova Y90 in Midnight Black', 'Ein schlankes und stilvolles Gerät in tiefem Schwarz, das mit seinem 6,7\" FullView-Display und einer schmalen Bildschirmrandung beeindruckt. Mit 128GB Speicher ausgestattet, bietet es ausreichend Platz für Fotos, Videos und Apps. Ein idealer Begleiter für', 'Huawei ', 1, 250.00, 'huawei/Huawei_Nova_Y90_128gb_MidnightBlack.png'),
(11, 'Huawei P60 Pro in Weiß', 'Dieses elegante Smartphone kommt in einem makellosen Weiß und hebt sich mit einer auffälligen Rückseite hervor. Es bietet 256GB Speicher und ist ausgestattet mit einer fortschrittlichen Kamera für Fotografie-Enthusiasten. Ein 6,6-Zoll OLED-Display sorgt f', 'Huawei ', 3, 889.00, 'huawei/Huawei_P60_Pro_White_256gb.png'),
(12, 'Huawei Mate 50 Pro in Silber', 'Ein Premium-Gerät, das Luxus mit Leistung vereint. Die silberne Rückseite glänzt im Licht, und mit 256GB Speicherplatz bleiben kaum Wünsche offen. Das Smartphone verfügt über ein großes Display und eine professionelle Kameraausstattung für herausragende B', 'Huawei ', 3, 1399.00, 'huawei/Huawei_Mate50_Pro_256gb_Silver.png'),
(13, 'Huawei Nova 9 SE in Schwarz mit 128GB', 'Das Nova 9 SE in klassischem Schwarz ist eine stilvolle Wahl für all jene, die Wert auf Design und Funktionalität legen. Der interne Speicher von 128GB sorgt für ausreichend Kapazität für den Alltagsgebrauch.', 'Huawei ', 1, 300.00, 'huawei/Huawei_Nova_9Se_128gb_Schwarz.png'),
(14, 'Huawei Nova 10 in Silver mit 128GB Speicher', 'Dieses Modell glänzt mit seinem metallischen Silber-Finish und kombiniert Eleganz mit Leistung. Mit einem Speicher von 128GB bietet es viel Platz und ist mit einer beeindruckenden Kamera für hochwertige Aufnahmen ausgestattet.', 'Huawei ', 2, 518.00, 'huawei/Huawei_Nova_10_128gb_Silver.png'),
(15, 'Huawei Nova 10 SE in Silber mit 128GB Speicher', 'Eine Variante des Nova 10, das 10 SE, präsentiert sich in einem ähnlich schicken Silber. Es ist für Nutzer konzipiert, die ein leistungsstarkes Smartphone mit ausreichend Speicher und einem ansprechenden Design suchen.', 'Huawei ', 2, 400.00, 'huawei/Huawei_Nova_10SE_128gb_Silber.png'),
(16, 'Huawei Nova 11i mit 128GB Speicher', 'Das Nova 11i verbindet Ästhetik mit praktischer Anwendbarkeit und bietet mit 128GB genug Speicher für eine Vielzahl von Anwendungen und Medien, ideal für die moderne, mobile Nutzung.', 'Huawei ', 1, 200.00, 'huawei/Huawei_Nova_11i_ 128GB.png'),
(17, 'Huawei Nova Y61 in Schwarz mit 64GB Speicher', 'Als Einstiegsmodell mit solider Leistung und einem kompakten Speicher von 64GB ist dieses Smartphone perfekt für diejenigen, die ein zuverlässiges Gerät für die tägliche Kommunikation und Unterhaltung suchen.', 'Huawei ', 1, 150.00, 'huawei/Huawei_Nova_Y61_64gb_Schwarz.png'),
(18, 'OnePlus mit 512GB in Emerald Dusk', 'Dieses Smartphone fängt den Blick mit seinem tiefgrünen Emerald Dusk Finish ein, das Eleganz und Stil ausstrahlt. Mit einer großzügigen Speicheroption von 512GB ist es ideal für Nutzer, die viel Speicherplatz benötigen, sei es für professionelle Fotografi', 'OnePlus', 3, 943.00, 'oneplus/OnePlus_Open_512gb_EmeralDusk.png'),
(19, 'OnePlus 10T mit 128GB in Jade Green', 'Das OnePlus 10T in Jade Green bietet nicht nur eine frische und lebendige Farbvariante, sondern auch leistungsstarke Spezifikationen mit einem Speicherplatz von 128GB. Es ist für diejenigen gedacht, die ein robustes Telefon mit einer lebendigen Ästhetik s', 'OnePlus', 2, 430.00, 'oneplus/OnePlus_10T_128gb_JadeGreen.png'),
(20, 'OnePlus 11 mit 256GB in Schwarz', 'Dieses elegante Smartphone in klassischem Schwarz kommt mit einer Speicherkapazität von 256GB und ist für Benutzer konzipiert, die zwischen Ästhetik und Funktion keine Kompromisse eingehen wollen. Es ist ausgestattet mit einer hochwertigen Kamera und eine', 'OnePlus', 2, 759.00, 'oneplus/Oneplus_11__256gb_Black.png'),
(21, 'OnePlus 12 mit 256GB in Silky Black', 'Das Silky Black Finish verleiht diesem Modell eine glatte und raffinierte Oberfläche. Mit 256GB Speicher bietet es reichlich Platz und kombiniert dies mit High-End-Features für eine nahtlose Benutzererfahrung.', 'OnePlus', 3, 891.00, 'oneplus/OnePlus_12_256gb_SilkyBlack.png'),
(22, 'OnePlus 12R mit 256GB in Cool Blue', 'Die Cool Blue Variante des 12R ist eine frische und moderne Wahl. Mit ebenfalls 256GB Speicher ist es eine ausgezeichnete Option für diejenigen, die sowohl Leistung als auch ein ansprechendes Design suchen.', 'OnePlus', 2, 615.00, 'oneplus/OnePlus_12R_256gb_CoolBlue.png'),
(23, 'OnePlus Nord 3 mit 128GB in Tempest Gray', 'Dieses Modell in einem stürmischen Grauton ist für Nutzer gedacht, die ein robustes, leistungsfähiges Gerät zu einem erschwinglichen Preis suchen. Mit 128GB Speicher ist es gut für den alltäglichen Gebrauch ausgestattet.', 'OnePlus', 2, 450.00, 'oneplus/OnePlus_Nord_3_128gb_Tempest_Gray.png'),
(24, 'OnePlus Nord CE3 Lite mit 128GB in Chromatic Gray', 'Ein schlichtes, aber elegantes Gerät, das eine gute Balance zwischen Preis und Leistung bietet. Mit 128GB Speicher bietet es genügend Kapazität für die meisten Anwendungen und Medien.', 'OnePlus', 1, 200.00, 'oneplus/OnePlus_Nord_CE3Lite_128gb_ChromaticGray.png'),
(25, 'Galaxy S23 FE in Graphite', 'Dieses raffinierte Gerät in einem tiefen Graphitton bietet ein ausgewogenes Verhältnis von Eleganz und Funktionalität. Mit 128GB Speicher ist es gut ausgestattet für den täglichen Gebrauch, und seine Fan Edition bietet einige der beliebtesten Features ', 'Samsung', 2, 549.00, 'samsung/Galaxy_S23_FE_128gb_Graphite.png'),
(26, 'Galaxy A15 in Blue Black mit 128GB', 'Das A15 bietet eine trendige Mischung aus Blau und Schwarz und spricht junge und stilbewusste Benutzer an. Mit einem Speicherplatz von 128GB trifft es den Nerv der Zeit für jene, die ein leistungsstarkes Smartphone für Multimedia und Apps suchen.', 'Samsung', 1, 199.00, 'samsung/Galaxy_A15_128gb_BlueBlack.png'),
(27, 'Galaxy A25 mit 256GB in Blue Black', 'Ein stilvolles Smartphone, das mit seinem großen Speicher von 256GB überzeugt und ausreichend Raum für umfangreiche Fotoalben und App-Sammlungen bietet. Sein schickes Blue Black Design hebt sich dabei deutlich ab.', 'Samsung', 1, 399.00, 'samsung/Galaxy_A25_256gb_BlueBlack.png'),
(28, 'Galaxy A35 in Schwarz mit 256GB\r\n', 'Das A35 in klassischem Schwarz ist sowohl elegant als auch leistungsstark. Mit 256GB Speicher und einer robusten Konstruktion ist es für all diejenigen konzipiert, die auf der Suche nach einem zuverlässigen Alltagsbegleiter sind.', 'Samsung', 2, 449.00, 'samsung/Galaxy_A35_256gb_Schwarz.png'),
(29, 'Galaxy A55 in Ice Blue mit 256GB', 'Dieses Smartphone fängt mit seinem eisblauen Finish das Licht auf ansprechende Weise ein. Die Speicherkapazität von 256GB ist für jene ideal, die neben einem auffälligen Design auch praktischen Nutzen schätzen.', 'Samsung', 2, 529.00, 'samsung/Galaxy_A55_256gb_Iceblue.png'),
(30, 'Galaxy S24 Ultra in Titanium mit 512GB', 'Ein absolutes Spitzenmodell, das in auffälligem Titanium Yellow kommt und mit einer Speicherkapazität von beeindruckenden 512GB sowie High-End-Features für ein erstklassiges Nutzererlebnis sorgt.', 'Samsung', 3, 1339.00, 'samsung/Galaxy_S24_Ultra_512gb_Titanium_Yellow.png'),
(31, 'Galaxy Z Flip5 in Graphite mit 256GB', 'Das Z Flip5 ist die Fortsetzung von Samsungs innovativer faltbarer Smartphone-Reihe und bietet in seiner Graphite-Farboption einen Hauch von Understatement. Mit 256GB Speicher eignet es sich ausgezeichnet für diejenigen, die sowohl Stil als auch Substanz ', 'Samsung', 3, 1448.00, 'samsung/GalaxyZ_Flip5_256gb_Graphite.png'),
(32, 'Xiaomi 13T Pro mit 1TB in Schwarz', 'Ein robustes und leistungsstarkes Smartphone, das mit 1TB Speicher keine Wünsche offenlässt. Es ist ideal für Nutzer, die viel Speicherplatz benötigen, z. B. für umfangreiche Mediensammlungen oder anspruchsvolle Anwendungen.', 'Xiaomi', 3, 800.00, 'xiaomi/Xiaomi_13T_Pro1tb_Black.png'),
(33, 'Xiaomi 14 Ultra mit 126GB in Weiß', 'Dieses stilvolle Smartphone in strahlendem Weiß bietet mit 126GB viel Speicherplatz und eine hochwertige Kamera. Sein Ultra-Modell verspricht außergewöhnliche Leistung und fortschrittliche Technologie.', 'Xiaomi', 3, 810.00, 'xiaomi/Xiaomi_14_Ultra_126gb_White.png'),
(34, 'Xiaomi Mi 11 mit 182GB in Silber', 'Mit seinem metallischen Silberfinish ist das Mi 11 ein Blickfang und bietet mit 182GB eine interessante Speichergröße. Es kombiniert ein elegantes Design mit einer soliden Performance.', 'Xiaomi', 1, 120.00, 'xiaomi/Xiaomi_Mi11_182gb_Silver.png'),
(35, 'Xiaomi Mix Fold 3 mit 512GB in Schwarz', 'Ein futuristisches faltbares Smartphone, das mit 512GB Speicher und einem innovativen Design aufwartet. Ideal für diejenigen, die die neueste Technologie in einem kompakten Formfaktor suchen.', 'Xiaomi', 3, 1297.00, 'xiaomi/Xiaomi_mix_Fold3_512gb_Black.png'),
(36, 'Xiaomi 11T Pro mit 256GB in Blau', 'Dieses Modell bietet eine hervorragende Balance aus Leistung und Ästhetik mit einem ansprechenden Blau und 256GB Speicher für umfangreiche Nutzungsmöglichkeiten.', 'Xiaomi', 2, 415.00, 'xiaomi/Xiaomi_11T_Pro_256gb_Blue.png'),
(37, 'Xiaomi 12 Mi mit 128GB in Silber', 'Ein solides und modernes Gerät mit 128GB Speicher, das sich gut für alltägliche Anwendungen eignet und dabei eine ansprechende silberne Rückseite bietet.', 'Xiaomi', 2, 200.00, 'xiaomi/Xiaomi_12Mi_128gb_Silver.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `vorname` varchar(45) NOT NULL,
  `nachname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `vorname`, `nachname`, `email`, `password`, `profile_picture`) VALUES
(15, 'mobisd', 'Moritz', 'Schmid', 'moritz@johann-schmid.at', 'Mobi2903!', 'uploads/cf5e4aaf8dbbed0c485fa18eee5d7ad9.jpg'),
(16, 'admin', 'admin', 'admin', 'admin@admin.com', 'adminpw', 'uploads/default.jpg'),
(27, 'killianldl', 'Kilian', 'Landl', 'kilian.landl@outlook.com', 'Mobi2903!', 'uploads/czgYrPLQ_400x400.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`k_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `k_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produkte`
--
ALTER TABLE `produkte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `produkte` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
