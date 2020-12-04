DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`phone` varchar(255) DEFAULT NULL,
`email` varchar(255) DEFAULT NULL,
`address` varchar(255) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;

INSERT INTO `contact` (`id`, `phone`, `email`, `address`)
VALUES
(1,'0612345678','nerdy@gadgets.nl','nerdystraat 123'); 

/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;