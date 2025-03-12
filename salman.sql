-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 10:52 PM
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
-- Database: `salman`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  `category_name_en` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_name_en`) VALUES
(1, 'اطلاعیه‌ها', 'Announcements'),
(2, 'اردو و گردش ها', 'Field Trips and Excursions'),
(3, 'اعلامیه‌ها', 'Announcements'),
(4, 'والدین و اولیای دانش‌آموزان', 'Parents and Guardians'),
(5, 'فعالیت‌های فرهنگی و هنری', 'Cultural and Artistic Activities'),
(7, 'گالری تصاویر', 'Image Gallery'),
(8, 'فعالیت‌های ورزشی', 'Sports Activities'),
(9, 'موفقیت‌های دانش‌آموزان', 'Student Achievements'),
(10, 'دانستنی‌ها', 'Educational Resources'),
(11, 'مجله دانش آموزی', 'School Magazine'),
(12, 'فارغ التحصیلی', 'Graduation'),
(13, 'پزشکی و کلینیک', 'Medical and Health'),
(14, 'اخبار و رویدادها', 'News and Events'),
(15, 'مراسمات ', 'Ceremonies and Events');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `submit_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `subject`, `message`, `submit_date`) VALUES
(1, 'Felicia Cortez', 'dapu@mailinator.com', '+1 (927) 426-1049', 'Reprehenderit sunt', 'Velit at rem aliqua', '2025-03-12 16:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'vixyl@mailinator.com', 'active', '2025-03-12 20:02:28', '2025-03-12 20:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `publish_date` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_en` text NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `content1` text NOT NULL,
  `content1_en` text NOT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `content2` text DEFAULT NULL,
  `content2_en` text DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `slug`, `publish_date`, `title`, `title_en`, `main_image`, `content1`, `content1_en`, `image1`, `image2`, `content2`, `content2_en`, `views`, `category_id`) VALUES
(1, 'Servants-of-the-Nation-on-a-Heavenly-Journey:-Details-of-the-Martyrdom-of-Ayatollah-Raisi-and-Companions', '2024-05-19 08:59:20', 'خادمین ملت در سفر آسمانی: جزئیات شهادت آیت الله رئیسی و همراهان', 'Servants of the Nation on a Heavenly Journey: Details of the Martyrdom of Ayatollah Raisi and Companions', 'reisi.png', 'با نهایت تأسف و اندوه عمیق، مجتمع آموزشی سلمان به شهادت آیت الله سید ابراهیم رئیسی، هشتمین رئیس جمهور ایران و همراهان انقلابی ایشان، که در پی سانحه هوایی در منطقه ورزقان استان آذربایجان شرقی، به دیار باقی رفتند، تسلیت و همدردی عمیق خود را اعلام می‌دارد.\n\nرئیسی، شخصیتی که با ایده‌آل‌های انقلابی و ارزش‌های اسلامی، هدایت و رهبری کشور را به عهده داشت، در این سانحه تلخ و بی‌درنگ از میان ما رفت. وی با پایبندی به انقلاب و خدمت به ملت ایران، به عنوان یک رهبر مجاهد و پرتلاش، زندگی خود را پر کرده بود.\n\nشهادت آیت الله رئیسی و همراهانش برای ما عمیقاً دل‌شکسته کننده است، اما این درسی است که ما را به پایبندی بیشتر به ارزش‌ها و اهداف انقلاب دعوت می‌کند. امروز، ما افتخار می‌کنیم که رئیسی و همراهانش را در این مسیر افتخارآفرین و پرشور، می‌شناسیم و از خداوند برای آنان آمرزش و غفران می‌طلبیم.', 'With utmost sorrow and profound grief, the Salman Educational Complex announces its deepest condolences and sympathy for the martyrdom of Ayatollah Seyyed Ebrahim Raisi, the eighth President of Iran, and his revolutionary companions, who departed to the eternal abode following an air accident in the Varzaqan region of East Azerbaijan Province.\n\nRaisi, a figure who guided and led the country with revolutionary ideals and Islamic values, tragically and suddenly passed away in this bitter incident. His life was dedicated to the revolution and serving the Iranian nation as a diligent and devoted leader.\n\nThe martyrdom of Ayatollah Raisi and his companions deeply saddens us, but it also serves as a lesson, calling us to further commit to the values and goals of the revolution. Today, we take pride in knowing Raisi and his companions on this honorable and passionate path, and we pray to God for their forgiveness and mercy.', 'AyatollahRaisi1.png', 'AyatollahRaisi2.png', 'روح بلند رئیس جمهور مجاهد و همراهان ایشان به سوی ملکوت اعلی پیوسته‌اند و ما از خداوند متعال برای آنان آرامش و بخشش مسئلت داریم. امیدواریم که خداوند، خانواده‌های محترمشان را در این لحظات سخت به عزت و صبر برساند و ایران را از رهبران و رهنمایان متعهد و با وجدانی همچون آیت الله سید ابراهیم رئیسی پرورش دهد.', 'The noble souls of the diligent President and his companions have ascended to the highest heavens, and we pray to Almighty God for their peace and forgiveness. We hope that God grants their esteemed families dignity and patience in these difficult times and that Iran continues to be blessed with committed and conscientious leaders and guides like Ayatollah Seyyed Ebrahim Raisi.', 2, 3),
(2, 'Anniversary-of-Imam-Khomeini\'s-Demise;-Father-of-the-Islamic-Revolution', '2024-06-03 00:00:00', 'سالگرد رحلت امام خمینی (ره)؛ پدر انقلاب اسلامی', 'Anniversary of Imam Khomeini\'s Demise; Father of the Islamic Revolution', 'imam-khomeini.png', 'امروز سالگرد رحلت بنیانگذار کبیر انقلاب اسلامی و معمار نظام جمهوری اسلامی، حضرت امام خمینی (ره) است. امام خمینی با تأسیس نظام نوین اسلامی و رهبری انقلاب شکوهمند ایران، تحولی عظیم را در تاریخ معاصر جهان اسلام رقم زد و نام خود را در قلوب مستضعفان جهان جاودانه ساخت.\n\nایشان با تکیه بر ارزش‌های اصیل اسلامی و آرمان‌های انقلاب، مسیر حرکت جامعه ایرانی را به سوی عدالت، آزادی و استقلال هدایت کردند و الگوی مقاومت و ایستادگی در برابر ظلم و استکبار را به جهانیان نشان دادند. امروز ملت ایران با گرامیداشت یاد و خاطره آن عالم ربانی و رهبر فرزانه، پیمان خود را با آرمان‌های انقلاب تجدید می‌کنند.', 'Today marks the anniversary of the demise of the great founder of the Islamic Revolution and the architect of the Islamic Republic system, Imam Khomeini (ra). Imam Khomeini, by establishing the new Islamic system and leading the glorious Iranian Revolution, brought about a monumental transformation in the contemporary history of the Islamic world and eternalized his name in the hearts of the oppressed around the globe.\n\nRelying on genuine Islamic values and the ideals of the revolution, he guided the Iranian society\'s path towards justice, freedom, and independence. He showcased a model of resistance and steadfastness against oppression and arrogance to the world. Today, the Iranian nation, by commemorating the memory of that divine scholar and wise leader, renews its covenant with the ideals of the revolution.', 'imam-khomeini1.png', 'imam-khomeini2.png', 'آری، راه امام خمینی (ره) همچنان روشن و پرفروغ است و ملت ایران با الهام از آرمان‌های واﻻی ایشان، به پیشرفت و ترقی در عرصه‌های مختلف ادامه خواهند داد. یاد و نام آن رهبر کبیر و شهید راه آزادی، همیشه در قلوب ما زنده و جاویدان خواهد ماند.', 'Indeed, the path of Imam Khomeini (ra) remains bright and radiant, and the Iranian nation, inspired by his lofty ideals, will continue to progress and advance in various fields. The memory and name of that great leader and martyr of the path of freedom will forever live on in our hearts.', 1, 3),
(3, 'Ancient-Nowruz,-A-New-Beginning', '2024-03-20 00:00:00', 'نوروز باستانی، آغازی دوباره', 'Ancient Nowruz, A New Beginning', 'nowruz.png', 'فرارسیدن سال نو و آغاز بهار طبیعت، فرصتی است برای زدودن غبار غم از دل‌ها و تجدید روحیه امید و نشاط در کالبد جامعه. ایران باستان، ایران اسلامی و ایران معاصر، همگی شاهد جشن‌های رنگارنگ نوروزی بوده‌اند؛ جشنی که ریشه در فرهنگ غنی این سرزمین کهن دارد.\n\nنوروز، تجلی بازگشت حیات و سرسبزی به طبیعت است. این جشن کهن، نمادی از دوام، پایداری و ظرفیت بازآفرینی در وجود انسان و طبیعت است. آری، نوروز یادآور این حقیقت است که پس از هر سرمایی، بهاری خواهد آمد و زندگی را دوباره سرشار از امید و نشاط خواهد کرد.', 'The arrival of the new year and the beginning of spring is an opportunity to wipe away the dust of sorrow from our hearts and renew the spirit of hope and joy in the fabric of society. Ancient Iran, Islamic Iran, and contemporary Iran have all witnessed the colorful celebrations of Nowruz - a festivity rooted in the rich culture of this ancient land.\n\nNowruz is the manifestation of life\'s return and the revival of greenery in nature. This ancient celebration symbolizes endurance, resilience, and the capacity for rebirth within humans and nature. Indeed, Nowruz reminds us of the truth that after every winter, a spring will come, and life will be filled with hope and joy once again.', 'nowruz1.png', 'nowruz2.png', 'مجتمع آموزشی سلمان، ضمن گرامیداشت این جشن باستانی و آرزوی سالی سرشار از موفقیت و پیروزی برای ملت شریف ایران، از همه هموطنان عزیز دعوت می‌کند تا با الهام از پیام نوروز، افق‌های جدیدی را در زندگی فردی و اجتماعی خود بگشایند و در مسیر کمال و ترقی گام بردارند.', 'The Salman Educational Complex, while honoring this ancient celebration and wishing a year filled with success and victory for the noble Iranian nation, invites all dear compatriots to be inspired by the message of Nowruz, open new horizons in their personal and social lives, and take steps towards perfection and progress.', 1, 14),
(4, '45th-Anniversary-of-the-Islamic-Revolution\'s-Victory', '2024-02-11 00:00:00', 'چهل و پنجمین سالگرد پیروزی انقلاب اسلامی', '45th Anniversary of the Islamic Revolution\'s Victory', 'revolution.png', 'در چهل و پنجمین بهار آزادی، یاد و خاطره رهبر کبیر انقلاب اسلامی، حضرت امام خمینی (ره) و شهدای گرانقدر را گرامی می‌داریم. 22 بهمن 1357، نقطه عطفی در تاریخ معاصر ایران بود که با پیروزی انقلاب اسلامی، ملت ایران توانست از یوغ استبداد و استعمار رهایی یابد.\n\nانقلاب اسلامی ایران با الهام از آموزه‌های اسلام ناب محمدی (ص)، افق‌های تازه‌ای را برای استقلال، آزادی و عدالت اجتماعی در برابر ملت ایران گشود. این انقلاب الهام‌بخش ملت‌های مسلمان و مستضعفان جهان شد تا در مقابل ظلم و استکبار ایستادگی کنند.', 'On the 45th spring of freedom, we honor the memory of the great leader of the Islamic Revolution, Imam Khomeini (ra), and the esteemed martyrs. The 22nd of Bahman, 1357 (February 11, 1979) was a turning point in contemporary Iranian history when the victory of the Islamic Revolution liberated the Iranian nation from the yoke of despotism and colonialism.\n\nThe Iranian Islamic Revolution, inspired by the pure teachings of Islam brought by Prophet Muhammad (pbuh), opened new horizons for independence, freedom, and social justice for the Iranian people. This revolution inspired Muslim nations and the oppressed around the world to stand up against oppression and arrogance.', 'revolution1.png', 'revolution2.png', 'امروز، ملت ایران با افتخار در مسیر انقلاب اسلامی گام برمی‌دارد و برای تحقق آرمان‌های والای آن تلاش می‌کند. پیروزی انقلاب اسلامی، نوید بخش آینده‌ای روشن برای ایران عزیز و کل جهان اسلام است. ما ضمن گرامیداشت یاد شهدا، پایبندی خود را به ارزش‌های انقلاب اسلامی تجدید می‌کنیم.', 'Today, the Iranian nation proudly treads the path of the Islamic Revolution and strives to realize its lofty ideals. The victory of the Islamic Revolution heralds a bright future for dear Iran and the entire Islamic world. As we honor the memory of the martyrs, we renew our commitment to the values of the Islamic Revolution.', 1, 3),
(5, 'Decade-of-Revelation-of-the-Islamic-Revolution,-Symbol-of-Resistance-and-Perseverance', '2024-02-01 09:00:00', 'دهه فجر انقلاب اسلامی، نماد مقاومت و پایداری', 'Decade of Revelation of the Islamic Revolution, Symbol of Resistance and Perseverance', 'fajr-decade.png', 'دهه فجر انقلاب اسلامی، یادآور روزهای پرافتخار و حماسه‌آفرین ملت ایران در پیروزی بر رژیم ستمشاهی پهلوی و استقرار نظام مقدس جمهوری اسلامی است. این دهه فرخنده، نمادی از اراده آهنین و ایستادگی ملت در برابر ظلم و استکبار جهانی است.\n\nدر دهه فجر، ایرانیان از هر قوم و قبیله، متحد و یکصدا برای رهایی از چنگال استبداد و استعمار به پا خاستند و با رهبری امام خمینی (ره)، انقلابی شکوهمند را رقم زدند که جهان را متحیر ساخت. این انقلاب الهام‌بخش ملت‌های مسلمان و مستضعفان جهان شد تا در مقابل ظلم و استکبار بایستند.', 'The Decade of Revelation of the Islamic Revolution reminds us of the glorious and epic days when the Iranian nation triumphed over the oppressive Pahlavi monarchy and established the sacred system of the Islamic Republic. This auspicious decade symbolizes the iron will and steadfastness of the nation against global oppression and arrogance.\n\nDuring the Decade of Revelation, Iranians of all ethnicities and tribes united and rose in unison to liberate themselves from the clutches of despotism and colonialism, and under the leadership of Imam Khomeini (ra), they brought about a magnificent revolution that astonished the world. This revolution inspired Muslim nations and the oppressed around the globe to stand up against oppression and arrogance.', 'fajr-decade1.png', 'fajr-decade2.png', 'امروز، ملت ایران با افتخار در مسیر انقلاب اسلامی گام برمی‌دارد و برای تحقق آرمان‌های والای آن تلاش می‌کند. دهه فجر، یادآور این حقیقت است که هیچ قدرتی نمی‌تواند در برابر اراده ملتی آزاده و مؤمن ایستادگی کند. ما با گرامیداشت یاد شهدا و رهنمودهای امام راحل، پیمان خود را با آرمان‌های انقلاب اسلامی تجدید می‌کنیم.', 'Today, the Iranian nation proudly treads the path of the Islamic Revolution and strives to realize its lofty ideals. The Decade of Revelation reminds us of the truth that no power can withstand the will of a free and faithful nation. By honoring the memory of the martyrs and the guidance of the late Imam, we renew our covenant with the ideals of the Islamic Revolution.', 0, 14),
(6, 'Eid-al-Fitr,-Celebration-of-the-End-of-Ramadan', '2024-02-02 00:00:00', 'عید سعید فطر، جشن پایان ماه رمضان', 'Eid al-Fitr, Celebration of the End of Ramadan', 'eid-fitr.png', 'عید سعید فطر، پایان ماه مبارک رمضان و جشن روزه‌داران است. این عید بزرگ اسلامی، نمادی از پیروزی انسان بر نفس اماره و گامی در مسیر تزکیه و تقرب به خداوند متعال است. در این روز پرخیر و برکت، مسلمانان جهان با دل‌هایی پاک و روح‌هایی معنوی، شادی و سرور را جشن می‌گیرند.\n\nعید فطر، یادآور این حقیقت است که انسان با پرهیزگاری و خویشتن‌داری می‌تواند بر نفس اماره خود غلبه کند و به کمال معنوی دست یابد. این عید، فرصتی برای بازگشت به فطرت پاک انسانی و تجدید پیمان با آموزه‌های اخلاقی و معنوی دین مبین اسلام است.', 'Eid al-Fitr marks the end of the blessed month of Ramadan and is the celebration of those who have fasted. This great Islamic festival symbolizes the triumph of human beings over their carnal desires and is a step towards purification and nearness to Almighty God. On this blessed and auspicious day, Muslims around the world celebrate joy and delight with pure hearts and spiritual souls.\n\nEid al-Fitr reminds us of the truth that through piety and self-restraint, human beings can overcome their carnal desires and attain spiritual perfection. This festival is an opportunity to return to the pure human nature and renew our covenant with the moral and spiritual teachings of the noble religion of Islam.', 'eid-fitr1.png', 'eid-fitr2.png', 'مجتمع آموزشی سلمان، ضمن تبریک این عید سعید به همه مسلمانان جهان، از خداوند متعال مسئلت دارد تا توفیق خدمت به خلق را به همگان عنایت فرماید. امید است در سایه الطاف الهی، جامعه اسلامی ما بیش از پیش در مسیر کمال و سعادت حرکت کند و پیام صلح، برادری و دوستی را به جهانیان منتقل سازد.', 'The Salman Educational Complex, while extending its congratulations on this blessed Eid to all Muslims around the world, prays to Almighty God to grant everyone the opportunity to serve His creation. It is hoped that under the shadow of divine blessings, our Islamic society will further advance on the path of perfection and felicity, and convey the message of peace, brotherhood, and friendship to the world.', 0, 14),
(7, 'Eid-al-Ghadir,-The-Eternal-Manifestation-of-Guardianship-and-Leadership', '2023-07-27 12:00:00', 'عید غدیر، تجلی جاودانه ولایت و رهبری', 'Eid al-Ghadir, The Eternal Manifestation of Guardianship and Leadership', 'eid-ghadir.png', 'عید سعید غدیر خم، یادآور واقعه تاریخی و ماندگار تعیین جانشین پیامبر اکرم (صلی الله علیه و آله و سلم) در روز هجدهم ذی الحجه سال دهم هجری است. در این روز خجسته، پیامبر گرامی اسلام (ص) امیرالمؤمنین علی (علیه السلام) را به عنوان جانشین و ولی امر مسلمانان معرفی کردند.\n\nغدیر خم، تجلی جاودانه مفهوم ولایت و رهبری در اسلام است. این واقعه تاریخی، خط بطلانی بر تمامی باورها و اندیشه‌های ضد ولایت و امامت کشید و مسیر هدایت و سعادت بشریت را برای همیشه روشن ساخت. امروز مسلمانان جهان، عید غدیر را گرامی می‌دارند تا زنده نگه‌دارنده میراث گرانبهای ولایت و پیوند ناگسستنی خود با سلسله پاک ائمه اطهار (علیهم السلام) باشند.', 'Eid al-Ghadir commemorates the historical and enduring event of the appointment of the successor to the Holy Prophet (peace be upon him and his household) on the 18th of Dhu al-Hijjah in the 10th year after Hijrah. On this auspicious day, the noble Prophet of Islam (pbuh) introduced Amir al-Mu\'minin Ali (peace be upon him) as the successor and guardian of the Muslims.\n\nGhadir Khumm is the eternal manifestation of the concept of guardianship and leadership in Islam. This historical event struck a line of invalidity through all beliefs and thoughts against guardianship and Imamate, and forever illuminated the path of guidance and felicity for humanity. Today, Muslims around the world honor Eid al-Ghadir to keep alive the precious legacy of guardianship and their inseparable bond with the pure progeny of the Imams (peace be upon them).', 'eid-ghadir1.png', 'eid-ghadir2.png', 'مجتمع آموزشی سلمان، ضمن گرامیداشت این عید سعید، از خداوند متعال مسئلت دارد تا توفیق پیروی از منویات و رهنمودهای ائمه معصومین (علیهم السلام) را به همگان عنایت فرماید. امید است در سایه الطاف الهی و با تأسی به سیره ائمه اطهار (علیهم السلام)، جامعه اسلامی ما در مسیر کمال و سعادت گام بردارد و پیام وحدت، یکپارچگی و پایبندی به ولایت را به جهانیان منتقل سازد.', 'The Salman Educational Complex, while commemorating this blessed Eid, prays to Almighty God to grant everyone the opportunity to follow the teachings and guidance of the infallible Imams (peace be upon them). It is hoped that under the shadow of divine blessings and by following the exemplary conduct of the pure Imams (peace be upon them), our Islamic society will advance on the path of perfection and felicity, and convey the message of unity, solidarity, and adherence to guardianship to the world.', 1, 14),
(8, 'Eid-al-Adha,-Symbol-of-Sacrifice-in-the-Way-of-God', '2023-06-28 00:00:00', 'عید قربان، نماد فداکاری در راه خدا', 'Eid al-Adha, Symbol of Sacrifice in the Way of God', 'eid-qurban.png', 'عید سعید قربان، یادآور حماسه جاودان حضرت ابراهیم خلیل (علیه السلام) است؛ حماسه‌ای که در آن، پیامبر بزرگ خدا با قربانی کردن فرزند دلبندش اسماعیل (علیه السلام)، اوج ایمان، اطاعت و فداکاری در راه خداوند متعال را به نمایش گذاشت. این واقعه تاریخی، درس بزرگی برای انسان‌ها دارد که باید در مسیر بندگی و عبودیت خداوند، از هیچ فداکاری دریغ نورزند.امروز، مسلمانان جهان با قربانی کردن گوسفندان، یاد این حماسه بزرگ را زنده نگه می‌دارند و پیام معنوی آن را به نسل‌های آینده منتقل می‌کنند. عید قربان، نمادی از پیروزی روح بر جسم و غلبه انسان بر نفس اماره است؛ فرصتی برای تقرب به خداوند و تجدید پیمان با آموزه‌های اخلاقی و معنوی دین مبین اسلام.', 'Eid al-Adha commemorates the eternal epic of Prophet Abraham (peace be upon him), where the great prophet of God demonstrated the pinnacle of faith, obedience, and sacrifice in the way of Almighty God by sacrificing his beloved son Ismail (peace be upon him). This historical event holds a great lesson for humanity – that one must not hesitate to make any sacrifice in the path of servitude and devotion to God.\n\nToday, Muslims around the world keep the memory of this great epic alive by sacrificing sheep and convey its spiritual message to future generations. Eid al-Adha symbolizes the triumph of the soul over the body and the human being s victory over carnal desires; it is an opportunity to draw closer to God and renew the covenant with the moral and spiritual teachings of the noble religion of Islam.', 'eid-qurban1.png', 'eid-qurban2.png', 'مجتمع آموزشی سلمان، ضمن تبریک این عید سعید به همه مسلمانان جهان، از خداوند متعال مسئلت دارد تا توفیق خدمت به خلق و پیروی از آموزه‌های دین مبین اسلام را به همگان عنایت فرماید. امید است در سایه الطاف الهی، جامعه اسلامی ما بیش از پیش در مسیر کمال و سعادت حرکت کند و پیام صلح، برادری، ایثارگری و فداکاری در راه خدا را به جهانیان منتقل سازد.', 'The Salman Educational Complex, while extending its congratulations on this blessed Eid to all Muslims around the world, prays to Almighty God to grant everyone the opportunity to serve His creation and follow the teachings of the noble religion of Islam. It is hoped that under the shadow of divine blessings, our Islamic society will further advance on the path of perfection and felicity, and convey the message of peace, brotherhood, self-sacrifice, and devotion in the way of God to the world.', 0, 14),
(9, 'Teachers\'-Day,-Honoring-the-Enlightened-and-Standard-bearers-of-Knowledge', '2024-05-01 10:00:00', 'روز معلم، گرامیداشت فرهیختگان و پرچمداران دانش', 'Teachers\' Day, Honoring the Enlightened and Standard-bearers of Knowledge', 'teachers-day.png', 'امروز، روز گرامیداشت معلمان و استادان فرهیخته و دانشمند است؛ کسانی که با تلاش و جانفشانی خود، نور علم و معرفت را در جامعه می‌درخشانند و راه را برای آیندگان روشن می‌سازند. معلمان، پرچمداران دانش و معرفت هستند که با صبر و استقامت، نسل‌های آینده را برای ساختن جامعه‌ای سالم و پویا آماده می‌کنند.\n\nمعلمان، مروجان فرهنگ و ارزش‌های انسانی و اخلاقی در جامعه هستند. آنها با انتقال علم و دانش به دانش‌آموزان، زمینه‌ساز پیشرفت و ترقی جامعه می‌شوند. لذا، قدردانی و تکریم از این قشر فرهیخته و فداکار، وظیفه‌ای انسانی و ملی است که باید همواره مورد توجه قرار گیرد.', 'Today, we honor the enlightened and knowledgeable teachers and professors – those who, through their efforts and dedication, illuminate the light of knowledge and understanding in society and pave the way for future generations. Teachers are the standard-bearers of knowledge and wisdom, who, with patience and perseverance, prepare the generations to come for building a healthy and vibrant society.\n\nTeachers are the promoters of culture and human and moral values in society. Through imparting knowledge and wisdom to students, they lay the foundation for the progress and advancement of society. Therefore, expressing gratitude and honoring this enlightened and selfless community is a human and national duty that should always be a priority.', 'teachers-day1.png', 'teachers-day2.png', 'مجتمع آموزشی سلمان، ضمن گرامیداشت روز معلم، از تلاش‌های خستگی‌ناپذیر این عزیزان قدردانی می‌کند و برای همه معلمان و استادان، آرزوی توفیق روزافزون در راه تربیت نسل‌های آینده‌ساز و پیشرفت جامعه دارد. امید است با همت و تلاش همگانی، جامعه ایرانی ما در مسیر کمال و ترقی گام بردارد و پیام صلح، دانش و فرهنگ را به جهانیان منتقل سازد.', 'The Salman Educational Complex, while commemorating Teachers\' Day, expresses its gratitude for the tireless efforts of these esteemed individuals and wishes all teachers and professors continued success in nurturing the future generations and contributing to the progress of society. It is hoped that through the collective efforts and dedication of all, our Iranian society will advance on the path of perfection and progress, and convey the message of peace, knowledge, and culture to the world.', 0, 14),
(10, 'The-Start-of-the-New-Gregorian-Year,-an-Opportunity-for-Renewal-and-Innovation', '2024-01-01 00:00:00', 'آغاز سال نو میلادی، فرصتی برای تازگی و نوآوری', 'The Start of the New Gregorian Year, an Opportunity for Renewal and Innovation', 'new-year.png', 'با گذر از آخرین روزهای سال میلادی و آغاز سال نو، فرصتی دیگر برای تازگی، نوآوری و بازنگری در زندگی فردی و اجتماعی ما فراهم می‌شود. سال نو میلادی، یادآور این حقیقت است که زندگی همواره در حال تحول و دگرگونی است و انسان‌ها باید خود را برای پذیرش تغییرات و چالش‌های جدید آماده کنند.\n\nدر آستانه سال جدید، فرصتی مناسب برای ارزیابی دستاوردها و کاستی‌های گذشته و تدوین برنامه‌های جدید برای آینده پیش روی ماست. این روزها، زمانی برای بازنگری در اهداف و آرمان‌های خود، تقویت روحیه امید و نوآوری و گام برداشتن در مسیری نو برای پیشرفت و ترقی جامعه است.', 'As we move past the final days of the Gregorian year and into the new year, another opportunity arises for renewal, innovation, and reflection in our personal and social lives. The new Gregorian year reminds us of the truth that life is constantly evolving and changing, and human beings must be prepared to embrace new transformations and challenges.\n\nOn the eve of the new year, we have a suitable opportunity to evaluate our past achievements and shortcomings and develop new plans for the future ahead of us. These days are a time to revisit our goals and ideals, strengthen the spirit of hope and innovation, and take steps in a new direction towards societal progress and advancement.', 'new-year1.png', 'new-year2.png', 'مجتمع آموزشی سلمان، ضمن تبریک آغاز سال نو میلادی به همه عزیزان، از خداوند متعال مسئلت دارد تا سالی سرشار از موفقیت، پیشرفت و سعادت را برای ملت شریف ایران و جامعه جهانی رقم زند. امید است در سال جدید، با تلاش و همدلی همگانی، گامی دیگر در مسیر تعالی و کمال برداشته شود و پیام صلح، دوستی و همزیستی مسالمت‌آمیز به جهانیان منتقل گردد.', 'The Salman Educational Complex, while extending its congratulations on the start of the new Gregorian year to all, prays to Almighty God to bring a year filled with success, progress, and felicity for the noble Iranian nation and the global community. It is hoped that in the new year, through collective efforts and unity, another step will be taken towards sublimity and perfection, and the message of peace, friendship, and peaceful coexistence will be conveyed to the world.', 0, 14),
(11, 'Ramadan,-an-Opportunity-to-Draw-Closer-to-the-Divine', '2023-03-05 22:24:12', 'رمضان، فرصت تقرب به درگاه الهی', 'Ramadan, an Opportunity to Draw Closer to the Divine', 'ramadan.png', 'با فرارسیدن ماه مبارک رمضان، لحظه‌های پرارزش انسان‌سازی و خودسازی فرا می‌رسد. در این ماه پرفضیلت، مسلمانان فرصت کسب قرب الهی و پرورش خود را در آیینه جلال و جمال الهی می‌یابند. روزه داشتن، بهانه‌ای برای آگاهی از لحظات گرانبها و امتحان صبر و استقامت در مسیر اطاعت خداوند است.\n\nاین ماه، دریچه‌ای فراخ به درگاه خداوند متعال است و انسان به گرامی داشتن یاد شهدای گرانقدر میدان توحید، عزت و مقاومت در برابر شرک و کفر را می‌آموزد. امیدواریم در این ایام انسان‌ساز، بیش از پیش تابع مبادی اخلاقی و معنوی اسلام باشیم.', 'With the arrival of the blessed month of Ramadan, the precious moments of observing the divine and resisting temptations are upon us. In this virtuous month, Muslims have the opportunity to draw closer to the Divine and nurture themselves in the mirror of divine majesty and beauty. Fasting provides an opportunity to be mindful of these precious moments and test one\'s patience and obedience in the way of God.\n\nThis month is an open door to the presence of the Almighty, and we learn to honor the memory of the precious martyrs of the arena of monotheism and to resist polytheism and disbelief. Let us hope that in these human-nurturing days, we embrace the moral and spiritual principles of Islam more than ever before.', 'ramadan1.png', 'ramadan2.png', 'مجتمع آموزشی سلمان، ضمن تبریک ایام پربرکت ماه مبارک رمضان، آمادگی خود را برای همراهی و کمک به خانواده‌های فرهنگی در این ایام اعلام می‌دارد. امید است در سایه الطاف الهی و استقامت در شریعت ناب اسلامی، همه مسلمانان جهان به سرمنزل مقصود رسیده و از شیرینی روزه‌داری و عبادت مستمر به خاطرات ماندگار روزهای جوانی خود تازه کنند.', 'The Salman Educational Complex, while congratulating the blessed days of the holy month of Ramadan, announces its readiness to accompany and assist cultural families during these days. It is hoped that in the shadow of divine blessings and perseverance in the pure Islamic law, all Muslims around the world will reach their desired destination and revive the sweet memories of their youth through consistent fasting and worship.', 0, 14),
(12, 'Anniversary-of-UAE-National-Day;-Wishing-Progress-and-Prosperity', '2023-12-02 00:00:00', ' روز ملی امارات؛ آرزوی پیشرفت و شکوفایی', 'Anniversary of UAE National Day; Wishing Progress and Prosperity', 'uae-national-day.png', 'امروز، سالگرد تأسیس امارات متحده عربی و روز ملی این کشور است. در این روز فرخنده، ضمن گرامیداشت مردم شریف امارات و دستاوردهای این کشور در عرصه‌های مختلف، آرزوی پیشرفت و شکوفایی روزافزون آن را داریم.\n\nامارات متحده عربی، کشوری جوان با ریشه‌های تاریخی کهن در منطقه خاورمیانه است که با اتکا به منابع انسانی و طبیعی خود، توانسته در مدت زمان کوتاهی، دستاوردهای چشمگیری در زمینه‌های اقتصادی، علمی و فناوری کسب کند. این کشور، نمونه‌ای از پیشرفت و توسعه در جهان اسلام است.', 'Today marks the anniversary of the founding of the United Arab Emirates and its National Day. On this auspicious occasion, we honor the noble people of the UAE and their achievements in various fields, wishing for the country\'s continued progress and prosperity.\n\nThe United Arab Emirates is a young nation with ancient historical roots in the Middle East region. By relying on its human and natural resources, it has been able to achieve remarkable accomplishments in the economic, scientific, and technological spheres in a short period. This country serves as an example of progress and development in the Islamic world.', 'uae-national-day1.png', 'uae-national-day2.png', 'مجتمع آموزشی سلمان، ضمن تبریک این روز مهم به دولت و ملت امارات متحده عربی، آرزوی روابط دوستانه و گسترش همکاری‌های مثمرثمر میان دو کشور را دارد. امید است با تلاش و پشتکار، جوامع اسلامی در مسیر پیشرفت، توسعه و تعالی گام بردارند و پیام صلح، دوستی و همزیستی مسالمت‌آمیز را به جهانیان منتقل کنند.', 'The Salman Educational Complex, while congratulating this important occasion to the government and people of the United Arab Emirates, wishes for friendly relations and fruitful cooperation between the two countries. It is hoped that through diligence and perseverance, Islamic societies will advance on the path of progress, development, and sublimity, conveying the message of peace, friendship, and peaceful coexistence to the world.', 0, 14),
(13, 'Sacred-Defense-Week,-Reminiscent-of-the-Bravery-and-Sacrifices-of-the-Iranian-Nation', '2023-09-21 00:00:00', 'هفته دفاع مقدس، یادآور رشادت‌ها و ایثارگری‌های ملت ایران', 'Sacred Defense Week, Reminiscent of the Bravery and Sacrifices of the Iranian Nation', 'sacred-defense-week.png', 'هفته دفاع مقدس، یادآور حماسه‌آفرینی‌ها و رشادت‌های ملت ایران در دوران جنگ تحمیلی است. در این ایام، خاطره شهیدان گرانقدر و ایثارگران راه آزادی را گرامی می‌داریم؛ کسانی که با نثار خون پاک خود، استقلال و تمامیت ارضی کشور عزیزمان را حفظ کردند.\n\nدفاع مقدس، نماد عزت، افتخار و پایداری ملت ایران در برابر متجاوزان است. امروز، با الهام از روحیه جهاد و مقاومت رزمندگان اسلام، بار دیگر پیمان خود را با آرمان‌های انقلاب اسلامی و دفاع از ارزش‌های واﻻی اسلامی تجدید می‌کنیم.', 'The Sacred Defense Week reminds us of the epic achievements and bravery of the Iranian nation during the Imposed War. During these days, we honor the memory of the esteemed martyrs and self-sacrificing individuals who defended freedom, preserving the independence and territorial integrity of our beloved country by sacrificing their pure blood.\n\nThe Sacred Defense symbolizes the honor, glory, and perseverance of the Iranian nation against aggressors. Today, inspired by the spirit of jihad and resistance of the Islamic warriors, we renew our covenant with the ideals of the Islamic Revolution and the defense of the lofty Islamic values.', 'sacred-defense-week1.png', 'sacred-defense-week2.png', 'مجتمع آموزشی سلمان، ضمن گرامیداشت یاد و خاطره شهیدان واﻻمقام دفاع مقدس، از تلاش‌های خستگی‌ناپذیر رزمندگان و ایثارگران این نبرد حق علیه باطل قدردانی می‌کند. امید است با الهام از روحیه جهادی و ایثارگری شهدا، ملت ایران در مسیر عزت، پیشرفت و اعتلای نظام مقدس جمهوری اسلامی گام بردارد و پیام صلح، مقاومت و عدالت‌خواهی را به جهانیان منتقل سازد.', 'The Salman Educational Complex, while honoring the memory of the esteemed martyrs of the Sacred Defense, expresses its gratitude for the tireless efforts of the warriors and self-sacrificing individuals in this battle of truth against falsehood. It is hoped that inspired by the spirit of jihad and self-sacrifice of the martyrs, the Iranian nation will tread the path of honor, progress, and the exaltation of the sacred system of the Islamic Republic, conveying the message of peace, resistance, and justice to the world.', 0, 14),
(14, 'Muharram,-the-Symbol-of-Perseverance-on-the-Path-of-Truth', '2023-06-05 22:26:51', 'محرم، نمادِ پایداری در مسیر حق', 'Muharram, the Symbol of Perseverance on the Path of Truth', 'muharram.png', 'با آغاز ماه محرم، یاد و خاطره حماسه ماندگار و جاودانه کربلا را گرامی می‌داریم؛ حماسه‌ای که در آن، امام حسین (علیه السلام) و یاران با وفایش، با نثار خون پاک خود، پرچم توحید و عدالت را برافراشتند و درس پایداری و ایستادگی در برابر ظلم و استکبار را به جهانیان آموختند.\n\nشهادت امام حسین (علیه السلام) و یارانش، درسی بزرگ برای همه آزادگان جهان است که باید در مسیر حق و دفاع از ارزش‌های انسانی و الهی، از هیچ فداکاری دریغ نورزند. این واقعه تلخ، نمادی از مبارزه با ظلم و جهالت در طول تاریخ بشریت است.', 'With the beginning of the month of Muharram, we honor the memory of the enduring and eternal epic of Karbala; an epic in which Imam Hussain (peace be upon him) and his loyal companions raised the flag of monotheism and justice by sacrificing their pure blood, teaching the world a lesson in perseverance and steadfastness against oppression and arrogance.\n\nThe martyrdom of Imam Hussain (peace be upon him) and his companions is a great lesson for all free people in the world – that one must not hesitate to make any sacrifice in the path of truth and in defense of human and divine values. This bitter event symbolizes the struggle against oppression and ignorance throughout human history.', 'muharram1.png', 'muharram2.png', 'مجتمع آموزشی سلمان، ضمن گرامیداشت یاد و خاطره شهدای کربلا، از خداوند متعال مسئلت دارد تا توفیق پیروی از منویات و آرمان‌های واﻻی اهل بیت عصمت و طهارت (علیهم السلام) را به همگان عنایت فرماید. امید است با الهام از قیام عاشورا و رهنمودهای امام حسین (علیه السلام)، جامعه اسلامی ما در مسیر کمال و عدالت گام بردارد و پیام مقاومت، آزادگی و عزت را به جهانیان منتقل سازد.', 'The Salman Educational Complex, while honoring the memory of the martyrs of Karbala, prays to Almighty God to grant everyone the opportunity to follow the teachings and lofty ideals of the infallible Ahl al-Bayt (peace be upon them). It is hoped that inspired by the Ashura uprising and the guidance of Imam Hussain (peace be upon him), our Islamic society will advance on the path of perfection and justice, conveying the message of resistance, freedom, and honor to the world.', 0, 14),
(15, 'The-Nights-of-Glory-and-the-Martyrdom-of-the-Commander-of-the-Faithful;-The-Pinnacle-of-Servitude-and-Sacrifice', '2024-04-01 08:59:20', 'شب‌های قدر و شهادت امیرالمومنین (ع)؛ اوج عبودیت و فداکاری', 'The Nights of Glory and the Martyrdom of the Commander of the Faithful; The Pinnacle of Servitude and Sacrifice', 'shab_qadr.png', 'در شبهای پرفیض و برکت قدر، که اوج تجلی عبودیت و بندگی خداوند متعال است، یاد و خاطره شهادت حضرت امیرالمؤمنان علی بن ابیطالب (ع) نیز گرامی داشته می‌شود. شهادت آن حضرت که در بیست و یکم ماه مبارک رمضان رخ داد، نمونه‌ای عالی از فداکاری در راه خداوند و دفاع از حریم اسلام و قرآن است.\n\nامام علی (ع) با جانفشانی در رکاب پیامبر اکرم (ص) و سپس هدایت امت اسلامی به مسیر پرهیزگاری و تقوا، پرچم اسلام ناب محمدی (ص) را برافراشته نگه داشت. شهادت ایشان به دست فرد منحرف و گمراه، ضربه‌ای سنگین بر پیکر امت اسلامی وارد کرد؛ اما خون پاک ایشان، نهال اسلام واقعی را همچنان سیراب و تازه نگه داشت.', 'In the blessed and auspicious Nights of Glory, which represent the pinnacle of servitude and devotion to Almighty God, we also honor the memory of the martyrdom of the Commander of the Faithful, Ali ibn Abi Talib (peace be upon him). His martyrdom, which occurred on the 21st of the holy month of Ramadan, is a sublime example of sacrifice in the way of God and the defense of the sanctity of Islam and the Quran.\n\nImam Ali (peace be upon him), through his selfless struggles alongside the Prophet Muhammad (peace be upon him and his progeny) and later guiding the Muslim nation towards piety and righteousness, upheld the banner of the pure Muhammadan Islam. His martyrdom at the hands of a deviant and misguided individual dealt a heavy blow to the body of the Muslim nation; however, his pure blood continued to nourish and revive the seedling of true Islam.', 'ali_shohada.png', 'fazilat_shab_qadr.png', 'در این شب‌های گرانقدر که فضیلت عبادت در آن‌ها برابر با هزار ماه است، باید از عبرت‌های شهادت حضرت علی (ع) و راه پرافتخار ایشان، درس‌هایی برای تقویت ایمان، استقامت و فداکاری در مسیر حق بیاموزیم. یاد و خاطره آن شهید راه حقیقت، نوری فروزان بر دل‌های مؤمنان است که باید همواره زنده و جاری بماند.', 'In these precious nights, where the virtue of worship is equivalent to a thousand months, we must learn lessons from the martyrdom of Imam Ali (peace be upon him) and his honorable path to strengthen our faith, perseverance, and readiness for sacrifice in the way of truth. The memory of that martyr on the path of truth is a shining light in the hearts of believers, which must always remain alive and flowing.', 0, 14),
(16, 'Celebrations-of-the-National-Flag-Day-in-the-United-Arab-Emirates', '2023-11-03 10:00:00', 'جشن روز پرچم در امارات متحده عربی', 'Celebrations of the National Flag Day in the United Arab Emirates', 'uae_flag_day.png', 'در امارات متحده عربی، در سوم نوامبر از هر سال، جشن روز پرچم ملی برگزار می‌شود. این روز، روزی مهم است که وحدت ملی و تعلق به سرزمین مادری را نمایش می‌دهد. در این روز تاریخی، پرچم‌های کشور بر فراز ساختمان‌های دولتی، نهادها و خانه‌ها در سراسر کشور در اهتزاز است و نشان از غرور و وفاداری به سرزمین و مردم امارات دارد. این روز، جشن‌ها و رویدادهای متعددی در مناطق مختلف برگزار می‌شود که شهروندان و ساکنان هر دو در آن شرکت می‌کنند تا به این مناسبت گرامی احترام بگذارند. همچنین وزارت آموزش و پرورش و نهادهای مربوطه، فعالیت‌ها و برنامه‌های آموزشی برای دانش‌آموزان ترتیب می‌دهند تا مفاهیم ملی و تعلق به میهن را تقویت کنند.', 'On the 3rd of November each year, the United Arab Emirates celebrates its National Flag Day, an important occasion that reflects national unity and belonging to the homeland. On this historic day, the flags of the nation fly proudly over government buildings, institutions, and homes across the country, expressing pride and loyalty to the Emirati land and people.\n\nNumerous celebrations and events are held in various regions on this day, with citizens and residents alike participating in the festivities of this cherished occasion. The Ministry of Education and relevant authorities also organize educational activities and programs for students to promote national concepts and a sense of belonging to the homeland.', 'uae_flag_raising.png', 'uae_flag_celebrations.png', 'پرچم امارات، نماد وحدت، حاکمیت و کرامت ملی است و آرزوهای مردم امارات برای پیشرفت و شکوفایی بیشتر را نمایان می‌سازد. بنابراین، جشن روز پرچم فرصتی است برای تأکید بر هویت ملی، همبستگی و وفاداری به رهبری خردمند و میهن. بیایید همگی این مناسبت عزیز را جشن بگیریم و پیمان خود را برای پیشروی به سوی افق‌های جدید توسعه و شکوفایی برای نسل‌های آینده تجدید کنیم.', 'The Emirati flag is a symbol of unity, sovereignty, and national dignity, embodying the aspirations of the Emirati people towards further progress and prosperity. Therefore, the Flag Day celebrations represent an opportunity to reaffirm the national identity, solidarity, and loyalty to the wise leadership and the homeland. Let us all celebrate this cherished occasion and renew our commitment to move forward towards new horizons of development and prosperity for future generations.', 0, 14),
(17, 'Loss-of-an-Erudite-Mentor-Passing-of-Mr-Seyyed-Abbas-Abtahi', '2024-05-27 00:00:00', 'از دست دادن دبیر فرهیخته؛ درگذشت جناب سید عباس ابطحی', 'Loss of an Erudite Mentor; Passing of Mr. Seyyed Abbas Abtahi', 'abtahi.png', 'با کمال تأسف و تأثر، درگذشت آموزگار گرانقدر جناب آقای سید عباس ابطحی را به اطلاع می‌رسانیم. ایشان که سالیان دراز در مدرسه ما تدریس کردند، نقش بسزایی در تربیت نسل‌های دانش‌آموز و انتقال میراث گرانبهای علم و اخلاق داشتند. آثار ماندگار آن زنده‌یاد، همواره در قلب و ذهن شاگردان و همکاران ایشان باقی خواهد ماند.ضایعه از دست دادن این آموزگار فرهیخته، موجب اندوه عمیق در جامعه فرهنگی و آموزشی است. یاد و خاطره ابطحی همچون نوری درخشان، راهگشای نسل‌های آینده در مسیر کمال و تعالی علمی و اخلاقی خواهد بود. ما از درگاه ایزد متعال برای آن مرحوم، علو درجات و برای بازماندگان محترمشان، صبر و اجر مسئلت داریم.', 'With profound sorrow and grief, we announce the passing of the esteemed mentor and wise teacher, Mr. Seyyed Abbas Abtahi. Having taught for many years at our school, he played a pivotal role in educating generations of students and imparting the invaluable heritage of knowledge and ethics. The enduring legacy of this departed soul will forever remain in the hearts and minds of his students and colleagues.\n\nThe loss of this erudite mentor is a cause of deep sadness for the educational and cultural community. The memory of Abtahi will shine like a guiding light for future generations on the path of intellectual and ethical perfection and growth. We implore the Almighty God to elevate the ranks of the departed and bestow patience and reward upon his esteemed family.', NULL, NULL, NULL, NULL, 2, 3),
(18, 'Losing-a-Long-Standing-Companion-The-Passing-of-Mr-Raju-School-Staff', '2020-05-28 00:00:00', 'از دست دادن یار دیرین؛ درگذشت آقای راجو، خدمتگزار مدرسه', 'Losing a Long-Standing Companion; The Passing of Mr. Raju, School Staff', 'raju.png', 'با اندوه فراوان، خبر درگذشت همکار عزیز و خدمتگزار دیرین مدرسه، جناب آقای راجو را اعلام می‌نماییم. وی که سال‌ها در کنار ما بود، با تلاش صادقانه و وفاداری خستگی‌ناپذیر، به مدرسه و دانش‌آموزان خدمت کرد. حضور گرم و لبخند همیشگی آقای راجو، روح تازه‌ای به محیط مدرسه می‌بخشید.\n\nاز دست دادن این همکار قدیمی و محبوب، ضایعه‌ای جبران‌ناپذیر برای خانواده بزرگ مدرسه ماست. یاد و خاطره پرتلاش و پرافتخار ایشان، الگویی برای همه ما در خدمت صادقانه و بی‌ریا خواهد بود. ما برای آن مرحوم آرامش ابدی و برای خانواده محترمشان صبر و شکیبایی آرزو می‌کنیم.', 'With profound sadness, we announce the passing of our beloved colleague and the school  long-serving staff member, Mr. Raju. For years by our side, he served the school and its students with sincere dedication and unwavering loyalty. Mr. Raju warm presence and ever-present smile brought a fresh spirit to the school environment.\n\nLosing this cherished longtime companion is an irreparable loss for our school large family. The hardworking and honorable memory of Mr. Raju will serve as a model for all of us in rendering sincere and selfless service. We pray for eternal peace for the departed soul and patience and fortitude for his esteemed family.', NULL, NULL, NULL, NULL, 0, 14),
(19, 'The-Melodious-Hymn-of-Salman-Farsi-School', '2020-05-25 00:00:00', 'سرود مجتمع سلمان فارسی', ' The Melodious Hymn of Salman Farsi School', 'salman_anthem.png', '<p>شعر زیبا و الهام بخش این سرود توسط یکی از استعدادهای درخشان مدرسه سلمان در یک ماه پیش سروده شده است. کلمات این شعر سرشار از عشق به دانش، ایمان، میهن و غرور تعلق به مدرسه سلمان است.</p>\n<p>ملودی دلنشین و تنظیم احساسی این سرود کار آقای علی محمدی، فرزند استاد محمدرضا محمدی، می باشد. ایشان طی 3 هفته با تلاش مستمر این اثر زیبا را آفریدند.</p>\n<p>به زودی، اجرای همخوانی کرال این سرود با صدای گرم دانش آموزان مدرسه سلمان انجام خواهد شد. در ساز بندی این سرود از سازهای مارش به صورت دیجیتال استفاده شده، اما به منظور حفظ شادابی و طراوت آن، از ریتم های جذاب و مورد علاقه دانش آموزان بهره گرفته شده است.</p>\n<p>متن سرود:</p>\n<p>میبالم از دانستن - شور از دانایی خیزد<br>سرشارم از آگاهی - چون با ایمان آمیزد<br>رویایی در نزدیکی - فانوسی در تاریکی<br>شوری در جانی پنهان - یادی از مهرم ایران<br>آغوشی باز از دانش - دنیایی از آرامش<br>کوه از ایمانش گوید - سرو از دامانش روید<br>تکه ای از بهشت است - مدرسه ام! ای جانم!<br>افتخارم همین بس! - دانش آموز سلمانم</p>\n', 'The beautiful and inspiring lyrics of this anthem were composed a month ago by one of Salman School shining talents. The words of this poem are filled with love for knowledge, faith, homeland, and pride in belonging to Salman School. \r\nThe enchanting melody and emotional arrangement of this anthem are the work of Master Ali Mohammadi, son of the great music master Mohammad Reza Mohammadi. He created this beautiful piece through three weeks of diligent effort.\r\n\r\nSoon, a choral performance of this anthem will be given by the warm voices of Salman School students. The anthem instrumentation utilizes digital marching band instruments, but to maintain its vibrancy and freshness, engaging and appealing rhythms for students have been employed.\r\n\r\nAnthem lyrics:\r\n\r\nI take pride in learning - passion arises from knowledge\r\nI am brimming with awareness - as it blends with faith\r\nA dream in proximity - a lantern in darkness\r\nA zeal hidden in a soul - a reminder of my love for Iran\r\nAn embrace of knowledge - a world of tranquility\r\nThe mountain speaks of its faith - the cypress grows from its hem\r\nIt is a piece of paradise - my school! O my soul!\r\nThis alone is my pride! - A Salman student', 'salman_anthem1.png', 'salman_anthem2.png', 'این سرود فاخر می تواند در آینده به عنوان سرود رسمی و نماد افتخار مدرسه سلمان مورد استفاده قرار گیرد. اجرای این سرود در مراسم های مختلف توسط دانش آموزان و کادر، روح غرور، همدلی، ایمان و عشق به میهن را در فضای مدرسه زنده نگه خواهد داشت. به امید اینکه این ترانه ماندگار در قلب ها جاودانه شود.', 'This prestigious anthem may be adopted as the official anthem and symbol of pride for Salman School in the future. Performing this anthem at various events by students and staff will keep the spirit of pride, unity, faith, and love for the homeland alive within the school environment. May this enduring song become eternal in our hearts.', 1, 5),
(20, 'Visit-of-11th-and-12th-Grade-Students-to-Ajman-University', '2023-01-25 00:00:00', 'بازدید دانش آموزان پایه ۱۱ و ۱۲ از دانشگاه عجمان', 'Visit of 11th and 12th Grade Students to Ajman University', 'ajman_visit.png', 'در یک برنامه ویژه، دانش آموزان پایه ۱۱ و ۱۲ مدرسه سلمان فارسی از دانشگاه عجمان بازدید کردند. این بازدید که با هماهنگی مدرسه و دانشگاه انجام شد، به دانش آموزان فرصت داد تا با محیط دانشگاه و امکانات آموزشی آن آشنا شوند و از تجربیات استادان و دانشجویان بهره‌مند گردند.در این بازدید، دانش آموزان با بخش‌های مختلف دانشگاه از جمله کتابخانه، آزمایشگاه‌ها، و مراکز تحقیقاتی آشنا شدند و در جلسات مشاوره تحصیلی و حرفه‌ای شرکت کردند. این تجربه باعث افزایش انگیزه و اشتیاق دانش آموزان برای ادامه تحصیل در مقاطع بالاتر شد.', 'In a special program, 11th and 12th-grade students from Salman Farsi School visited Ajman University. This visit, coordinated by the school and university, gave the students an opportunity to familiarize themselves with the university environment and its educational facilities, and to benefit from the experiences of professors and students.During this visit, students were introduced to various university departments, including the library, laboratories, and research centers, and participated in academic and career counseling sessions. This experience enhanced the students\' motivation and enthusiasm to pursue higher education.', 'ajman_visit1.png', 'ajman_visit2.png', 'در پایان بازدید، دانش آموزان ضمن تشکر از مسئولان دانشگاه و مدرسه، از تجربیات خود در این بازدید رضایت کامل داشتند و از اطلاعات و آگاهی‌های کسب شده برای برنامه‌ریزی تحصیلی و حرفه‌ای آینده‌شان بهره‌مند خواهند شد.', 'At the end of the visit, the students expressed their gratitude to the university and school officials and were completely satisfied with their experiences. They will use the knowledge and insights gained from this visit for their future academic and career planning.', 0, 2),
(21, 'Visit-of-Salman-Farsi-Complex-to-Expo-2020-Dubai', '2022-02-14 00:00:00', 'بازدید مجتمع سلمان فارسی از اکسپو ۲۰۲۰ دبی', 'Visit of Salman Farsi Complex to Expo 2020 Dubai', 'expo2020.png', 'در یک رویداد خاص، دانش آموزان و کارکنان مجتمع سلمان فارسی از اکسپو ۲۰۲۰ دبی بازدید کردند. این بازدید فرصتی بود برای آشنایی با جدیدترین فناوری‌ها، دستاوردهای علمی و فرهنگی کشورها از سراسر جهان. همچنین، این رویداد فرصتی برای تبادل فرهنگی و آشنایی با فرهنگ‌ها و سنت‌های مختلف بود. در طول بازدید، دانش آموزان و کارکنان مجتمع با غرفه‌های مختلفی از جمله فناوری، نوآوری، پایداری و فرهنگ آشنا شدند. آنان همچنین در برنامه‌های آموزشی و کارگاه‌های مختلفی شرکت کردند که به افزایش آگاهی و دانش آنان کمک کرد. این تجربه بی‌نظیر، به دانش آموزان انگیزه بیشتری برای پیگیری اهداف علمی و حرفه‌ای‌شان داد.', 'In a special event, students and staff of the Salman Farsi Complex visited Expo 2020 Dubai. This visit provided an opportunity to explore the latest technologies, scientific and cultural achievements of countries from around the world. Additionally, it was a chance for cultural exchange and understanding of various cultures and traditions.\n\nDuring the visit, the students and staff explored various pavilions including technology, innovation, sustainability, and culture. They also participated in educational programs and workshops, which enhanced their awareness and knowledge. This unique experience motivated the students to pursue their academic and professional goals with greater enthusiasm.', 'expo2020_1.png', 'expo2020_2.png', 'در پایان بازدید، اعضای مجتمع ضمن تشکر از مسئولان اکسپو و مدرسه، از تجربیات خود در این بازدید رضایت کامل داشتند و از اطلاعات و آگاهی‌های کسب شده برای برنامه‌ریزی تحصیلی و حرفه‌ای آینده‌شان بهره‌مند خواهند شد. این بازدید نشان داد که آشنایی با دستاوردها و فرهنگ‌های مختلف جهان می‌تواند تاثیر بسزایی در رشد و توسعه فردی و جمعی داشته باشد.', 'At the end of the visit, the members of the complex expressed their gratitude to the Expo and school officials and were completely satisfied with their experiences. They will use the knowledge and insights gained from this visit for their future academic and career planning. This visit demonstrated that understanding the achievements and cultures of different countries can have a significant impact on individual and collective growth and development.', 0, 2),
(22, 'Recreational-Trip-of-Students-to-Dubai-Safari-Park', '2023-01-31 00:00:00', 'گردش تفریحی دانش آموزان در سافاری پارک دوبی', 'Recreational Trip of Students to Dubai Safari Park', 'safari_park.png', 'در یک روز شاد و پر انرژی، دانش آموزان مجتمع سلمان فارسی به سافاری پارک دوبی رفتند. این گردش تفریحی فرصتی برای دانش آموزان فراهم کرد تا از نزدیک با حیوانات مختلف آشنا شوند و درباره‌ی زیستگاه‌های طبیعی آن‌ها اطلاعات کسب کنند.دانش آموزان با مشاهده‌ی حیوانات و شرکت در برنامه‌های آموزشی سافاری پارک، نه تنها لذت بردند بلکه با اهمیت حفظ محیط زیست و حفاظت از گونه‌های در حال انقراض نیز آشنا شدند. این تجربه به دانش آموزان این امکان را داد تا در فضایی متفاوت، به یادگیری و تفریح بپردازند و روزی به یادماندنی را سپری کنند.', 'On a joyful and energetic day, the students of Salman Farsi Complex visited Dubai Safari Park. This recreational trip provided an opportunity for students to get acquainted with various animals up close and learn about their natural habitats.\n\nBy observing the animals and participating in the educational programs of the Safari Park, the students not only enjoyed themselves but also learned about the importance of environmental conservation and protecting endangered species. This experience allowed the students to learn and have fun in a different setting, making it a memorable day.', 'safari_park1.png', 'safari_park2.png', 'در پایان روز، دانش آموزان از تجربه‌ی خود در سافاری پارک ابراز رضایت کردند و از مسئولان مدرسه و پارک برای فراهم کردن این فرصت تشکر کردند. این گردش تفریحی نه تنها به دانش آموزان لحظاتی خوش و فراموش نشدنی هدیه داد بلکه به آنان کمک کرد تا با دیدی وسیع‌تر به طبیعت و حفاظت از آن نگاه کنند.', 'At the end of the day, the students expressed their satisfaction with their experience at the Safari Park and thanked the school and park officials for providing this opportunity. This recreational trip not only gave the students happy and unforgettable moments but also helped them to look at nature and its conservation with a broader perspective.', 0, 2);
INSERT INTO `post` (`id`, `slug`, `publish_date`, `title`, `title_en`, `main_image`, `content1`, `content1_en`, `image1`, `image2`, `content2`, `content2_en`, `views`, `category_id`) VALUES
(23, 'Salman-Farsi-Complex-Wins-Supervisory-Volleyball-Tournament', '2022-02-12 00:00:00', 'مجتمع سلمان فارسی قهرمان مسابقات والیبال سرپرستی', 'Salman Farsi Complex Wins Supervisory Volleyball Tournament', 'volleyball_championship.png', 'با افتخار، مجتمع سلمان فارسی موفق به کسب عنوان قهرمانی در مسابقات والیبال سرپرستی شد. این مسابقات که با حضور تیم‌های برتر مدارس منطقه برگزار شد، فرصت مناسبی برای نمایش توانمندی‌ها و مهارت‌های ورزشی دانش آموزان فراهم آورد.تیم والیبال مجتمع سلمان فارسی با بازی‌های فوق‌العاده و هماهنگی مثال‌زدنی، توانست حریفان را شکست دهد و به مقام قهرمانی دست یابد. این پیروزی نتیجه تلاش، تمرین و همبستگی دانش آموزان و مربیان بود که با انگیزه و پشتکار، لحظاتی به یادماندنی را رقم زدند.', 'With pride, Salman Farsi Complex succeeded in winning the championship title in the Supervisory Volleyball Tournament. This tournament, held with the participation of the top school teams in the region, provided a great opportunity to showcase the students\' sports skills and abilities.\n\nThe volleyball team of Salman Farsi Complex, with outstanding plays and exemplary coordination, managed to defeat their opponents and secure the championship title. This victory was the result of the students\' and coaches\' efforts, training, and solidarity, creating memorable moments.', 'volleyball_championship1.png', 'volleyball_championship2.png', 'این قهرمانی نه تنها نشان از توانمندی و استعدادهای ورزشی دانش آموزان دارد، بلکه نمادی از تعهد و پشتکار آن‌ها در دستیابی به اهدافشان است. مجتمع سلمان فارسی از تمامی اعضای تیم، مربیان و مسئولانی که در این مسیر نقش داشتند، تقدیر و تشکر می‌نماید و امیدوار است که این موفقیت‌ها ادامه‌دار باشد.', 'This championship not only highlights the sports talents and abilities of the students but also symbolizes their commitment and perseverance in achieving their goals. Salman Farsi Complex extends its appreciation to all team members, coaches, and officials who played a role in this journey and hopes that such successes continue.', 0, 8),
(24, 'Supervisory-Team-and-Colleagues-Attend-Yalda-Night-Ceremony-and-Students\'-Handicrafts-Exhibition', '2021-12-08 00:00:00', 'حضور تیم سرپرستی و همکاران در مراسم شب یلدا و نمایشگاه کارهای دستی دانش‌آموزان', 'Supervisory Team and Colleagues Attend Yalda Night Ceremony and Students\' Handicrafts Exhibition', 'yalda_night.png', 'در مراسمی نمادین به مناسبت شب یلدا، تیم محترم سرپرستی و سایر همکاران محترم حضور به هم رساندند و از نمایشگاه کارهای دستی و هنری دانش آموزان عزیز در بخش احسان بازدید کردند. این مراسم که با هدف گرامیداشت سنت‌های ایرانی و نمایش خلاقیت‌های دانش آموزان برگزار شد، فضایی گرم و صمیمی را به وجود آورد.حضور تیم سرپرستی و همکاران در این مراسم، نشان از توجه و حمایت آنان از فعالیت‌های فرهنگی و هنری دانش آموزان داشت. بازدید از نمایشگاه کارهای دستی که شامل آثار هنری متنوع و خلاقانه دانش آموزان بود، فرصتی برای قدردانی از زحمات و استعدادهای آنان فراهم آورد.', 'In a symbolic ceremony on the occasion of Yalda Night, the esteemed supervisory team and other respected colleagues attended and visited the exhibition of students\' handicrafts and artworks in the Ehsan section. This ceremony, held to honor Iranian traditions and showcase students\' creativity, created a warm and friendly atmosphere.The presence of the supervisory team and colleagues at this ceremony demonstrated their attention and support for the cultural and artistic activities of the students. Visiting the handicrafts exhibition, which included a variety of creative artworks by the students, provided an opportunity to appreciate their efforts and talents.', 'yalda_night1.png', 'yalda_night2.png', 'در پایان مراسم، تیم سرپرستی و همکاران محترم از تلاش‌ها و خلاقیت‌های دانش آموزان تقدیر کردند و بر اهمیت استمرار چنین فعالیت‌های فرهنگی و هنری تأکید نمودند. این گونه مراسم‌ها نه تنها باعث تقویت روحیه دانش آموزان می‌شود بلکه به رشد و شکوفایی استعدادهای آنان کمک می‌کند.', 'At the end of the ceremony, the supervisory team and respected colleagues appreciated the students\' efforts and creativity and emphasized the importance of continuing such cultural and artistic activities. Such ceremonies not only boost students\' morale but also help in the growth and flourishing of their talents.', 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name_fa` varchar(100) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `position_fa` varchar(100) NOT NULL,
  `position_en` varchar(100) NOT NULL,
  `review_fa` longtext NOT NULL,
  `review_en` longtext NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name_fa`, `name_en`, `position_fa`, `position_en`, `review_fa`, `review_en`, `image_url`) VALUES
(1, 'دکتر سمیه صدر لاهیجانی', 'Dr. Somayeh Sadr Lahijani', 'استاد ادبیات فارسی', 'Professor of Persian Literature', 'مدرسه سلمان فارسی محیطی علمی و فرهنگی کم‌نظیر است که با برنامه‌ریزی دقیق، مدیریت مدبرانه و تأکید بر ارزش‌های ایرانی-اسلامی، بستری ایده‌آل برای پرورش نسل آینده فراهم کرده است.', 'Salman Farsi School is a unique academic and cultural environment that, with meticulous planning, wise management, and emphasis on Iranian-Islamic values, provides an ideal foundation for nurturing the next generation.', 'Fatemeh.jpg'),
(2, 'مهندس علی دشتبان', 'Engineer Ali Dashtban', 'فارغ‌التحصیل کارشناسی ارشد مهندسی عمران', 'MSc Graduate in Civil Engineering', 'این مجموعه با بهره‌گیری از امکانات به‌روز، اساتید توانمند و مدیریت کارآمد، نقش بسزایی در ارتقاء سطح علمی و اخلاقی دانش‌آموزان ایفا می‌کند.', 'This institution, utilizing up-to-date facilities, skilled instructors, and efficient management, plays a vital role in enhancing both the academic and ethical levels of its students.', 'Dashtban.jpg'),
(3, 'فاطمه صدیقی', 'Fatemeh Sedighi', 'دانشجوی کارشناسی روانشناسی', 'Bachelor’s Student in Psychology', 'مدرسه سلمان فارسی محیطی پرانرژی و انگیزشی برای یادگیری است که با تمرکز ویژه بر تربیت شخصیت و تقویت مهارت‌های اجتماعی، آینده‌ای روشن و موفقیت‌آمیز برای دانش‌آموزان رقم می‌زند.', 'Salman Farsi School is an energetic and motivational learning environment that, with its special focus on character development and social skills, creates a bright and successful future for its students.', 'Somayeh.png');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name_fa` varchar(255) NOT NULL,
  `name_en` varchar(225) NOT NULL,
  `position_fa` varchar(255) NOT NULL,
  `position_en` varchar(225) NOT NULL,
  `education_fa` text NOT NULL,
  `education_en` text NOT NULL,
  `bio` text DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name_fa`, `name_en`, `position_fa`, `position_en`, `education_fa`, `education_en`, `bio`, `photo_url`) VALUES
(1, 'مجید اخلاصی', 'Majid Akhlasi', 'مدیر', 'Management', 'فوق لیسانس زیست شناسی', 'Master of Biology', NULL, 'Akhlasi.png'),
(2, 'محمد رضا محمدی', 'Mohammad Reza Mohammadi', 'معاون متوسطه  دوم', 'Second secondary assistant', 'فوق لیسانس روانشناسی', 'Master of Psychology', NULL, 'Mohammadi.png'),
(3, 'نصرت داشاب', 'Nosrat Dashab', 'معاون آموزشی', 'Educational Assistant', 'لیسانس کودکان استثنایی', 'Bachelor of Special Children', NULL, 'Dashab.png'),
(4, 'حسن رنجبر', 'Hassan Ranjbar', 'معاون پرورشی', 'Assistant for breeding', 'فوق لیسانس تاریخ', 'Master of History', NULL, 'Ranjbar.png'),
(5, 'مرتضی حسینیان', 'Morteza Hosseinian', 'حسابدار', 'Accountants', 'دیپلم کامپیوتر', 'High School Diploma in Computer', NULL, NULL),
(6, 'معصومه جعفری', 'Masoomeh Jafari', 'معاون اجرایی', 'Deputy manager', '', '', NULL, 'Jafari.png'),
(7, 'سکینه پیره', 'Sakineh Pireh', 'رابط عربی', 'Arabic interface', 'دیپلم علوم تجربی', 'High School Diploma in Experimental Sciences', NULL, NULL),
(8, 'معصومه کاظمی', 'Masoomeh Kazemi', 'پرستار', 'Nurse', 'لیسانس پرستاری', 'Bachelor of Nursing', NULL, 'Kazemi.png'),
(9, 'فتحیه اسلامی', 'Fathieh Eslami', 'پرورشی ابتدایی', 'Assistant for elementary education', 'لیسانس مدیریت بازرگانی', 'Bachelor of Business Administration', NULL, 'Eslami.png'),
(10, 'نادر رضایی', 'Nader Rezaei', 'دبیر', 'Teacher', 'فوق لیسانس جغرافیای طبیعی', 'Master of Physical Geography', NULL, 'Rezaei.png'),
(11, 'فرزاد صمدی وحدتی', 'Farzad Samadi Vahdati', 'دبیر', 'Teacher', 'لیسانس مهندسی هوا و فضا', 'Bachelor of Aerospace Engineering', NULL, 'Samadi_Vahdati.png'),
(12, 'امیر حسین کر', 'Amir Hossein Kar', 'دبیر', 'Teacher', 'فوق لیسانس مدیریت آموزشی', 'Master of Educational Management', NULL, 'Kar.png'),
(13, 'مجید سرنی زاده', 'Majid Sarnezadeh', 'دبیر', 'Teacher', 'فوق لیسانس ریاضی', 'Master of Mathematics', NULL, 'Sarnezadeh.png'),
(14, 'وحید خسرونیا', 'Vahid Khosroniya', 'دبیر', 'Teacher', 'لیسانس مدیریت بازرگانی', 'Bachelor of Business Administration', NULL, 'Khosroniya.png'),
(15, 'شاپور امین گرفته', 'Shapoor Amin Gerefteh', 'دبیر', 'Teacher', 'لیسانس زبان انگلیسی', 'Bachelor of English Language', NULL, 'Amin_Gerefteh.png'),
(16, 'ناصر صالحی', 'Naser Salehi', 'دبیر', 'Teacher', 'فوق لیسانس زبان', 'Master of Language', NULL, 'Salehi.png'),
(17, 'علی اصغر رازقیان', 'Ali Asghar Razaghian', 'دبیر', 'Teacher', 'لیسانس ادبیات فارسی', 'Bachelor of Persian Literature', NULL, 'Razaghian.png'),
(18, 'عزیز درفشه', 'Aziz Dorfesheh', 'دبیر', 'Teacher', 'فوق دیپلم ادبیات', 'Associate Degree in Literature', NULL, 'Dorfesheh.png'),
(19, 'عبدالرحیم داودی', 'Abdolrahim Davoodi', 'دبیر', 'Teacher', 'لیسانس الهیات و معارف', 'Bachelor of Theology and Spirituality', NULL, 'Davoodi.png'),
(20, 'علیرضا کریمی', 'Alireza Karimi', 'دبیر', 'Teacher', 'فوق لیسانس', 'Master Degree', NULL, NULL),
(21, 'پرویز داداش پور', 'Parviz Dadashpour', 'دبیر', 'Teacher', '', '', NULL, 'Dadashpour.png'),
(22, 'بیژن بهزادی', 'Bijan Behzadi', 'دبیر', 'Teacher', '', '', NULL, 'Behzadi.png'),
(23, 'سید امیرضا میرحسینی', 'Seyyed Amir Reza Mirhosseini', 'دبیر', 'Teacher', '', '', NULL, 'Mirhosseini.png'),
(24, 'محمد بلوچی', 'Mohammad Balouchi', 'دبیر', 'Teacher', '', '', NULL, 'Balouchi.png'),
(25, 'مهرشاد ملاح', 'Mehrshad Mallah', 'معاون متوسطه اول', 'Vice President of the first secondary school', '', '', NULL, 'mallah.png'),
(26, 'سید محمد رضا مجری اصلی', 'Seyyed Mohammad Reza Mojri Asli', 'دبیر', 'Teacher', 'فوق لیسانس حقوق', 'Master of Law', NULL, 'Mojri_Asli.png'),
(27, 'زارع', 'Zare', 'کتابدار', 'the librarian', '', '', NULL, 'Zare.png'),
(28, 'افسانه پوربیاد', 'Afsaneh Poorbeyad', 'معاون ابتدایی', 'Elementary deputy', 'لیسانس آموزش ابتدایی', 'Bachelor of Elementary Education', NULL, NULL),
(29, 'فاطمه شکوهی', 'Fatemeh Shokouhi', 'آموزگار', 'Teacher', 'لیسانس روانشناسی', 'Bachelor of Psychology', NULL, 'Shokouhi.png'),
(30, 'ملیحه سلیمانی', 'Maliheh Soleimani', 'آموزگار', 'Teacher', 'دیپلم علوم تجربی', 'High School Diploma in Experimental Sciences', NULL, NULL),
(31, 'فاطمه ایشه', 'Fatemeh Eyshah', 'آموزگار', 'Teacher', 'لیسانس', 'Bachelor Degree', NULL, NULL),
(32, 'شهین محتاری', 'Shahin Mokhtari', 'آموزگار', 'Teacher', 'فوق دیپلم شیمی کاربردی', 'Associate Degree in Applied Chemistry', NULL, 'Mokhtari.png'),
(33, 'بهاره هاشمی', 'Bahareh Hashemi', 'مربی زبان', 'language instructor', 'فوق لیسانس زبان انگلیسی', 'Master of English Language', NULL, 'Hashemi.png'),
(34, 'سکینه پاینده', 'Sakineh Payandeh', 'آموزگار', 'Teacher', 'فوق دیپلم آموزش ابتدایی', 'Associate Degree in Elementary Education', NULL, NULL),
(35, 'فاطمه پوردرویشی', 'Fatemeh Poordarvishi', 'آموزگار', 'Teacher', 'فوق لیسانس زنتیک', 'Master of Genetics', NULL, NULL),
(36, 'فریبا پایمرد', 'Fariba Payamard', 'آموزگار', 'Teacher', 'لیسانس علوم تربیتی', 'Bachelor of Educational Sciences', NULL, 'Payamard.png'),
(37, 'لامیا', 'Lamia', 'مربی زبان', 'language instructor', 'لیسانس زبان و ادبیات عرب', 'Bachelor of Arabic Language and Literature', NULL, 'Lamiya.png'),
(38, 'زهرا راهدار', 'Zahra Rahdar', 'مربی زبان', 'language instructor', 'لیسانس زبان انگلیسی', 'Bachelor of English Language', NULL, NULL),
(39, 'خاطره اکبری', 'Khatereh Akbari', 'معاون آموزشی استثنایی', 'Elementary deputy', 'فوق لیسانس', 'Master Degree', NULL, NULL),
(40, 'طاهره پولادیان', 'Tahereh Pooladian', 'آموزگار', 'Teacher', 'لیسانس مدیریت آموزشی', 'Bachelor of Educational Management', NULL, NULL),
(41, 'طاهره پیره', 'Tahereh Pireh', 'آموزگار', 'Teacher', 'لیسانس روانشناسی', 'Bachelor of Psychology', NULL, NULL),
(42, 'نادیا رزم آهنگ', 'Nadia Razm Ahang', 'هنرآموز', 'Teacher', 'دیپلم ادبیات و علوم انسانی', 'High School Diploma in Literature and Humanities', NULL, NULL),
(43, 'حبیبه شعبانی', 'Habibeh Shabani', 'کمک حسابدار', 'Accountants', 'لیسانس روانشناسی', 'Bachelor of Psychology', NULL, NULL),
(44, 'عباس رییسی', 'Abbas Raeisi', 'راننده', 'Driver', 'سیکل', 'Primary Education', NULL, NULL),
(45, 'امامعلی فرخی نژاد', 'Emamali Farokhi Nejad', 'راننده', 'Driver', 'سیکل', 'Primary Education', NULL, NULL),
(46, 'سید جواد مجری اصل', 'Seyyed Javad Mojri Asl', 'راننده', 'Driver', 'دیپلم', 'High School Diploma', NULL, NULL),
(47, 'علی صیادی', 'Ali Sayadi', 'راننده', 'Driver', 'ابتدایی', 'Elementary Education', NULL, NULL),
(48, 'محمد سالاری', 'Mohammad Salari', 'راننده', 'Driver', 'سیکل', 'Primary Education', NULL, NULL),
(49, 'مصطفی ذاکری', 'Mostafa Zakeri', 'راننده', 'Driver', 'ابتدایی', 'Elementary Education', NULL, NULL),
(50, 'غلامعباس عباسی', 'Gholamabbas Abbasi', 'راننده', 'Driver', 'سیکل', 'Primary Education', NULL, NULL),
(51, 'تاج محمد درویش', 'Taj Mohammad Darvish', 'سرایدار', 'Janitor', 'بیسواد', 'Illiterate', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `Post_category_id_fkey` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
