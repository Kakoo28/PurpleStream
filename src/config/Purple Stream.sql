CREATE TABLE `anime` (
  `animeID` integer PRIMARY KEY AUTO_INCREMENT,
  `animeName` varchar(100),
  `animeDescription` text,
  `animeImage` varchar(255),
  `animeMP4` varchar(255),
  `animeSeasonID` integer,
  `animeLanguageID` integer
);

CREATE TABLE `animeCat` (
  `animeID` integer,
  `animeCategoryID` integer
);

CREATE TABLE `animeCategory` (
  `animeCategoryID` integer PRIMARY KEY AUTO_INCREMENT,
  `animeCategoryName` varchar(100)
);

CREATE TABLE `animeEpisode` (
  `episodeID` integer PRIMARY KEY AUTO_INCREMENT,
  `animeSeasonID` integer,
  `episodeName` varchar(100),
  `episodeDescription` text,
  `episodeIMG` varchar(255),
  `episodeTime` varchar(20)
);

CREATE TABLE `animeSeason` (
  `animeSeasonID` integer PRIMARY KEY AUTO_INCREMENT,
  `animeSeasonName` varchar(100),
  `animeSeasonDescritption` text,
  `animeSeasonImage` varchar(255)
);

CREATE TABLE `animeLanguage` (
  `animeLanguageID` integer PRIMARY KEY AUTO_INCREMENT,
  `animeLanguageName` varchar(20)
);

CREATE TABLE `users` (
  `userdID` integer PRIMARY KEY AUTO_INCREMENT,
  `userEmail` varchar(100),
  `userName` varchar(100),
  `userPassword` varchar(255),
  `userRole` integer
);

CREATE TABLE `usersProfiles` (
  `userProfileID` integer PRIMARY KEY AUTO_INCREMENT,
  `userdID` integer,
  `userProfileName` varchar(30),
  `userProfileAvatar` varchar(255)
);

ALTER TABLE `animeCat` ADD FOREIGN KEY (`animeCategoryID`) REFERENCES `animeCategory` (`animeCategoryID`);

ALTER TABLE `animeCat` ADD FOREIGN KEY (`animeID`) REFERENCES `anime` (`animeID`);

ALTER TABLE `usersProfiles` ADD FOREIGN KEY (`userdID`) REFERENCES `users` (`userdID`);

ALTER TABLE `anime` ADD FOREIGN KEY (`animeSeasonID`) REFERENCES `animeSeason` (`animeSeasonID`);

ALTER TABLE `animeEpisode` ADD FOREIGN KEY (`animeSeasonID`) REFERENCES `animeSeason` (`animeSeasonID`);

ALTER TABLE `anime` ADD FOREIGN KEY (`animeLanguageID`) REFERENCES `animeLanguage` (`animeLanguageID`);
