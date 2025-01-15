-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Sty 2023, 20:20
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bookshop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adminaccount`
--

CREATE TABLE `adminaccount` (
  `id` int(15) UNSIGNED NOT NULL,
  `PersonalData` varchar(200) COLLATE utf8mb4_polish_ci NOT NULL,
  `login` varchar(150) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `adminaccount`
--

INSERT INTO `adminaccount` (`id`, `PersonalData`, `login`, `password`) VALUES
(9, 'admin', 'admin', '$2y$10$PuDroD1akjfhNJCAh9pynewaUbfafm3e3waYsIFHBMo1LHVB.ke6K'),
(10, 'Kacper Obrzut', 'kacper', '$2y$10$kvjOEQIZCWeVbvEjMUoiFeRjKcxZ9FvtA8Qf3erQ18r2vwlzHlDnC');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `book`
--

CREATE TABLE `book` (
  `id` int(15) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `pictureBook` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `bookcategoryId` int(15) NOT NULL,
  `available` varchar(15) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `price`, `description`, `pictureBook`, `bookcategoryId`, `available`) VALUES
(18, 'The Exorcist', 'Blatty William Peter', '43.00', 'Father Damien Karras: \'Where is Regan?\' Regan MacNeil: \'In here. This edition, polished and expanded by the author, includes new dialogue, a new character and a chilling new extended scene.\r\n', 'book_851.jpeg', 9, 'Yes'),
(19, 'It', 'King Stephen', '25.00', 'Welcome to Derry, Maine. It’s a small city, a place as hauntingly familiar as your own hometown. Only in Derry the haunting is real.They were seven teenagers when they first stumbled upon the horror.', 'book_981.jpg', 9, 'Yes'),
(20, 'Last Wish: Introducing the Witcher', 'Andrzej Sapkowski', '54.00', 'Geralt the Witcher—revered and hated—holds the line against the monsters plaguing humanity in this collection of adventures, the first chapter in Andrzej Sapkowski’s groundbreaking epic fantasy series that inspired the hit Netflix show.\r\n', 'book_970.jpg', 11, 'Yes'),
(21, 'A Game of Thrones', 'Martin George R. R.', '63.00', 'HBO\'s hit series A GAME OF THRONES is based on George R R Martin\'s internationally bestselling series A SONG OF ICE AND FIRE, the greatest fantasy epic of the modern age. A GAME OF THRONES is the first volume in the series.\r\n', 'book_615.jpg', 11, 'Yes'),
(22, 'The Hobbit', 'Tolkien John Ronald Reuel', '34.00', 'The journey through Middle-earth begins here with J.R.R. Tolkien\'s classic prelude to his Lord of the Rings trilogy.\r\n', 'book_950.jpg', 11, 'Yes'),
(23, 'Sherlock Holmes', 'Arthur Conan Doyle\r\n', '55.00', 'Sherlock Holmes is a fictional detective created by British author Arthur Conan Doyle. Referring to himself as a \"consulting detective\" in the stories, Holmes is known for his proficiency with observation, deduction, forensic science.\r\n', 'book_983.jpg', 10, 'Yes'),
(24, 'And Then There Were None', 'Christie Agata', '53.00', 'Ten strangers, apparently with little in common, are lured to an island mansion off the coast of Devon by the mysterious U.N.Owen. Over dinner, a record begins to play, and the voice of an unseen host accuses each person of hiding a guilty secret.\r\n', 'book_967.jpg', 10, 'Yes'),
(25, 'Murder on the Orient Express', 'Christie Agata\r\n', '64.00', 'The Queen of Mystery has come to Harper Collins! Agatha Christie, the acknowledged mistress of suspense—creator of indomitable sleuth Miss Marple, meticulous Belgian detective Hercule Poirot, and so many other unforgettable characters.\r\n', 'book_976.jpg', 10, 'Yes'),
(26, 'Harry Potter and the Philosopher\'s Stone', 'Rowling J. K.\r\n', '43.00', 'Harry Potter and the Philosopher\'s Stone was J.K. Rowling\'s first novel, followed by the subsequent six titles in the Harry Potter series, as well as three books written for charity: Fantastic Beasts and Where to Find Them, Quidditch Through the Ages.\r\n', 'book_597.jpg', 11, 'Yes');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bookcategory`
--

CREATE TABLE `bookcategory` (
  `id` int(15) UNSIGNED NOT NULL,
  `genre` varchar(200) COLLATE utf8mb4_polish_ci NOT NULL,
  `pictureGenre` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `available` varchar(15) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `bookcategory`
--

INSERT INTO `bookcategory` (`id`, `genre`, `pictureGenre`, `available`) VALUES
(9, 'Horror', 'bookcategory_689.png', 'Yes'),
(10, 'Crime', 'bookcategory_577.jpg', 'Yes'),
(11, 'Fantasy', 'bookcategory_52.jpg', 'Yes');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orderbooks`
--

CREATE TABLE `orderbooks` (
  `id` int(15) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `book` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `quantity` int(100) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `orderDate` datetime NOT NULL,
  `clientName` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `clientPhone` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `clientEmail` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `clientAddress` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `orderStatus` varchar(80) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `orderbooks`
--

INSERT INTO `orderbooks` (`id`, `price`, `book`, `quantity`, `totalPrice`, `orderDate`, `clientName`, `clientPhone`, `clientEmail`, `clientAddress`, `orderStatus`) VALUES
(44, '64.00', 'Murder on the Orient Express', 2, '128.00', '2023-01-19 07:53:53', 'Kacper Obrzut', '1724894345', 'kmobrzut@student.wsb-nlu.edu.pl', 'Zielona 65, Nowy Sacz, Poland', 'Delivered'),
(45, '54.00', 'Last Wish: Introducing the Witcher', 4, '216.00', '2023-01-19 07:55:09', 'Jan Kogut', '4544894343', 'jkogut334@gmail.com', 'Lesna 32, Krakow, Poland', 'Ordered');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adminaccount`
--
ALTER TABLE `adminaccount`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `bookcategory`
--
ALTER TABLE `bookcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orderbooks`
--
ALTER TABLE `orderbooks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `adminaccount`
--
ALTER TABLE `adminaccount`
  MODIFY `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `book`
--
ALTER TABLE `book`
  MODIFY `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `bookcategory`
--
ALTER TABLE `bookcategory`
  MODIFY `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `orderbooks`
--
ALTER TABLE `orderbooks`
  MODIFY `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
