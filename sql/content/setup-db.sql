--
-- Create the database with a test user
--
CREATE DATABASE IF NOT EXISTS oophp;
GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
USE oophp;
