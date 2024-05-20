-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 May 2024, 21:13:27
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `eating-maker`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anasayfa_yemek`
--

CREATE TABLE `anasayfa_yemek` (
  `yemek_id` int(11) NOT NULL,
  `yemek_baslik` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `yemek_aciklama` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `yemek_footer` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `yemek_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `begeniler`
--

CREATE TABLE `begeniler` (
  `begen_id` int(11) NOT NULL,
  `begenilen_id` int(11) DEFAULT NULL,
  `begeni_tarih` timestamp NOT NULL DEFAULT current_timestamp(),
  `begenen_mail` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `begeniler`
--

INSERT INTO `begeniler` (`begen_id`, `begenilen_id`, `begeni_tarih`, `begenen_mail`) VALUES
(538, 70, '2022-05-05 15:55:38', 'ulas@gmail.com'),
(589, 76, '2022-05-11 18:54:14', 'demir@gmail.com'),
(604, 77, '2022-05-12 10:20:21', 'demir@gmail.com'),
(605, 75, '2022-05-12 10:39:27', 'demir@gmail.com'),
(606, 75, '2022-05-16 12:41:23', 'ulas@gmail.com'),
(611, 78, '2022-05-17 21:39:36', 'ulas@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `footer`
--

CREATE TABLE `footer` (
  `footer_id` int(11) NOT NULL,
  `footer_facebook` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `footer_twitter` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `footer_youtube` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `footer_instagram` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `footer_aciklama` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `footer_li_1` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `footer_li_2` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `footer_li_3` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `footer_li_4` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `footer`
--

INSERT INTO `footer` (`footer_id`, `footer_facebook`, `footer_twitter`, `footer_youtube`, `footer_instagram`, `footer_aciklama`, `footer_li_1`, `footer_li_2`, `footer_li_3`, `footer_li_4`) VALUES
(2, 'www.facebook.com', 'www.twitter.com', 'www.youtube.com', 'www.instagram.com', 'Sosyal medya hesaplarımızdan bizimle iletişime geçin ve yeniliklerden haberdar olmak için takipte kalın.', 'Bize Ulaşın', 'Eating-Maker İmdadınıza yetişti.', 'Eating-Maker', 'Eating-Maker ile yemek yapmak daha kolay.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gunun_menusu`
--

CREATE TABLE `gunun_menusu` (
  `menu_id` int(11) NOT NULL,
  `tarih` datetime NOT NULL,
  `menu_baslik` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `menu_aciklama` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `menu_resim` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `gunun_menusu`
--

INSERT INTO `gunun_menusu` (`menu_id`, `tarih`, `menu_baslik`, `menu_aciklama`, `menu_resim`) VALUES
(1, '1970-01-01 00:00:00', 'deneme', 'deneme', 'dimg/yemekler/2246427817267253109820344206312461331116pizza-kabar.jfif');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hastaliklar`
--

CREATE TABLE `hastaliklar` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `kullanici_id` int(11) NOT NULL,
  `kullanici_zaman` datetime NOT NULL DEFAULT current_timestamp(),
  `kullanici_resim` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_tc` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_mail` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_gsm` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_password` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_adsoyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_adres` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_il` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_ilce` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_unvan` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_yetki` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_durum` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`kullanici_id`, `kullanici_zaman`, `kullanici_resim`, `kullanici_tc`, `kullanici_ad`, `kullanici_mail`, `kullanici_gsm`, `kullanici_password`, `kullanici_adsoyad`, `kullanici_adres`, `kullanici_il`, `kullanici_ilce`, `kullanici_unvan`, `kullanici_yetki`, `kullanici_durum`) VALUES
(102, '2021-12-27 20:38:24', '', '', '', 'cyasar@gmail.com', '11111111111', 'f43affe6bd0c09a90d1dc23b0554b8d8', 'Çisem Yaşar', '', '', '', '', '5', 1),
(168, '2023-10-30 19:42:37', '', '', '', 'ulas', '', '123', '', '', '', '', '', '5', 1),
(169, '2024-05-18 22:10:03', '', '', '', 'ulsd@gmail.com', '5558833460', '$2y$10$6WUIaWzTSzpgLs281IdzzOEUy/WyzVdD8AVTPxY4Mf3IMLgkvfRr2', 'ulas', '', '', '', '', '1', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `malzemeler_yemek`
--

CREATE TABLE `malzemeler_yemek` (
  `malzemeler_yemek_id` int(11) NOT NULL,
  `malzemeler_yemek_baslik` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `malzemeler_yemek_aciklama` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `malzemeler_yemek_video` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `malzemeler_yemek_begeni_sayisi` int(11) NOT NULL,
  `ana_malzeme` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `malzemeler_yemek`
--

INSERT INTO `malzemeler_yemek` (`malzemeler_yemek_id`, `malzemeler_yemek_baslik`, `malzemeler_yemek_aciklama`, `malzemeler_yemek_video`, `malzemeler_yemek_begeni_sayisi`, `ana_malzeme`) VALUES
(14, 'a', 'a', 'PJ66Gjk6JSY', 0, 'asda'),
(15, 'asdsa', 'asd', 'ntoXepbWLFc', 0, 'ded');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `malzeme_ekle`
--

CREATE TABLE `malzeme_ekle` (
  `malzeme_id` int(11) NOT NULL,
  `malzeme_isim` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `malzeme_resimyol` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `malzeme_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `malzeme_sira` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `malzeme_ekle`
--

INSERT INTO `malzeme_ekle` (`malzeme_id`, `malzeme_isim`, `malzeme_resimyol`, `malzeme_durum`, `malzeme_sira`) VALUES
(3, 'deeeeeeeeeeeee', 'dimg/urunler/2493025376273822457320470281652278922737adana.jpg', '1', 1),
(4, 'Domates', 'dimg/urunler/3125227060223452305920097250042944023274burger_hamburger_black_burger_juicy_116248_1920x1080.jpg', '1', 2),
(11, 'asda', 'dimg/urunler/3021631767276942432720344206312461331116pizza-kabar.jfif', '1', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `memleket_yemek`
--

CREATE TABLE `memleket_yemek` (
  `memleket_id` int(11) NOT NULL,
  `memleket_isim` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `memleket_yemek_isim` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `memleket_videoyol` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `memleket_resimyol` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `memleket_icerik` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `memleket_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `memleket_yemek`
--

INSERT INTO `memleket_yemek` (`memleket_id`, `memleket_isim`, `memleket_yemek_isim`, `memleket_videoyol`, `memleket_resimyol`, `memleket_icerik`, `memleket_durum`) VALUES
(3, 'Tokat', 'elma', 'asdad', 'dimg/yemekler/2370820633265702124920280315643106120898adana.jpg', 'sadasd', '1'),
(4, 'Adana', 'Hamburger', 'tXxstcbXCpw', 'dimg/yemekler/2783822851235312585620097250042944023274burger_hamburger_black_burger_juicy_116248_1920x1080.jpg', 'deneme', '1'),
(5, 'Amasya', 'Pizza', 'tXxstcbXCpw', 'dimg/yemekler/2516431150291322297322137207072767927499pizza-kabar.gif', 'Pizza', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `puan`
--

CREATE TABLE `puan` (
  `puan_id` int(11) NOT NULL,
  `tarif_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `puan` int(11) NOT NULL,
  `kullanici_mail` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `puan`
--

INSERT INTO `puan` (`puan_id`, `tarif_id`, `kullanici_id`, `puan`, `kullanici_mail`) VALUES
(150, 59, 0, 5, 'demir@gmail.com'),
(151, 60, 0, 5, 'demir@gmail.com'),
(152, 60, 0, 4, 'ulas@gmail.com'),
(153, 59, 0, 1, 'ulas@gmail.com'),
(154, 61, 0, 1, 'ulas@gmail.com'),
(155, 63, 0, 4, 'ulas@gmail.com'),
(156, 62, 0, 4, 'ulas@gmail.com'),
(157, 69, 0, 5, 'ulas@gmail.com'),
(158, 68, 0, 5, 'ulas@gmail.com'),
(159, 74, 0, 4, 'ulas@gmail.com'),
(160, 74, 0, 1, 'serhat@gmail.com'),
(161, 70, 0, 5, 'ulas@gmail.com'),
(162, 75, 0, 1, 'ulas@gmail.com'),
(163, 75, 0, 5, 'ulasdasdasas@gmail.com'),
(164, 75, 0, 5, 'demir@gmail.com'),
(165, 76, 0, 1, 'ulas@gmail.com'),
(166, 78, 0, 5, 'ulas@gmail.com'),
(167, 75, 0, 5, 'ulsd@gmail.com'),
(168, 76, 0, 4, 'ulsd@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_ayar`
--

CREATE TABLE `site_ayar` (
  `ayar_id` int(11) NOT NULL,
  `ayar_description` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_keywords` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_author` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `icon_resimyol` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `site_ayar`
--

INSERT INTO `site_ayar` (`ayar_id`, `ayar_description`, `ayar_keywords`, `ayar_author`, `ayar_title`, `icon_resimyol`) VALUES
(2, 'a', 'a', 'a', 'ab', 'dimg/icon/31544222032774725997Flat_tick_icon.svg.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_ad` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `slider_resimyol` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `slider_sira` int(2) NOT NULL,
  `slider_link` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `slider_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_ad`, `slider_resimyol`, `slider_sira`, `slider_link`, `slider_durum`) VALUES
(2, '1', 'dimg/slider/2751127307277612375021781262692302122852kayseri.jpg', 1, '1', '1'),
(3, '1', 'dimg/slider/289362510330406248332141320549246572271320234211102477230862resim2.jpg', 2, '1', '1'),
(4, 'ulas', 'dimg/slider/2478929151270732257220097250042944023274burger_hamburger_black_burger_juicy_116248_1920x1080.jpg', 4, '3', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yemekler`
--

CREATE TABLE `yemekler` (
  `id` int(11) NOT NULL,
  `hastaid` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `content` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yemek_tarif`
--

CREATE TABLE `yemek_tarif` (
  `tarif_id` int(11) NOT NULL,
  `tarif_baslik` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `tarif_aciklama` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `tarif_footer` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `tarif_resimyol` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `tarif_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL,
  `paylasan_kullanici` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `begeni_sayisi` int(11) NOT NULL,
  `yorum_sayisi` int(11) NOT NULL DEFAULT 0,
  `tarif_puan` int(11) NOT NULL DEFAULT 0,
  `oy_sayisi` int(11) NOT NULL DEFAULT 0,
  `ortalama_puan` int(11) NOT NULL DEFAULT 0,
  `yemek_tur` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `yemek_icerik` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kupon_numarasi` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kupon_miktari` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kupon_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yemek_tarif`
--

INSERT INTO `yemek_tarif` (`tarif_id`, `tarif_baslik`, `tarif_aciklama`, `tarif_footer`, `tarif_resimyol`, `tarif_durum`, `paylasan_kullanici`, `begeni_sayisi`, `yorum_sayisi`, `tarif_puan`, `oy_sayisi`, `ortalama_puan`, `yemek_tur`, `yemek_icerik`, `kupon_numarasi`, `kupon_miktari`, `kupon_durum`) VALUES
(75, 'dee', 'dee', 'dee', 'dimg/yemekler/24049245122442421849adana2.jpg', '1', 'ulas@gmail.com', 5000, 1, 16, 4, 4, 'sicak-yemek', 'Glutenli', 'dee', '50', '1'),
(76, 'dee', 'dee', 'dee', 'dimg/yemekler/24049245122442421849adana2.jpg', '1', 'ulas@gmail.com', 13, 0, 16, 5, 3, 'sicak-yemek', 'Glutenli', 'dee', '50', '1'),
(77, 'dee', 'dee', 'dee', 'dimg/yemekler/24049245122442421849adana2.jpg', '1', 'ulas@gmail.com', 14, 1, 11, 3, 4, 'sicak-yemek', 'Glutenli', 'dee', '50', '1'),
(78, 'dee', 'dee', 'dee', 'dimg/yemekler/24049245122442421849adana2.jpg', '1', 'ulas@gmail.com', 15, 1, 17, 5, 3, 'sicak-yemek', 'Glutenli', 'dee', '50', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorum_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `yorum_detay` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `yorum_zaman` timestamp NOT NULL DEFAULT current_timestamp(),
  `tarif_id` int(11) NOT NULL,
  `yorumlar_adsoyad` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `begeni_sayisi` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`yorum_id`, `kullanici_id`, `yorum_detay`, `yorum_zaman`, `tarif_id`, `yorumlar_adsoyad`, `begeni_sayisi`) VALUES
(180, 105, 'denemeasdasdassadad', '2022-03-03 09:54:11', 0, 'demird', 0),
(368, 165, 'cvvbc', '2022-05-11 19:04:52', 75, 'ulas', 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `anasayfa_yemek`
--
ALTER TABLE `anasayfa_yemek`
  ADD PRIMARY KEY (`yemek_id`);

--
-- Tablo için indeksler `begeniler`
--
ALTER TABLE `begeniler`
  ADD PRIMARY KEY (`begen_id`);

--
-- Tablo için indeksler `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`footer_id`);

--
-- Tablo için indeksler `gunun_menusu`
--
ALTER TABLE `gunun_menusu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Tablo için indeksler `hastaliklar`
--
ALTER TABLE `hastaliklar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`kullanici_id`);

--
-- Tablo için indeksler `malzemeler_yemek`
--
ALTER TABLE `malzemeler_yemek`
  ADD PRIMARY KEY (`malzemeler_yemek_id`);

--
-- Tablo için indeksler `malzeme_ekle`
--
ALTER TABLE `malzeme_ekle`
  ADD PRIMARY KEY (`malzeme_id`);

--
-- Tablo için indeksler `memleket_yemek`
--
ALTER TABLE `memleket_yemek`
  ADD PRIMARY KEY (`memleket_id`);

--
-- Tablo için indeksler `puan`
--
ALTER TABLE `puan`
  ADD PRIMARY KEY (`puan_id`);

--
-- Tablo için indeksler `site_ayar`
--
ALTER TABLE `site_ayar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Tablo için indeksler `yemekler`
--
ALTER TABLE `yemekler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yemek_tarif`
--
ALTER TABLE `yemek_tarif`
  ADD PRIMARY KEY (`tarif_id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorum_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `anasayfa_yemek`
--
ALTER TABLE `anasayfa_yemek`
  MODIFY `yemek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `begeniler`
--
ALTER TABLE `begeniler`
  MODIFY `begen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=614;

--
-- Tablo için AUTO_INCREMENT değeri `footer`
--
ALTER TABLE `footer`
  MODIFY `footer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `gunun_menusu`
--
ALTER TABLE `gunun_menusu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `hastaliklar`
--
ALTER TABLE `hastaliklar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- Tablo için AUTO_INCREMENT değeri `malzemeler_yemek`
--
ALTER TABLE `malzemeler_yemek`
  MODIFY `malzemeler_yemek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `malzeme_ekle`
--
ALTER TABLE `malzeme_ekle`
  MODIFY `malzeme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `memleket_yemek`
--
ALTER TABLE `memleket_yemek`
  MODIFY `memleket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `puan`
--
ALTER TABLE `puan`
  MODIFY `puan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- Tablo için AUTO_INCREMENT değeri `site_ayar`
--
ALTER TABLE `site_ayar`
  MODIFY `ayar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `yemekler`
--
ALTER TABLE `yemekler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `yemek_tarif`
--
ALTER TABLE `yemek_tarif`
  MODIFY `tarif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
