-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2021 at 10:59 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

/*
This file was exported from php my admin and will 
contain all the database tables in the store database
with some input rows that were used in the system.  
*/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`) VALUES
(2, 'Pedro Ordonez', 'admin', 'ecommercsci675@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'Optimum Nutrition'),
(2, 'Jym Supplement Science'),
(3, 'Kaged Muscle '),
(5, 'MuscleTech'),
(6, 'Evlution Nutrition 2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart2`
--

CREATE TABLE `tbl_cart2` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart2`
--

INSERT INTO `tbl_cart2` (`cartId`, `productId`, `quantity`, `sId`) VALUES
(18, 15, 1, 'jrbfdrdluti3mj9mcsmsvp6r14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(2, 'Performance'),
(3, 'Weight Management'),
(4, 'Protein'),
(5, 'Vitamins & Health'),
(11, 'Stack');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `pass`) VALUES
(3, 'Pedro Ordonez', '503 W Polk', 'Hays', 'United States', '80012 ', '7620000000', 'pedroordonez@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(13, 'Pedro Ordonez ', '123 S Washington Street', 'Hays', 'United States', '67601', '0000000000', 'pordonez@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order2`
--

CREATE TABLE `tbl_order2` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `totalPrice` float(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order2`
--

INSERT INTO `tbl_order2` (`orderId`, `userId`, `quantity`, `price`, `totalPrice`, `status`, `date`) VALUES
(107, 3, 1, 136.99, 136.99, 0, '2021-04-10 19:13:34'),
(108, 3, 1, 167.99, 167.99, 0, '2021-04-10 19:13:34'),
(109, 3, 1, 167.99, 167.99, 0, '2021-04-10 19:14:11'),
(110, 3, 2, 136.99, 273.98, 0, '2021-04-10 19:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_history`
--

CREATE TABLE `tbl_order_history` (
  `historyId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `totalPrice` float(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_history`
--

INSERT INTO `tbl_order_history` (`historyId`, `orderId`, `userId`, `productId`, `productName`, `productImage`, `quantity`, `price`, `totalPrice`, `status`, `date`) VALUES
(31, 106, 3, 6, 'Essential AmiN.O. Energy', 'upload/images/ON/ON_amino_energy.jpg', 3, 21.99, 65.97, 1, '2021-04-08 15:55:18'),
(32, 105, 3, 16, 'Shortcut to Size Stack', 'upload/images/Stacks/Jym_ShortCutSize.jpg\r\n', 1, 167.99, 167.99, 1, '2021-04-08 15:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `payment_userId` int(11) NOT NULL,
  `cardname` varchar(255) NOT NULL,
  `cardnumber` varchar(255) NOT NULL,
  `expmonth` varchar(255) NOT NULL,
  `expyear` varchar(255) NOT NULL,
  `cvv` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `payment_userId`, `cardname`, `cardnumber`, `expmonth`, `expyear`, `cvv`) VALUES
(2, 3, 'Pedro Ordonez III', '4790765900239876', 'December', '2022', '001   '),
(5, 13, 'Pedro Ordonez 1', '111111111111111111111', 'November', '2021', '000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(1, 'Gold Standard 100% Whey Protein', 4, 1, '<p>Whey protein isolates are the purest form of whey and the main ingredient in Gold Standard 100% Whey™. Each serving provides 24 grams of rapidly digesting whey protein with low levels of fat, cholesterol, lactose and other stuff you can do without making Gold Standard 100% Whey™ the standard all other proteins are measured against.</p>', 59.99, 'upload/images/ON/ON_protein.jpg', 0),
(3, 'Gold Standard Pre Advanced', 2, 1, '<p>Advanced pre-workout formula for intense energy, pumps, & sports performance\r\nDesigned to help you unleash intense energy, pumps and performance so you can reach the pinnacle of your game and crush your next set.</p>', 34.99, 'upload/images/ON/ON_preworkout.jpg', 0),
(5, 'Micronized Creatine Powder', 2, 1, '<p>An extensively studied sports nutrition ingredient, creatine monohydrate has been shown to support muscle size and strength gains.* ON’s creatine powder has been micronized to stay in solution longer and non-micronized powders, and because it’s unflavored you can stack one rounded teaspoon into your post-workout protein shake or mix the powder into the flavored beverage of your choice.</p>', 37.99, 'upload/images/ON/ON_Creatine.jpg', 0),
(6, 'Essential AmiN.O. Energy', 2, 1, '<p>There are times when you want a hefty dose of caffeine for pre-workout performance*. But on other occasions, like first thing in the morning or a late afternoon pick-me-up, what you’d get from a cup of coffee is more appropriate. Essential Amin.o. Energy™ offers the best of both with a formula that delivers 100mg of caffeine from natural sources per 2-scoop serving. Decrease or increase the energy level as the occasion demands. Each serving provides 5 grams of micronized amino acids for muscle support.</p>', 21.99, 'upload/images/ON/ON_amino_energy.jpg', 0),
(7, 'Opti-Men Multivitamin for Men', 5, 1, '<p>Optimum Nutrition\'s Opti-Men is a complete Nutrient Optimization System providing 70+ active ingredients in 4 blends specifically designed to support the nutrient needs of active men. Taken as a single tablet at breakfast, lunch and dinner, our new & improved multi provides 22 vitamins and essential minerals - including 1,500 IU of Vitamin D, free form amino acids, botanical extracts and antioxidants in foundational amounts that can be built upon through consumption of a healthy balanced diet. Think of Opti-Men as potent nutritional insurance for your fitness lifestyle.</p>', 19.99, 'upload/images/ON/ON_multiVitamin.jpg', 0),
(8, 'Serious Mass Weight Gainer', 2, 1, '<p>Packing a very substantial 1,250 calories into every serving – even more when mixed with cold milk – Serious Mass is the ultimate weight gain formula. With 50 grams of muscle building protein, when used in conjunction with a healthy, balanced diet and regular weight training, this powdered mix provides you with serious weight gaining support for developing your physique to the fullest.</p>', 35.99, 'upload/images/ON/ON_weightgainer.jpg', 0),
(9, 'PRE-KAGED Pre-Workout', 2, 3, '<p>Enhance energy, focus, and blood flow to your body when you need it most to push beyond the point you think you\'re done.*\r\nPre-Kaged is a maximum dosed pre-workout to boost your system for a heightened performance from a premium supplement with natural ingredients to deliver 6.5g of L-Citrulline, BCAAs, Leucine, organic Purcaf Caffeine, anitoxidants, and so much more.</p>', 39.99, 'upload/images/Kaged/Kaged_pre.jpg', 1),
(10, 'Nitro-Tech Protein', 4, 5, '<p>30g of protein per scoop enhanced with creatine, amino acids, only 4g of carbs, and no more than 2.5g of fat!\r\nThe whey protein in Nitro-Tech features high quality whey protein peptides and isolate as its primary source of protein so it\'s absorbed and digested as quickly as possible for faster recovery and better results.</p>', 57.99, 'upload/images/MT/MT_protein.jpg', 1),
(11, 'LeanMode Weight Loss Support', 3, 6, '<p>\r\nStimulant-Free Fat Loss Support.\r\n5 Stimulant-Free Modes Of Fat Burning\r\n</p>', 24.99, 'upload/images/Evlution/Evlution_leanmode.jpg', 1),
(12, 'Pre JYM Pre Workout Powder', 2, 2, '<p>\r\nA fully dosed pre-workout of 13 powerful ingredients working together to prime athletes for intense training sessions every time.\r\nThe non-proprietary legends at Jym have engineered the Pre Jym powerhouse pre-workout to promote muscle growth, increased energy levels, and strength so you can push through longer, more intense workouts in the gym.\r\n</p>', 37.99, 'upload/images/Jym/Jym_pre.jpg', 1),
(13, 'Big Man Advanced Stack', 11, 1, '<h3>Optimum Gold Standard 100% Whey</h3>\r\n<p>\r\nWhey protein is popular with active adults because it digests rapidly and is a rich source of amino acids to support muscle recovery.* Whey protein isolates are the purest form of whey and the primary ingredient in Gold Standard 100% Whey. Each serving provides 24 grams of rapidly digesting whey protein with low levels of fat, cholesterol, lactose and other stuff you can do without. There\'s no doubt this is the standard all other proteins are measured against.\r\n<ul>\r\n<li>Packed with Whey Protein Isolates</li>\r\n<li>Provides Whey Protein Microfractions\r\nMore than 5 Grams of BCAAs</li>\r\n<li>Over 4 Grams of Glutamine & Glutamic Acid</li>\r\n<li>Instantized to Mix with a Spoon</li>\r\n</ul>\r\n</p>\r\n\r\n<h3> Optimum Opti-Men</h3>\r\n<p>\r\nVitamins, minerals and other essential nutrients are the body\'s fundamental building blocks. They support a strong foundation and are responsible for our energy levels, performance and vitality. We have designed Opti-MenTM as a complete Nutrient Optimizaton System.* By packing over 75 active ingredients into one pill, we\'ve created much more than a multi.\r\n\r\nYou shouldn\'t have to throw back a dozen pills or juggle multiple bottles and packs to get your daily nutrients. Opti-MenTM delivers all the essentials in one pill that you take in the morning, noon, and night. Convenient and complete, it\'s the ultimate nutrient system for the active man.\r\n</p>\r\n\r\n<h3>Optimum Fish Oil Softgels</h3>\r\n<p>\r\nOptimum Fish Oil Softgels is a natural supplement filled with Omega-3 essential fatty acids. Fatty acids are the basis of fats and oils, and, despite popular belief, are necessary for overall health. These fatty acids are termed \"essential\" because your body cannot manufacture them by itself. EFA\'s must come from food or supplemental sources. They are also essential because they are a component of every living cell in the body, and are necessary for rebuilding existing cells and the production of new cells.* Studies suggest fish oil supports healthy heart function and joint flexibility.\r\n</p>\r\n\r\n<h3>Optimum Micronized Creatine Powder</h3>\r\n<p>\r\nEach serving supplies a full 5 grams (5000 mg) of 99.9% pure Creapure(tm) brand Creatine Monohydrate. The patented production method used to produce this Creatine yields a tasteless, odorless powder that mixes easily into water or juice and does not readily settle to the bottom. As a result, the gritty taste or texture you may have experienced with other Creatine powders is not associated with this product.\r\n</p>\r\n\r\n<h3>Optimum Gold Standard 100% Casein</h3>\r\n<p>\r\nFaster digesting amino acids are desirable immediately before and after exercise to help refuel recovering muscles, but slow digestion and absorption may be more beneficial at other times – including bedtime when your body typically goes for hours without food.\r\n\r\nCasein proteins are acid sensitive and thicken in the stomach. Compared to some other proteins, it can take more than twice as long for Gold Standard 100% Casein to be broken down into its amino acid subcomponents. By using only premium micellar casein as a protein source, ON has created a formula that sets the standard for slow digesting protein support.\r\n</p>\r\n\r\n<h3>Optimum Essential AmiN.O. Energy</h3>\r\n<p>\r\nEverybody wants a lean, muscular physique. Like anything worth having, wanting it isn\'t enough. You have to commit to a rigorous diet and training program that will tax your strength mentally as well as physically. To help you satisfy both of these demands, ON\'s Essential Amino Energy combines a powerful ratio of rapidly absorbed free-form amino acids with natural energizers and N.O. boosting ingredients to help you reach your next level - including muscle-building BCAAs and arginine to help support intense, vascular pumps.* At 10 calories per serving, it\'ll make a big impression without denting your diet. Mix up Essential Amino Energy anytime you want to dial up mental focus, physical energy N.O. production and recovery support.\r\n</p>', 162.99, 'upload/images/Stacks/ON_BigManStack.jpg', 2),
(14, 'System Stack 4 Lb. Pro', 11, 2, '<h3>JYM Pre JYM</h3>\r\n<ul>\r\n<li>Full doses of 13 science-backed ingredients.</li>\r\n<li>6 grams of citrulline malate to promote better muscle endurance and bigger muscle pumps.*</li>\r\n<li>6 grams of BCAAs in the 2:1:1 ratio best for blunting muscle fatigue, boosting muscle performance, and increasing muscle growth.*</li>\r\n<li>2 grams of creatine HCL for greater strength, endurance, and muscle growth.*</li>\r\n<li>2 grams of beta-alanine to boost muscle power, strength, endurance, and muscle growth.*</li>\r\n<li>1.5 grams of betaine for greater power and strength during workouts.*</li>\r\n<li>600 milligrams of N-acetyl L-cysteine to blunt muscle fatigue and keep you training stronger, longer.*</li>\r\n<li>500 milligrams of betavulgaris L.(beet) extract to provide real nitric oxide donors for bigger pumps and better energy.*</li>\r\n<li>300 milligrams of caffeine to boost alertness and drive, increase muscle strength and endurance, during workouts for greater training intensity.*</li>\r\n<li>300 milligrams of Alpha-Glyceryl Phosphoryl Choline (50%) for better drive, focus, and strength in the gym.*</li>\r\n<li>50 micrograms of huperzine A to increase mental focus and establish a stronger mind-muscle connection.*</li>\r\n<li>5 milligrams of BioPerine to enhance absorption of the active ingredients in Pre JYM for even better results.*</li>\r\n</ul>\r\n<h3>Post JYM Active Matrix</h3>\r\n<ul>\r\n<li>Full doses of 8 science-backed ingredients</li>\r\n<li>6 grams of BCAAs in a 3:1:1 ratio that enhances muscle growth*</li>\r\n<li>3 grams of glutamine for better recovery and growth*</li>\r\n<li>2 grams of creatine HCL for greater strength, endurance, and muscle growth*</li>\r\n<li>2 grams of beta-alanine to boost muscle power, strength, endurance, and muscle growth*</li>\r\n<li>2 grams of Carnipure L-carnitine L-tartrate to aid recovery and put more testosterone to work for you*</li>\r\n<li>1.5 grams of betaine for greater power and strength during workouts*</li>\r\n<li>5 milligrams of BioPerine to enhance absorption of the active ingredients in Post JYM for even better results*\r\n6 grams of Branched-Chain Amino Acids (BCAAs)</li>\r\n</ul>\r\n<li>The BCAAs are three amino acids-leucine, isoleucine, and valine-that share a common structure.</li>\r\n<li>Leucine is the most critical after workouts because it stimulates muscle protein synthesis (i.e., muscle growth) by activating the mTOR complex.*\r\nIt also increases insulin release, which drives more amino acids, creatine, and carnitine from Post JYM into your muscle cells.*</li>\r\n<li>Having a 3:1:1 ratio of leucine to isoleucine to valine in a post-workout product, such as in Pre JYM, provides an extra bit of leucine for maximal muscle growth without compromising the critical role that isoleucine and valine play in this process.*<li>\r\n</ul>\r\n<h3>JYM Post JYM Carb</h3>\r\n<ul>\r\n<li>Research confirms that working out for as little as 30 minutes can deplete muscle glycogen levels by more than 40%. Intense workouts lasting 60-90 minutes would deplete muscle glycogen levels considerably more.</li>\r\n<li>When carbs are consumed immediately postworkout, a supercompensation of muscle glycogen stores is possible. In fact, delaying carb consumption by just 2 hours has been suggested to reduce the rate of glycogen replenishment by 50%.\r\nAnother benefit of high-glcyemic carbs is the insulin spike that they deliver. A post-workout increase in insulin helps maximize the uptake of creatine and carnitine (included in Post JYM Active Ingredients Matrix) by the muscle cells.*</li>\r\n<li>Dextrose is one of the fastest-digesting carbohydrates you can consume. It\'s essentially glucose (what blood sugar is) and therefore needs no digesting and is absorbed by the body almost immediately.*</li>\r\n</ul>\r\n<h3>JYM Pro JYM</h3>\r\n<p>The 24 grams of protein in each scoop of Pro JYM contain the following:</p>\r\n<ul>\r\n<li>Whey Protein Isolate: 7.5g</li>\r\n<li>Micellar Casein: 7g</li>\r\n<li>Egg Albumin: 2.5g</li>\r\n<li>Milk Protein Isolate: 7g (5.5g Casein, 1.5g Whey)</li>\r\n</ul>', 160.99, 'upload/images/Stacks/Jym_SystemStack.jpg', 2),
(15, 'Performance Stack', 11, 1, '<h3>Optimum Gold Standard 100% Whey</h3>\r\n<p>\r\nWhey protein is popular with active adults because it digests rapidly and is a rich source of amino acids to support muscle recovery.* Whey protein isolates are the purest form of whey and the primary ingredient in Gold Standard 100% Whey. Each serving provides 24 grams of rapidly digesting whey protein with low levels of fat, cholesterol, lactose and other stuff you can do without. There\'s no doubt this is the standard all other proteins are measured against.\r\n<ul>\r\n<li>Packed with Whey Protein Isolates</li>\r\n<li>Provides Whey Protein Microfractions\r\nMore than 5 Grams of BCAAs</li>\r\n<li>Over 4 Grams of Glutamine & Glutamic Acid</li>\r\n<li>Instantized to Mix with a Spoon</li>\r\n</ul>\r\n</p>\r\n\r\n<h3> Optimum Opti-Men</h3>\r\n<p>\r\nVitamins, minerals and other essential nutrients are the body\'s fundamental building blocks. They support a strong foundation and are responsible for our energy levels, performance and vitality. We have designed Opti-MenTM as a complete Nutrient Optimizaton System.* By packing over 75 active ingredients into one pill, we\'ve created much more than a multi.\r\n\r\nYou shouldn\'t have to throw back a dozen pills or juggle multiple bottles and packs to get your daily nutrients. Opti-MenTM delivers all the essentials in one pill that you take in the morning, noon, and night. Convenient and complete, it\'s the ultimate nutrient system for the active man.\r\n</p>\r\n\r\n<h3>Optimum Gold Standard 100% Casein</h3>\r\n<p>\r\nFaster digesting amino acids are desirable immediately before and after exercise to help refuel recovering muscles, but slow digestion and absorption may be more beneficial at other times – including bedtime when your body typically goes for hours without food.\r\n\r\nCasein proteins are acid sensitive and thicken in the stomach. Compared to some other proteins, it can take more than twice as long for Gold Standard 100% Casein to be broken down into its amino acid subcomponents. By using only premium micellar casein as a protein source, ON has created a formula that sets the standard for slow digesting protein support.\r\n</p>\r\n\r\n<h3>Optimum Essential AmiN.O. Energy</h3>\r\n<p>\r\nEverybody wants a lean, muscular physique. Like anything worth having, wanting it isn\'t enough. You have to commit to a rigorous diet and training program that will tax your strength mentally as well as physically. To help you satisfy both of these demands, ON\'s Essential Amino Energy combines a powerful ratio of rapidly absorbed free-form amino acids with natural energizers and N.O. boosting ingredients to help you reach your next level - including muscle-building BCAAs and arginine to help support intense, vascular pumps.* At 10 calories per serving, it\'ll make a big impression without denting your diet. Mix up Essential Amino Energy anytime you want to dial up mental focus, physical energy N.O. production and recovery support.\r\n</p>', 136.99, 'upload/images/Stacks/ON_PerformanceStack.jpg', 2),
(16, 'Shortcut to Size Stack', 11, 2, '<h3>JYM Pre JYM</h3>\r\n<ul>\r\n<li>Full doses of 13 science-backed ingredients.</li>\r\n<li>6 grams of citrulline malate to promote better muscle endurance and bigger muscle pumps.*</li>\r\n<li>6 grams of BCAAs in the 2:1:1 ratio best for blunting muscle fatigue, boosting muscle performance, and increasing muscle growth.*</li>\r\n<li>2 grams of creatine HCL for greater strength, endurance, and muscle growth.*</li>\r\n<li>2 grams of beta-alanine to boost muscle power, strength, endurance, and muscle growth.*</li>\r\n<li>1.5 grams of betaine for greater power and strength during workouts.*</li>\r\n<li>600 milligrams of N-acetyl L-cysteine to blunt muscle fatigue and keep you training stronger, longer.*</li>\r\n<li>500 milligrams of betavulgaris L.(beet) extract to provide real nitric oxide donors for bigger pumps and better energy.*</li>\r\n<li>300 milligrams of caffeine to boost alertness and drive, increase muscle strength and endurance, during workouts for greater training intensity.*</li>\r\n<li>300 milligrams of Alpha-Glyceryl Phosphoryl Choline (50%) for better drive, focus, and strength in the gym.*</li>\r\n<li>50 micrograms of huperzine A to increase mental focus and establish a stronger mind-muscle connection.*</li>\r\n<li>5 milligrams of BioPerine to enhance absorption of the active ingredients in Pre JYM for even better results.*</li>\r\n</ul>\r\n<h3>Post JYM Active Matrix</h3>\r\n<ul>\r\n<li>Full doses of 8 science-backed ingredients</li>\r\n<li>6 grams of BCAAs in a 3:1:1 ratio that enhances muscle growth*</li>\r\n<li>3 grams of glutamine for better recovery and growth*</li>\r\n<li>2 grams of creatine HCL for greater strength, endurance, and muscle growth*</li>\r\n<li>2 grams of beta-alanine to boost muscle power, strength, endurance, and muscle growth*</li>\r\n<li>2 grams of Carnipure L-carnitine L-tartrate to aid recovery and put more testosterone to work for you*</li>\r\n<li>1.5 grams of betaine for greater power and strength during workouts*</li>\r\n<li>5 milligrams of BioPerine to enhance absorption of the active ingredients in Post JYM for even better results*\r\n6 grams of Branched-Chain Amino Acids (BCAAs)</li>\r\n</ul>\r\n<li>The BCAAs are three amino acids-leucine, isoleucine, and valine-that share a common structure.</li>\r\n<li>Leucine is the most critical after workouts because it stimulates muscle protein synthesis (i.e., muscle growth) by activating the mTOR complex.*\r\nIt also increases insulin release, which drives more amino acids, creatine, and carnitine from Post JYM into your muscle cells.*</li>\r\n<li>Having a 3:1:1 ratio of leucine to isoleucine to valine in a post-workout product, such as in Pre JYM, provides an extra bit of leucine for maximal muscle growth without compromising the critical role that isoleucine and valine play in this process.*<li>\r\n</ul>\r\n<h3>JYM Post JYM Carb</h3>\r\n<ul>\r\n<li>Research confirms that working out for as little as 30 minutes can deplete muscle glycogen levels by more than 40%. Intense workouts lasting 60-90 minutes would deplete muscle glycogen levels considerably more.</li>\r\n<li>When carbs are consumed immediately postworkout, a supercompensation of muscle glycogen stores is possible. In fact, delaying carb consumption by just 2 hours has been suggested to reduce the rate of glycogen replenishment by 50%.\r\nAnother benefit of high-glcyemic carbs is the insulin spike that they deliver. A post-workout increase in insulin helps maximize the uptake of creatine and carnitine (included in Post JYM Active Ingredients Matrix) by the muscle cells.*</li>\r\n<li>Dextrose is one of the fastest-digesting carbohydrates you can consume. It\'s essentially glucose (what blood sugar is) and therefore needs no digesting and is absorbed by the body almost immediately.*</li>\r\n</ul>\r\n<h3>Mass JYM</h3>\r\n<p>Mass JYM™ is a revolutionary mass-gain formula that has taken years to perfect. It’s the first of its kind, a true non-proprietary mass-gainer that fully discloses the specific types of protein, carbohydrates, and fat contained so that you know exactly how much of each macronutrient you’re consuming.\r\n\r\nEach serving of Mass JYM provides:</p>\r\n<ul>\r\n<li>30g Protein (15 grams casein, 12 grams whey, 3 grams egg protein)</li>\r\n<li>30g Carbs (15 grams low-glycemic index (GI), 5 grams high-GI)</li>\r\n<li>Nearly 5 grams of fat (1.3 grams saturated fat, 1.3 grams monounsaturated fat, 1.3 grams polyunsaturated fat, including 1 gram of CLA)</li>\r\n</ul>', 167.99, 'upload/images/Stacks/Jym_ShortCutSize.jpg\r\n', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_orders`
--

CREATE TABLE `tbl_product_orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_orders`
--

INSERT INTO `tbl_product_orders` (`id`, `product_id`, `order_id`) VALUES
(102, 15, 107),
(103, 16, 108),
(104, 16, 109),
(105, 15, 110);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wlist2`
--

CREATE TABLE `tbl_wlist2` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart2`
--
ALTER TABLE `tbl_cart2`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `product_id_fk` (`productId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order2`
--
ALTER TABLE `tbl_order2`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `user_id_fk` (`userId`);

--
-- Indexes for table `tbl_order_history`
--
ALTER TABLE `tbl_order_history`
  ADD PRIMARY KEY (`historyId`),
  ADD KEY `orderid_fk` (`orderId`),
  ADD KEY `user_identifcation_fk` (`userId`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_userId_fk` (`payment_userId`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `catId` (`catId`),
  ADD KEY `brandId` (`brandId`);

--
-- Indexes for table `tbl_product_orders`
--
ALTER TABLE `tbl_product_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id_fk` (`product_id`),
  ADD KEY `tbl_product_orders_ibfk_1` (`order_id`);

--
-- Indexes for table `tbl_wlist2`
--
ALTER TABLE `tbl_wlist2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId_fk` (`userId`),
  ADD KEY `productId_fk` (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_cart2`
--
ALTER TABLE `tbl_cart2`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_order2`
--
ALTER TABLE `tbl_order2`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `tbl_order_history`
--
ALTER TABLE `tbl_order_history`
  MODIFY `historyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_product_orders`
--
ALTER TABLE `tbl_product_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tbl_wlist2`
--
ALTER TABLE `tbl_wlist2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart2`
--
ALTER TABLE `tbl_cart2`
  ADD CONSTRAINT `product_id_fk` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`);

--
-- Constraints for table `tbl_order2`
--
ALTER TABLE `tbl_order2`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`userId`) REFERENCES `tbl_customer` (`id`);

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `payment_userId_fk` FOREIGN KEY (`payment_userId`) REFERENCES `tbl_customer` (`id`);

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `tbl_category` (`catId`),
  ADD CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `tbl_brand` (`brandId`);

--
-- Constraints for table `tbl_product_orders`
--
ALTER TABLE `tbl_product_orders`
  ADD CONSTRAINT `tbl_product_orders_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order2` (`orderId`),
  ADD CONSTRAINT `tbl_product_orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`productId`);

--
-- Constraints for table `tbl_wlist2`
--
ALTER TABLE `tbl_wlist2`
  ADD CONSTRAINT `productId_fk` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`),
  ADD CONSTRAINT `userId_fk` FOREIGN KEY (`userId`) REFERENCES `tbl_customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
