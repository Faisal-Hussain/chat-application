-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 09 2023 г., 15:01
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `chatting`
--

-- --------------------------------------------------------

--
-- Структура таблицы `block_users`
--

CREATE TABLE `block_users` (
  `id` bigint UNSIGNED NOT NULL,
  `from_id` bigint UNSIGNED NOT NULL,
  `to_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint UNSIGNED NOT NULL,
  `from_id` bigint UNSIGNED NOT NULL,
  `to_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `conversations`
--

INSERT INTO `conversations` (`id`, `from_id`, `to_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2023-07-17 06:59:09', '2023-07-17 06:59:09'),
(2, 1, 3, '2023-07-20 07:01:02', '2023-07-20 07:01:02'),
(3, 1, 5, '2023-07-20 07:03:17', '2023-07-20 07:03:17'),
(4, 1, 6, '2023-07-20 07:03:19', '2023-07-20 07:03:19'),
(5, 1, 7, '2023-07-20 07:03:20', '2023-07-20 07:03:20'),
(6, 8, 1, '2023-08-03 07:25:16', '2023-08-03 07:25:16');

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `flag_link`) VALUES
(1, 'Afghanistan', 'AF', 'https://flagsapi.com/AF/flat/32.png'),
(2, 'Albania', 'AL', 'https://flagsapi.com/AL/flat/32.png'),
(3, 'Algeria', 'DZ', 'https://flagsapi.com/DZ/flat/32.png'),
(4, 'American Samoa', 'AS', 'https://flagsapi.com/AS/flat/32.png'),
(5, 'Andorra', 'AD', 'https://flagsapi.com/AD/flat/32.png'),
(6, 'Angola', 'AO', 'https://flagsapi.com/AO/flat/32.png'),
(7, 'Anguilla', 'AI', 'https://flagsapi.com/AI/flat/32.png'),
(8, 'Antarctica', 'AQ', 'https://flagsapi.com/AQ/flat/32.png'),
(9, 'Antigua And Barbuda', 'AG', 'https://flagsapi.com/AG/flat/32.png'),
(10, 'Argentina', 'AR', 'https://flagsapi.com/AR/flat/32.png'),
(11, 'Armenia', 'AM', 'https://flagsapi.com/AM/flat/32.png'),
(12, 'Aruba', 'AW', 'https://flagsapi.com/AW/flat/32.png'),
(13, 'Australia', 'AU', 'https://flagsapi.com/AU/flat/32.png'),
(14, 'Austria', 'AT', 'https://flagsapi.com/AT/flat/32.png'),
(15, 'Azerbaijan', 'AZ', 'https://flagsapi.com/AZ/flat/32.png'),
(16, 'Bahamas The', 'BS', 'https://flagsapi.com/BS/flat/32.png'),
(17, 'Bahrain', 'BH', 'https://flagsapi.com/BH/flat/32.png'),
(18, 'Bangladesh', 'BD', 'https://flagsapi.com/BD/flat/32.png'),
(19, 'Barbados', 'BB', 'https://flagsapi.com/BB/flat/32.png'),
(20, 'Belarus', 'BY', 'https://flagsapi.com/BY/flat/32.png'),
(21, 'Belgium', 'BE', 'https://flagsapi.com/BE/flat/32.png'),
(22, 'Belize', 'BZ', 'https://flagsapi.com/BZ/flat/32.png'),
(23, 'Benin', 'BJ', 'https://flagsapi.com/BJ/flat/32.png'),
(24, 'Bermuda', 'BM', 'https://flagsapi.com/BM/flat/32.png'),
(25, 'Bhutan', 'BT', 'https://flagsapi.com/BT/flat/32.png'),
(26, 'Bolivia', 'BO', 'https://flagsapi.com/BO/flat/32.png'),
(27, 'Bosnia and Herzegovina', 'BA', 'https://flagsapi.com/BA/flat/32.png'),
(28, 'Botswana', 'BW', 'https://flagsapi.com/BW/flat/32.png'),
(29, 'Bouvet Island', 'BV', 'https://flagsapi.com/BV/flat/32.png'),
(30, 'Brazil', 'BR', 'https://flagsapi.com/BR/flat/32.png'),
(31, 'British Indian Ocean Territory', 'IO', 'https://flagsapi.com/IO/flat/32.png'),
(32, 'Brunei', 'BN', 'https://flagsapi.com/BN/flat/32.png'),
(33, 'Bulgaria', 'BG', 'https://flagsapi.com/BG/flat/32.png'),
(34, 'Burkina Faso', 'BF', 'https://flagsapi.com/BF/flat/32.png'),
(35, 'Burundi', 'BI', 'https://flagsapi.com/BI/flat/32.png'),
(36, 'Cambodia', 'KH', 'https://flagsapi.com/KH/flat/32.png'),
(37, 'Cameroon', 'CM', 'https://flagsapi.com/CM/flat/32.png'),
(38, 'Canada', 'CA', 'https://flagsapi.com/CA/flat/32.png'),
(39, 'Cape Verde', 'CV', 'https://flagsapi.com/CV/flat/32.png'),
(40, 'Cayman Islands', 'KY', 'https://flagsapi.com/KY/flat/32.png'),
(41, 'Central African Republic', 'CF', 'https://flagsapi.com/CF/flat/32.png'),
(42, 'Chad', 'TD', 'https://flagsapi.com/TD/flat/32.png'),
(43, 'Chile', 'CL', 'https://flagsapi.com/CL/flat/32.png'),
(44, 'China', 'CN', 'https://flagsapi.com/CN/flat/32.png'),
(45, 'Christmas Island', 'CX', 'https://flagsapi.com/CX/flat/32.png'),
(46, 'Cocos (Keeling) Islands', 'CC', 'https://flagsapi.com/CC/flat/32.png'),
(47, 'Colombia', 'CO', 'https://flagsapi.com/CO/flat/32.png'),
(48, 'Comoros', 'KM', 'https://flagsapi.com/KM/flat/32.png'),
(49, 'Cook Islands', 'CK', 'https://flagsapi.com/CK/flat/32.png'),
(50, 'Costa Rica', 'CR', 'https://flagsapi.com/CR/flat/32.png'),
(51, 'Cote D\'Ivoire (Ivory Coast)', 'CI', 'https://flagsapi.com/CI/flat/32.png'),
(52, 'Croatia (Hrvatska)', 'HR', 'https://flagsapi.com/HR/flat/32.png'),
(53, 'Cuba', 'CU', 'https://flagsapi.com/CU/flat/32.png'),
(54, 'Cyprus', 'CY', 'https://flagsapi.com/CY/flat/32.png'),
(55, 'Czech Republic', 'CZ', 'https://flagsapi.com/CZ/flat/32.png'),
(56, 'Democratic Republic Of The Congo', 'CD', 'https://flagsapi.com/CD/flat/32.png'),
(57, 'Denmark', 'DK', 'https://flagsapi.com/DK/flat/32.png'),
(58, 'Djibouti', 'DJ', 'https://flagsapi.com/DJ/flat/32.png'),
(59, 'Dominica', 'DM', 'https://flagsapi.com/DM/flat/32.png'),
(60, 'Dominican Republic', 'DO', 'https://flagsapi.com/DO/flat/32.png'),
(61, 'East Timor', 'TP', 'https://flagsapi.com/TP/flat/32.png'),
(62, 'Ecuador', 'EC', 'https://flagsapi.com/EC/flat/32.png'),
(63, 'Egypt', 'EG', 'https://flagsapi.com/EG/flat/32.png'),
(64, 'El Salvador', 'SV', 'https://flagsapi.com/SV/flat/32.png'),
(65, 'Equatorial Guinea', 'GQ', 'https://flagsapi.com/GQ/flat/32.png'),
(66, 'Eritrea', 'ER', 'https://flagsapi.com/ER/flat/32.png'),
(67, 'Estonia', 'EE', 'https://flagsapi.com/EE/flat/32.png'),
(68, 'Ethiopia', 'ET', 'https://flagsapi.com/ET/flat/32.png'),
(69, 'Falkland Islands', 'FK', 'https://flagsapi.com/FK/flat/32.png'),
(70, 'Faroe Islands', 'FO', 'https://flagsapi.com/FO/flat/32.png'),
(71, 'Fiji Islands', 'FJ', 'https://flagsapi.com/FJ/flat/32.png'),
(72, 'Finland', 'FI', 'https://flagsapi.com/FI/flat/32.png'),
(73, 'France', 'FR', 'https://flagsapi.com/FR/flat/32.png'),
(74, 'French Guiana', 'GF', 'https://flagsapi.com/GF/flat/32.png'),
(75, 'French Polynesia', 'PF', 'https://flagsapi.com/PF/flat/32.png'),
(76, 'French Southern Territories', 'TF', 'https://flagsapi.com/TF/flat/32.png'),
(77, 'Gabon', 'GA', 'https://flagsapi.com/GA/flat/32.png'),
(78, 'Gambia The', 'GM', 'https://flagsapi.com/GM/flat/32.png'),
(79, 'Georgia', 'GE', 'https://flagsapi.com/GE/flat/32.png'),
(80, 'Germany', 'DE', 'https://flagsapi.com/DE/flat/32.png'),
(81, 'Ghana', 'GH', 'https://flagsapi.com/GH/flat/32.png'),
(82, 'Gibraltar', 'GI', 'https://flagsapi.com/GI/flat/32.png'),
(83, 'Greece', 'GR', 'https://flagsapi.com/GR/flat/32.png'),
(84, 'Greenland', 'GL', 'https://flagsapi.com/GL/flat/32.png'),
(85, 'Grenada', 'GD', 'https://flagsapi.com/GD/flat/32.png'),
(86, 'Guadeloupe', 'GP', 'https://flagsapi.com/GP/flat/32.png'),
(87, 'Guam', 'GU', 'https://flagsapi.com/GU/flat/32.png'),
(88, 'Guatemala', 'GT', 'https://flagsapi.com/GT/flat/32.png'),
(89, 'Guernsey and Alderney', 'XU', 'https://flagsapi.com/XU/flat/32.png'),
(90, 'Guinea', 'GN', 'https://flagsapi.com/GN/flat/32.png'),
(91, 'Guinea-Bissau', 'GW', 'https://flagsapi.com/GW/flat/32.png'),
(92, 'Guyana', 'GY', 'https://flagsapi.com/GY/flat/32.png'),
(93, 'Haiti', 'HT', 'https://flagsapi.com/HT/flat/32.png'),
(94, 'Heard and McDonald Islands', 'HM', 'https://flagsapi.com/HM/flat/32.png'),
(95, 'Honduras', 'HN', 'https://flagsapi.com/HN/flat/32.png'),
(96, 'Hong Kong S.A.R.', 'HK', 'https://flagsapi.com/HK/flat/32.png'),
(97, 'Hungary', 'HU', 'https://flagsapi.com/HU/flat/32.png'),
(98, 'Iceland', 'IS', 'https://flagsapi.com/IS/flat/32.png'),
(99, 'India', 'IN', 'https://flagsapi.com/IN/flat/32.png'),
(100, 'Indonesia', 'ID', 'https://flagsapi.com/ID/flat/32.png'),
(101, 'Iran', 'IR', 'https://flagsapi.com/IR/flat/32.png'),
(102, 'Iraq', 'IQ', 'https://flagsapi.com/IQ/flat/32.png'),
(103, 'Ireland', 'IE', 'https://flagsapi.com/IE/flat/32.png'),
(104, 'Israel', 'IL', 'https://flagsapi.com/IL/flat/32.png'),
(105, 'Italy', 'IT', 'https://flagsapi.com/IT/flat/32.png'),
(106, 'Jamaica', 'JM', 'https://flagsapi.com/JM/flat/32.png'),
(107, 'Japan', 'JP', 'https://flagsapi.com/JP/flat/32.png'),
(108, 'Jersey', 'XJ', 'https://flagsapi.com/XJ/flat/32.png'),
(109, 'Jordan', 'JO', 'https://flagsapi.com/JO/flat/32.png'),
(110, 'Kazakhstan', 'KZ', 'https://flagsapi.com/KZ/flat/32.png'),
(111, 'Kenya', 'KE', 'https://flagsapi.com/KE/flat/32.png'),
(112, 'Kiribati', 'KI', 'https://flagsapi.com/KI/flat/32.png'),
(113, 'Korea North', 'KP', 'https://flagsapi.com/KP/flat/32.png'),
(114, 'Korea South', 'KR', 'https://flagsapi.com/KR/flat/32.png'),
(115, 'Kuwait', 'KW', 'https://flagsapi.com/KW/flat/32.png'),
(116, 'Kyrgyzstan', 'KG', 'https://flagsapi.com/KG/flat/32.png'),
(117, 'Laos', 'LA', 'https://flagsapi.com/LA/flat/32.png'),
(118, 'Latvia', 'LV', 'https://flagsapi.com/LV/flat/32.png'),
(119, 'Lebanon', 'LB', 'https://flagsapi.com/LB/flat/32.png'),
(120, 'Lesotho', 'LS', 'https://flagsapi.com/LS/flat/32.png'),
(121, 'Liberia', 'LR', 'https://flagsapi.com/LR/flat/32.png'),
(122, 'Libya', 'LY', 'https://flagsapi.com/LY/flat/32.png'),
(123, 'Liechtenstein', 'LI', 'https://flagsapi.com/LI/flat/32.png'),
(124, 'Lithuania', 'LT', 'https://flagsapi.com/LT/flat/32.png'),
(125, 'Luxembourg', 'LU', 'https://flagsapi.com/LU/flat/32.png'),
(126, 'Macau S.A.R.', 'MO', 'https://flagsapi.com/MO/flat/32.png'),
(127, 'Macedonia', 'MK', 'https://flagsapi.com/MK/flat/32.png'),
(128, 'Madagascar', 'MG', 'https://flagsapi.com/MG/flat/32.png'),
(129, 'Malawi', 'MW', 'https://flagsapi.com/MW/flat/32.png'),
(130, 'Malaysia', 'MY', 'https://flagsapi.com/MY/flat/32.png'),
(131, 'Maldives', 'MV', 'https://flagsapi.com/MV/flat/32.png'),
(132, 'Mali', 'ML', 'https://flagsapi.com/ML/flat/32.png'),
(133, 'Malta', 'MT', 'https://flagsapi.com/MT/flat/32.png'),
(134, 'Man (Isle of)', 'XM', 'https://flagsapi.com/XM/flat/32.png'),
(135, 'Marshall Islands', 'MH', 'https://flagsapi.com/MH/flat/32.png'),
(136, 'Martinique', 'MQ', 'https://flagsapi.com/MQ/flat/32.png'),
(137, 'Mauritania', 'MR', 'https://flagsapi.com/MR/flat/32.png'),
(138, 'Mauritius', 'MU', 'https://flagsapi.com/MU/flat/32.png'),
(139, 'Mayotte', 'YT', 'https://flagsapi.com/YT/flat/32.png'),
(140, 'Mexico', 'MX', 'https://flagsapi.com/MX/flat/32.png'),
(141, 'Micronesia', 'FM', 'https://flagsapi.com/FM/flat/32.png'),
(142, 'Moldova', 'MD', 'https://flagsapi.com/MD/flat/32.png'),
(143, 'Monaco', 'MC', 'https://flagsapi.com/MC/flat/32.png'),
(144, 'Mongolia', 'MN', 'https://flagsapi.com/MN/flat/32.png'),
(145, 'Montserrat', 'MS', 'https://flagsapi.com/MS/flat/32.png'),
(146, 'Morocco', 'MA', 'https://flagsapi.com/MA/flat/32.png'),
(147, 'Mozambique', 'MZ', 'https://flagsapi.com/MZ/flat/32.png'),
(148, 'Myanmar', 'MM', 'https://flagsapi.com/MM/flat/32.png'),
(149, 'Namibia', 'NA', 'https://flagsapi.com/NA/flat/32.png'),
(150, 'Nauru', 'NR', 'https://flagsapi.com/NR/flat/32.png'),
(151, 'Nepal', 'NP', 'https://flagsapi.com/NP/flat/32.png'),
(152, 'Netherlands Antilles', 'AN', 'https://flagsapi.com/AN/flat/32.png'),
(153, 'Netherlands The', 'NL', 'https://flagsapi.com/NL/flat/32.png'),
(154, 'New Caledonia', 'NC', 'https://flagsapi.com/NC/flat/32.png'),
(155, 'New Zealand', 'NZ', 'https://flagsapi.com/NZ/flat/32.png'),
(156, 'Nicaragua', 'NI', 'https://flagsapi.com/NI/flat/32.png'),
(157, 'Niger', 'NE', 'https://flagsapi.com/NE/flat/32.png'),
(158, 'Nigeria', 'NG', 'https://flagsapi.com/NG/flat/32.png'),
(159, 'Niue', 'NU', 'https://flagsapi.com/NU/flat/32.png'),
(160, 'Norfolk Island', 'NF', 'https://flagsapi.com/NF/flat/32.png'),
(161, 'Northern Mariana Islands', 'MP', 'https://flagsapi.com/MP/flat/32.png'),
(162, 'Norway', 'NO', 'https://flagsapi.com/NO/flat/32.png'),
(163, 'Oman', 'OM', 'https://flagsapi.com/OM/flat/32.png'),
(164, 'Pakistan', 'PK', 'https://flagsapi.com/PK/flat/32.png'),
(165, 'Palau', 'PW', 'https://flagsapi.com/PW/flat/32.png'),
(166, 'Palestinian Territory Occupied', 'PS', 'https://flagsapi.com/PS/flat/32.png'),
(167, 'Panama', 'PA', 'https://flagsapi.com/PA/flat/32.png'),
(168, 'Papua new Guinea', 'PG', 'https://flagsapi.com/PG/flat/32.png'),
(169, 'Paraguay', 'PY', 'https://flagsapi.com/PY/flat/32.png'),
(170, 'Peru', 'PE', 'https://flagsapi.com/PE/flat/32.png'),
(171, 'Philippines', 'PH', 'https://flagsapi.com/PH/flat/32.png'),
(172, 'Pitcairn Island', 'PN', 'https://flagsapi.com/PN/flat/32.png'),
(173, 'Poland', 'PL', 'https://flagsapi.com/PL/flat/32.png'),
(174, 'Portugal', 'PT', 'https://flagsapi.com/PT/flat/32.png'),
(175, 'Puerto Rico', 'PR', 'https://flagsapi.com/PR/flat/32.png'),
(176, 'Qatar', 'QA', 'https://flagsapi.com/QA/flat/32.png'),
(177, 'Republic Of The Congo', 'CG', 'https://flagsapi.com/CG/flat/32.png'),
(178, 'Reunion', 'RE', 'https://flagsapi.com/RE/flat/32.png'),
(179, 'Romania', 'RO', 'https://flagsapi.com/RO/flat/32.png'),
(180, 'Russia', 'RU', 'https://flagsapi.com/RU/flat/32.png'),
(181, 'Rwanda', 'RW', 'https://flagsapi.com/RW/flat/32.png'),
(182, 'Saint Helena', 'SH', 'https://flagsapi.com/SH/flat/32.png'),
(183, 'Saint Kitts And Nevis', 'KN', 'https://flagsapi.com/KN/flat/32.png'),
(184, 'Saint Lucia', 'LC', 'https://flagsapi.com/LC/flat/32.png'),
(185, 'Saint Pierre and Miquelon', 'PM', 'https://flagsapi.com/PM/flat/32.png'),
(186, 'Saint Vincent And The Grenadines', 'VC', 'https://flagsapi.com/VC/flat/32.png'),
(187, 'Samoa', 'WS', 'https://flagsapi.com/WS/flat/32.png'),
(188, 'San Marino', 'SM', 'https://flagsapi.com/SM/flat/32.png'),
(189, 'Sao Tome and Principe', 'ST', 'https://flagsapi.com/ST/flat/32.png'),
(190, 'Saudi Arabia', 'SA', 'https://flagsapi.com/SA/flat/32.png'),
(191, 'Senegal', 'SN', 'https://flagsapi.com/SN/flat/32.png'),
(192, 'Serbia', 'RS', 'https://flagsapi.com/RS/flat/32.png'),
(193, 'Seychelles', 'SC', 'https://flagsapi.com/SC/flat/32.png'),
(194, 'Sierra Leone', 'SL', 'https://flagsapi.com/SL/flat/32.png'),
(195, 'Singapore', 'SG', 'https://flagsapi.com/SG/flat/32.png'),
(196, 'Slovakia', 'SK', 'https://flagsapi.com/SK/flat/32.png'),
(197, 'Slovenia', 'SI', 'https://flagsapi.com/SI/flat/32.png'),
(198, 'Smaller Territories of the UK', 'XG', 'https://flagsapi.com/XG/flat/32.png'),
(199, 'Solomon Islands', 'SB', 'https://flagsapi.com/SB/flat/32.png'),
(200, 'Somalia', 'SO', 'https://flagsapi.com/SO/flat/32.png'),
(201, 'South Africa', 'ZA', 'https://flagsapi.com/ZA/flat/32.png'),
(202, 'South Georgia', 'GS', 'https://flagsapi.com/GS/flat/32.png'),
(203, 'South Sudan', 'SS', 'https://flagsapi.com/SS/flat/32.png'),
(204, 'Spain', 'ES', 'https://flagsapi.com/ES/flat/32.png'),
(205, 'Sri Lanka', 'LK', 'https://flagsapi.com/LK/flat/32.png'),
(206, 'Sudan', 'SD', 'https://flagsapi.com/SD/flat/32.png'),
(207, 'Suriname', 'SR', 'https://flagsapi.com/SR/flat/32.png'),
(208, 'Svalbard And Jan Mayen Islands', 'SJ', 'https://flagsapi.com/SJ/flat/32.png'),
(209, 'Swaziland', 'SZ', 'https://flagsapi.com/SZ/flat/32.png'),
(210, 'Sweden', 'SE', 'https://flagsapi.com/SE/flat/32.png'),
(211, 'Switzerland', 'CH', 'https://flagsapi.com/CH/flat/32.png'),
(212, 'Syria', 'SY', 'https://flagsapi.com/SY/flat/32.png'),
(213, 'Taiwan', 'TW', 'https://flagsapi.com/TW/flat/32.png'),
(214, 'Tajikistan', 'TJ', 'https://flagsapi.com/TJ/flat/32.png'),
(215, 'Tanzania', 'TZ', 'https://flagsapi.com/TZ/flat/32.png'),
(216, 'Thailand', 'TH', 'https://flagsapi.com/TH/flat/32.png'),
(217, 'Togo', 'TG', 'https://flagsapi.com/TG/flat/32.png'),
(218, 'Tokelau', 'TK', 'https://flagsapi.com/TK/flat/32.png'),
(219, 'Tonga', 'TO', 'https://flagsapi.com/TO/flat/32.png'),
(220, 'Trinidad And Tobago', 'TT', 'https://flagsapi.com/TT/flat/32.png'),
(221, 'Tunisia', 'TN', 'https://flagsapi.com/TN/flat/32.png'),
(222, 'Turkey', 'TR', 'https://flagsapi.com/TR/flat/32.png'),
(223, 'Turkmenistan', 'TM', 'https://flagsapi.com/TM/flat/32.png'),
(224, 'Turks And Caicos Islands', 'TC', 'https://flagsapi.com/TC/flat/32.png'),
(225, 'Tuvalu', 'TV', 'https://flagsapi.com/TV/flat/32.png'),
(226, 'Uganda', 'UG', 'https://flagsapi.com/UG/flat/32.png'),
(227, 'Ukraine', 'UA', 'https://flagsapi.com/UA/flat/32.png'),
(228, 'United Arab Emirates', 'AE', 'https://flagsapi.com/AE/flat/32.png'),
(229, 'United Kingdom', 'GB', 'https://flagsapi.com/GB/flat/32.png'),
(230, 'United States', 'US', 'https://flagsapi.com/US/flat/32.png'),
(231, 'United States Minor Outlying Islands', 'UM', 'https://flagsapi.com/UM/flat/32.png'),
(232, 'Uruguay', 'UY', 'https://flagsapi.com/UY/flat/32.png'),
(233, 'Uzbekistan', 'UZ', 'https://flagsapi.com/UZ/flat/32.png'),
(234, 'Vanuatu', 'VU', 'https://flagsapi.com/VU/flat/32.png'),
(235, 'Vatican City State (Holy See)', 'VA', 'https://flagsapi.com/VA/flat/32.png'),
(236, 'Venezuela', 'VE', 'https://flagsapi.com/VE/flat/32.png'),
(237, 'Vietnam', 'VN', 'https://flagsapi.com/VN/flat/32.png'),
(238, 'Virgin Islands (British)', 'VG', 'https://flagsapi.com/VG/flat/32.png'),
(239, 'Virgin Islands (US)', 'VI', 'https://flagsapi.com/VI/flat/32.png'),
(240, 'Wallis And Futuna Islands', 'WF', 'https://flagsapi.com/WF/flat/32.png'),
(241, 'Western Sahara', 'EH', 'https://flagsapi.com/EH/flat/32.png'),
(242, 'Yemen', 'YE', 'https://flagsapi.com/YE/flat/32.png'),
(243, 'Yugoslavia', 'YU', 'https://flagsapi.com/YU/flat/32.png'),
(244, 'Zambia', 'ZM', 'https://flagsapi.com/ZM/flat/32.png'),
(245, 'Zimbabwe', 'ZW', 'https://flagsapi.com/ZW/flat/32.png');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Message', 4, '8728b131-4b7d-4bc9-bbb6-5afeb5287c73', 'image', 'Screenshot (1)', 'Screenshot-(1).png', 'image/png', 'public', 'public', 488614, '[]', '[]', '[]', '[]', 1, '2023-07-20 03:46:24', '2023-07-20 03:46:24'),
(2, 'App\\Models\\Message', 5, '744b2977-c1a9-41ed-bd54-3576180f4c16', 'image', 'Screenshot (3)', 'Screenshot-(3).png', 'image/png', 'public', 'public', 482539, '[]', '[]', '[]', '[]', 2, '2023-07-20 03:53:13', '2023-07-20 03:53:13'),
(3, 'App\\Models\\Message', 19, '582a4d27-8688-4c85-b428-80f1870f868d', 'image', 'Screenshot (1)', 'Screenshot-(1).png', 'image/png', 'public', 'public', 488614, '[]', '[]', '[]', '[]', 3, '2023-07-21 07:53:22', '2023-07-21 07:53:22'),
(4, 'App\\Models\\Message', 19, '2a0d6eab-8a5f-4b17-b98f-cd90d45ceb39', 'image', 'Screenshot (2) - Copy', 'Screenshot-(2)---Copy.png', 'image/png', 'public', 'public', 482971, '[]', '[]', '[]', '[]', 4, '2023-07-21 07:53:23', '2023-07-21 07:53:23');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `conversation_id` bigint UNSIGNED NOT NULL,
  `from_id` bigint UNSIGNED NOT NULL,
  `to_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `from_id`, `to_id`, `message`, `read`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'hi', 1, '2023-07-17 06:59:28', '2023-08-07 09:48:00'),
(2, 1, 2, 1, 'hi', 1, '2023-07-17 07:09:48', '2023-08-07 09:48:00'),
(3, 1, 1, 2, 'by by', 1, '2023-07-18 01:13:37', '2023-08-07 09:54:31'),
(4, 1, 1, 2, NULL, 1, '2023-07-20 03:46:23', '2023-08-07 09:54:31'),
(5, 1, 1, 2, 'sadasdjasjd', 1, '2023-07-20 03:53:13', '2023-08-07 09:54:31'),
(6, 1, 1, 2, 'by', 1, '2023-07-20 03:58:54', '2023-08-07 09:54:31'),
(7, 1, 1, 2, '😛😜😘😘😘', 1, '2023-07-20 05:25:33', '2023-08-07 09:54:31'),
(8, 1, 1, 2, ';\'\\', 1, '2023-07-20 05:51:06', '2023-08-07 09:54:31'),
(9, 1, 2, 1, 'hi', 1, '2023-07-20 06:24:22', '2023-08-07 09:48:00'),
(10, 1, 1, 2, 'asdasdasddddddddddddddd', 1, '2023-07-21 04:07:50', '2023-08-07 09:54:31'),
(11, 1, 1, 2, 'asdasdasddddddddddddddd\r\nasdasd', 1, '2023-07-21 04:07:51', '2023-08-07 09:54:31'),
(12, 1, 1, 2, 'asdasd', 1, '2023-07-21 04:07:52', '2023-08-07 09:54:31'),
(13, 1, 1, 2, 'as\r\nd', 1, '2023-07-21 04:07:52', '2023-08-07 09:54:31'),
(14, 1, 1, 2, 'as\r\ndas\r\nd', 1, '2023-07-21 04:07:52', '2023-08-07 09:54:31'),
(15, 1, 1, 2, 'as\r\ndas\r\nda\r\ns', 1, '2023-07-21 04:07:53', '2023-08-07 09:54:31'),
(16, 1, 1, 2, 'h1', 1, '2023-07-21 05:36:56', '2023-08-07 09:54:31'),
(17, 1, 2, 1, 'test2', 1, '2023-07-21 05:37:07', '2023-08-07 09:48:00'),
(18, 1, 1, 2, '😝😛😘😘😘😘😘😘😘', 1, '2023-07-21 07:51:38', '2023-08-07 09:54:31'),
(19, 1, 1, 2, 'nmj hgjgj', 1, '2023-07-21 07:53:22', '2023-08-07 09:54:31'),
(20, 1, 1, 2, 'test', 1, '2023-08-02 05:43:36', '2023-08-07 09:54:31'),
(21, 1, 2, 1, 'hi', 1, '2023-08-07 09:26:17', '2023-08-07 09:48:00'),
(22, 1, 2, 1, 'j', 1, '2023-08-07 09:29:30', '2023-08-07 09:48:00'),
(23, 1, 2, 1, 'fghfgh', 1, '2023-08-07 09:29:45', '2023-08-07 09:48:00'),
(24, 1, 2, 1, 'asdcas', 1, '2023-08-07 09:31:17', '2023-08-07 09:48:00'),
(25, 1, 2, 1, 'bbbbbbbbbbbbbbbbbbbbbbbb', 1, '2023-08-07 09:32:01', '2023-08-07 09:48:00'),
(26, 1, 2, 1, 'ASas', 1, '2023-08-07 09:33:49', '2023-08-07 09:48:00'),
(27, 1, 2, 1, 'qwedqwe', 1, '2023-08-07 09:35:25', '2023-08-07 09:48:00'),
(28, 1, 2, 1, 'a', 1, '2023-08-07 09:40:27', '2023-08-07 09:48:00'),
(29, 1, 2, 1, 'sdfsfsd', 1, '2023-08-07 09:42:38', '2023-08-07 09:48:00'),
(30, 1, 2, 1, 'asdasdasd', 1, '2023-08-07 09:46:52', '2023-08-07 09:48:00'),
(31, 1, 2, 1, 'kjljk', 0, '2023-08-07 09:48:15', '2023-08-07 09:48:15'),
(32, 1, 2, 1, 'sdfsdf', 0, '2023-08-07 09:49:11', '2023-08-07 09:49:11'),
(33, 1, 2, 1, 'sdfsdf', 0, '2023-08-07 09:49:16', '2023-08-07 09:49:16'),
(34, 1, 2, 1, 'sdfsdfsd', 0, '2023-08-07 09:51:30', '2023-08-07 09:51:30'),
(35, 1, 2, 1, 'Aas', 0, '2023-08-07 09:54:35', '2023-08-07 09:54:35');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_07_17_094438_create_countries_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_03_112956_create_permission_tables', 1),
(7, '2023_07_07_130320_create_conversations_table', 1),
(8, '2023_07_07_130421_create_messages_table', 1),
(9, '2023_07_12_075149_create_media_table', 1),
(10, '2023_07_14_074155_create_block_users_table', 1),
(11, '2023_07_27_114931_create_period_vip_users_table', 2),
(12, '2023_08_02_120447_create_reports_table', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 5),
(1, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `period_vip_users`
--

CREATE TABLE `period_vip_users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `period_vip_users`
--

INSERT INTO `period_vip_users` (`id`, `user_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 4, '2023-07-27', '2023-08-05', '2023-07-27 08:02:46', '2023-07-27 08:05:56');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `reports`
--

CREATE TABLE `reports` (
  `id` bigint UNSIGNED NOT NULL,
  `from_id` bigint UNSIGNED NOT NULL,
  `to_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reports`
--

INSERT INTO `reports` (`id`, `from_id`, `to_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'test', '2023-08-02 08:08:37', '2023-08-02 08:08:37'),
(2, 2, 1, 'repor2', '2023-08-03 09:33:39', '2023-08-03 09:33:39'),
(3, 2, 1, 'report3', '2023-08-03 09:33:48', '2023-08-03 09:33:48'),
(4, 2, 1, 'report4', '2023-08-03 09:33:56', '2023-08-03 09:33:56'),
(5, 2, 1, 'report5', '2023-08-03 09:34:03', '2023-08-03 09:34:03'),
(6, 2, 1, 'report8', '2023-08-03 09:34:24', '2023-08-03 09:34:24'),
(7, 2, 1, 'report9', '2023-08-03 09:34:31', '2023-08-03 09:34:31'),
(8, 2, 1, 'resport8', '2023-08-03 09:34:55', '2023-08-03 09:34:55');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'basic', 'web', '2023-07-17 06:58:00', '2023-07-17 06:58:00'),
(2, 'vip', 'web', '2023-07-17 06:58:00', '2023-07-17 06:58:00'),
(3, 'admin', 'web', '2023-07-17 06:58:00', '2023-07-17 06:58:00');

-- --------------------------------------------------------

--
-- Структура таблицы `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `nick_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `country_id`, `nick_name`, `age`, `state`, `password`, `gender`, `blocked`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 'test1', 20, 'Delvine', '$2y$10$a3wtbcgmLvfwanNxGlIN6.afUFmfEPEaPyQk8.BG7zPfe/cf/jmBq', '1', 0, NULL, '2023-07-17 06:58:21', '2023-07-28 07:06:31'),
(2, 13, 'test2', 22, 'Queensland', '$2y$10$Vfz/hflxQTqVr4z.Hf9VF.1PcceXwKKPtyNSg4SftfztEKTgJ8RlO', '2', 0, NULL, '2023-07-17 06:58:55', '2023-08-03 09:31:47'),
(3, 1, 'test3', 21, 'Badgis', '$2y$10$KUZY39JKCTQFiHkMS0S5FeE7eg.NLIgIi6Fs39K0pIPd59zJZjlNW', '1', 0, NULL, '2023-07-18 07:14:18', '2023-07-18 07:14:18'),
(4, 5, 'test5', 20, 'Les Escaldes', '$2y$10$wrtgBGXXE3jcYB/XD5W7.e5xlWEHdr00aJHavDF4g5DTJxnlHz.8u', '2', 0, NULL, '2023-07-20 06:03:17', '2023-07-20 06:03:17'),
(5, 1, 'test11', 20, 'Badgis', '$2y$10$StehRl2GSK7FBlK.nJEV9eNPjj3ke2kGbujQoUvkGjrall0DvJVwi', '2', 0, NULL, '2023-07-20 06:38:59', '2023-07-20 06:38:59'),
(6, 3, 'test13', 20, 'Adrar', '$2y$10$GrgDDvmgzh3wUDPRp7tV9OSwQXbXQ9PXYdDROG3FZLl9y7RuNF3z2', '1', 0, NULL, '2023-07-20 06:40:00', '2023-07-20 06:40:00'),
(7, 3, 'test15', 20, 'Adrar', '$2y$10$Jrps5iBre/x9at4du4qjAeH7sUw1LkuvkwNgxiKQhKkesX6za28Vu', '2', 0, NULL, '2023-07-20 06:43:27', '2023-07-20 06:43:27'),
(8, 230, 'admin', 40, 'California', '$2y$10$YjGz54MypYSHkw.Cm/KTTeb/T3SWgv.Uh.wLSqQpnFf6fcmVwciz.', '1', 0, NULL, '2023-07-24 05:53:02', '2023-07-24 05:53:02');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `block_users`
--
ALTER TABLE `block_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `block_users_from_id_foreign` (`from_id`),
  ADD KEY `block_users_to_id_foreign` (`to_id`);

--
-- Индексы таблицы `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversations_from_id_foreign` (`from_id`),
  ADD KEY `conversations_to_id_foreign` (`to_id`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`),
  ADD KEY `messages_from_id_foreign` (`from_id`),
  ADD KEY `messages_to_id_foreign` (`to_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `period_vip_users`
--
ALTER TABLE `period_vip_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_vip_users_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_from_id_foreign` (`from_id`),
  ADD KEY `reports_to_id_foreign` (`to_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nick_name_unique` (`nick_name`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_age_index` (`age`),
  ADD KEY `users_state_index` (`state`),
  ADD KEY `users_gender_index` (`gender`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `block_users`
--
ALTER TABLE `block_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `period_vip_users`
--
ALTER TABLE `period_vip_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `block_users`
--
ALTER TABLE `block_users`
  ADD CONSTRAINT `block_users_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `block_users_to_id_foreign` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversations_to_id_foreign` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_to_id_foreign` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `period_vip_users`
--
ALTER TABLE `period_vip_users`
  ADD CONSTRAINT `period_vip_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_to_id_foreign` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
