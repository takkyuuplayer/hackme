CREATE DATABASE IF NOT EXISTS `hackme`;
GRANT ALL ON `hackme`.* TO 'hackmeuser'@'localhost' IDENTIFIED BY 'hackmepass';
FLUSH PRIVILEGES;
