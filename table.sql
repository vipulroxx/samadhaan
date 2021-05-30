CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1


CREATE TABLE `concern` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `concernid` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `houseid` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `concern` varchar(2000) NOT NULL,
  `image` longblob DEFAULT NULL,
  `issuedon` datetime NOT NULL,
  `attendedon` datetime DEFAULT NULL,
  `attendedby` varchar(255) DEFAULT NULL,
  `agency` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `completed` blob DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  CONSTRAINT `concern_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4
