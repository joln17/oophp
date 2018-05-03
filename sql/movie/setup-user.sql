
--
-- Create the database with a testuser
--
-- CREATE DATABASE IF NOT EXISTS oophp;
-- GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
-- USE oophp;

-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;


--
-- Create table for movie user database
--
DROP TABLE IF EXISTS `movie_user`;
CREATE TABLE `movie_user`
(
    `user` VARCHAR(32) PRIMARY KEY NOT NULL,
    `password` CHAR(60) NOT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

DELETE FROM `movie_user`;
INSERT INTO `movie_user` (`user`, `password`) VALUES
    ('***user_name_removed***', '$2y$10$0C5ON/zGHbzCSC9fWP09hO2SFBa5ukyGQg4ckK/dnuyO25YKtrasO'),
    ('***user_name_removed***', '$2y$10$09HU242IXXeUXEWh5CZJjuYVraaoVNBnKXDMePW4Zz3tMnZRnldP.')
;

SELECT * FROM `movie_user`;
