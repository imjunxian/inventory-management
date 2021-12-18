

DROP TABLE attributes;

CREATE TABLE `attributes` (
  `attributeId` int(11) NOT NULL AUTO_INCREMENT,
  `attributeName` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`attributeId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


DROP TABLE attributes_value;

CREATE TABLE `attributes_value` (
  `attvalueId` int(11) NOT NULL AUTO_INCREMENT,
  `attvalueName` varchar(100) DEFAULT NULL,
  `parentId` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`attvalueId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


DROP TABLE backup;

CREATE TABLE `backup` (
  `backupId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `dateTime` varchar(255) NOT NULL,
  `users` varchar(20) NOT NULL,
  PRIMARY KEY (`backupId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



DROP TABLE brands;

CREATE TABLE `brands` (
  `brandId` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`brandId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



DROP TABLE category;

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) DEFAULT NULL,
  `categoryStatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



DROP TABLE company;

CREATE TABLE `company` (
  `companyId` int(11) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(100) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`companyId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


DROP TABLE customers;

CREATE TABLE `customers` (
  `customerId` int(11) NOT NULL AUTO_INCREMENT,
  `customerName` varchar(100) DEFAULT NULL,
  `customerEmail` varchar(100) DEFAULT NULL,
  `customerContact` varchar(20) DEFAULT NULL,
  `customerGender` varchar(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `AddedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`customerId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



DROP TABLE notes;

CREATE TABLE `notes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `date` varchar(100) NOT NULL,
  `userId` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



DROP TABLE orderitem;

CREATE TABLE `orderitem` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `unitAmount` varchar(50) NOT NULL,
  `sumAmount` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



DROP TABLE orders;

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceNo` varchar(100) NOT NULL,
  `orderCustName` varchar(255) NOT NULL,
  `orderCustContact` varchar(255) NOT NULL,
  `orderCustEmail` varchar(255) NOT NULL,
  `sales` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `subtotal` varchar(100) NOT NULL,
  `subcost` varchar(100) NOT NULL,
  `method` varchar(100) NOT NULL,
  `orderStatus` varchar(50) NOT NULL,
  `orderDateTime` varchar(50) NOT NULL,
  `orderMonth` varchar(100) NOT NULL,
  `orderYear` varchar(100) NOT NULL,
  `orderDate` varchar(100) NOT NULL,
  `orderTime` varchar(100) NOT NULL,
  `profit` varchar(20) NOT NULL,
  `salesperson` varchar(10) NOT NULL,
  `orderNote` longtext NOT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



DROP TABLE password_reset;

CREATE TABLE `password_reset` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expires` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



DROP TABLE products;

CREATE TABLE `products` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `productSKU` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `productName` text CHARACTER SET utf8 DEFAULT NULL,
  `productImage` text CHARACTER SET utf8 DEFAULT NULL,
  `productQuantity` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `productPrice` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `productCost` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `productDescription` longtext CHARACTER SET utf8 DEFAULT NULL,
  `brandId` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `categoryId` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `attvalueId` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `supplierId` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `availability` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `addDate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



DROP TABLE suppliers;

CREATE TABLE `suppliers` (
  `supplierId` int(11) NOT NULL AUTO_INCREMENT,
  `supplierName` varchar(100) DEFAULT NULL,
  `supplierEmail` varchar(100) DEFAULT NULL,
  `supplierContact` varchar(20) DEFAULT NULL,
  `supplierStatus` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`supplierId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



DROP TABLE users;

CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `userContact` varchar(20) DEFAULT NULL,
  `userGender` varchar(10) DEFAULT NULL,
  `userBirthDate` date DEFAULT NULL,
  `userRoles` varchar(10) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `lastLogin` varchar(50) DEFAULT NULL,
  `currentStatus` varchar(20) DEFAULT NULL,
  `profileImg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('1','Jun Xian','demo@demo.com','0124293014','Male','2001-07-29','SuperUser','$2y$10$F4cPSTpZqsGizPCcp1PqTOvvMoTnGx/7MIJqZAWGANcl7OKxRh1SK','Active','Mon 15:37:25 08/11/2021','Online','heartPirates.jpg');

