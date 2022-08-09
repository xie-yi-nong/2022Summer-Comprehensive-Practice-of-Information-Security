CREATE DATABASE IF NOT EXISTS garbage_collection;

use garbage_collection;

DROP TABLE IF EXISTS `file`;
CREATE TABLE `file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mime` varchar(50) NOT NULL,
  `size` longtext NOT NULL,
  `data` mediumblob NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
INSERT INTO `user` VALUES (1,'a','atest@test.com','a12345678','$2y$10$Kt1GEZF6AIC5WDtvKqeHVu.DnafA2SnHkIIFZCTnaBnWRKlrbAi52'),(2,'b','btest@test.com','b12345678','$2y$10$2EVrN/3okVR35GIJueA8CuBJerCBU/wCQtJymkYgGoQjFHanmgMIK'),(3,'c','ctest@test.com','c12345678','$2y$10$m6/npXua8p286yaLnkTqCOqYMf37jVHWdlUxa6unxd/gBs9DZEKUy'),(4,'a','etest@test.com','a12345678','$2y$10$qjLSQXcAo4Fph2b/58u13.gEHjCBX036rcCseJ7ovD7RJ48MH/Fvy');

CREATE USER 'garbage_collection'@'%' IDENTIFIED BY 'garbage_collection';
grant all privileges on *.* to 'garbage_collection'@'%';
FLUSH PRIVILEGES;
