

DROP TABLE attributes;

CREATE TABLE `attributes` (
  `attributeId` int(11) NOT NULL AUTO_INCREMENT,
  `attributeName` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`attributeId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO attributes (attributeId, attributeName, status) VALUES ('1','Color','Active');

INSERT INTO attributes (attributeId, attributeName, status) VALUES ('2','Size','Active');


DROP TABLE attributes_value;

CREATE TABLE `attributes_value` (
  `attvalueId` int(11) NOT NULL AUTO_INCREMENT,
  `attvalueName` varchar(100) DEFAULT NULL,
  `parentId` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`attvalueId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('1','Rose Gold','1','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('2','Gold','1','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('3','Black','1','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('4','42mm','2','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('5','44mm','2','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('6','38mm','2','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('7','36mm','2','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('8','43mm','2','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('9','Brown','1','Active');


DROP TABLE backup;

CREATE TABLE `backup` (
  `backupId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `dateTime` varchar(255) NOT NULL,
  `users` varchar(20) NOT NULL,
  PRIMARY KEY (`backupId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO backup (backupId, name, dateTime, users) VALUES ('4','Backup_25-11-2021_(00-03-45).sql','25 Nov 2021 00:03:45','1');

INSERT INTO backup (backupId, name, dateTime, users) VALUES ('5','Backup_28-11-2021_(18-57-37).sql','28 Nov 2021 18:57:37','1');


DROP TABLE brands;

CREATE TABLE `brands` (
  `brandId` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`brandId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO brands (brandId, brandName, status) VALUES ('1','Audemars Piguet (AP)','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('2','Rolex','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('3','Tag Heuer','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('4','Patek Philippe','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('5','Luminor Panerai','Active');


DROP TABLE category;

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) DEFAULT NULL,
  `categoryStatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO category (categoryId, categoryName, categoryStatus) VALUES ('1','Luxury','Active');

INSERT INTO category (categoryId, categoryName, categoryStatus) VALUES ('2','Mid Luxury','Active');

INSERT INTO category (categoryId, categoryName, categoryStatus) VALUES ('3','Basic','Active');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO company (companyId, companyName, address1, address2, postcode, city, state, country, contact, email) VALUES ('1','WatchShop','No9, Street9','SomeWhere9','10000','Georgetown','Penang','Malaysia','0123456789','watchshop@demo.com');


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('1','Customer1','cust1@cust.com','0124678812','Male','Active','1');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('2','Customer2','cust2@cust.com','0127890012','Male','Active','1');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('3','Customer3','cust3@cust.com','0198273312','Male','Active','1');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('4','Customer4','cust4@cust.com','0128891121','Female','Active','1');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('5','Customer5','cust5@cust.com','0123455561','Female','Active','3');


DROP TABLE notes;

CREATE TABLE `notes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `date` varchar(100) NOT NULL,
  `userId` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO notes (Id, title, description, date, userId) VALUES ('1','Note1','Note1 Description','Thu, 11 Nov 2021, 21:49:21','1');

INSERT INTO notes (Id, title, description, date, userId) VALUES ('2','Note2','Note2 Description
','Fri, 19 Nov 2021, 18:40:33','1');


DROP TABLE orderitem;

CREATE TABLE `orderitem` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `unitAmount` varchar(50) NOT NULL,
  `sumAmount` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('1','1','1','1','150000','150000.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('2','2','3','1','60000','60000.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('3','3','4','2','12000','24000.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('4','4','5','1','25000','25000.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('5','4','4','1','12000','12000.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('6','5','5','1','25000','25000.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('7','6','4','1','12000','12000.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('8','7','5','1','25000','25000.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('9','8','5','1','25000','25000.00');


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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('1','PO-1859499','Customer1','0124678812','cust1@cust.com','150000.00','0','150000.00','145000.00','Card','Completed','11 Nov 2021 21:46:24','Nov','2021','11 Nov 2021','21:46:24','5000.00','1','SomeNoteHere');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('2','PO-P250764','Customer2','0127890012','cust2@cust.com','60000.00','0','60000.00','50000.00','Cash','Completed','12 Nov 2021 21:36:38','Nov','2021','12 Nov 2021','21:36:38','10000.00','1','TestNote');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('3','PO-9399911','Customer3','0198273312','cust3@cust.com','24000.00','0','24000.00','22000.00','Card','Completed','19 Nov 2021 18:34:45','Nov','2021','19 Nov 2021','18:34:45','2000.00','1','XXXXX');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('4','PO-8990339','Customer4','0128891121','cust4@cust.com','37000.00','0','37000.00','34000.00','Transfer','Completed','20 Nov 2021 17:52:07','Nov','2021','20 Nov 2021','17:52:07','3000.00','1','grgrgr');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('5','PO-2862837','Customer1','0124678812','cust1@cust.com','25000.00','0','25000.00','23000.00','Cash','Completed','20 Nov 2021 17:53:01','Nov','2021','20 Nov 2021','17:53:01','2000.00','2','rgrg');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('6','PO-2767039','Customer3','0198273312','cust3@cust.com','11900.00','100','12000.00','11000.00','Cash','Completed','20 Nov 2021 17:55:29','Nov','2021','20 Nov 2021','17:55:29','900.00','2','d');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('7','PO-3291438','Customer5','0123455561','cust5@cust.com','25000.00','0','25000.00','23000.00','Card','Completed','21 Nov 2021 18:10:17','Nov','2021','21 Nov 2021','18:10:17','2000.00','3','fefef');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('8','PO-P478943','Customer3','0198273312','cust3@cust.com','25000.00','0','25000.00','23000.00','Cash','Completed','23 Nov 2021 13:24:27','Nov','2021','23 Nov 2021','13:24:27','2000.00','1','fefefe');


DROP TABLE password_reset;

CREATE TABLE `password_reset` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expires` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('1','APROORG01','Audemars Piguet Royal Oak Offshore','aproyaloakrg.jpg','4','150000','145000','Luxury Watch: Audemars Piguet (AP) Royal Oak Offshore&nbsp;','1','["1"]','["1","4","5"]','["1"]','Available','Active','2021-11-11 21:36:01');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('2','APROOB01','Audemars Piguet Royal Oak Offshore Chronograph ','aproyaloakb.jpg','3','162000','156000','Audemars Piguet Royal Oak Offshore Black Chronograph Dial Ceramic Watch','1','["1"]','["3","5"]','["1"]','Unavailable','Active','2021-11-11 21:42:08');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('3','ROLEXSUB01','Rolex Submariner ','rolexsub1.jpg','9','60000','50000','<p>Classic Rolex Watch&nbsp;</p>','2','["2"]','["3","5"]','["1"]','Available','Active','2021-11-11 21:45:08');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('4','THCBT01','Tag Heuer Calibre 5 ','tagheuer1.jpg','6','12000','11000','Tag Heuer Calibre 5 Black Titanium','3','["2"]','["3","8"]','["2"]','Available','Active','2021-11-19 18:32:12');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('5','LMP001','Luminor Panerai Marina ','luminorpanerai1.jpg','1','25000','23000','Luminor Panerai Marina Automatic','5','["2"]','["3","9","5"]','["2"]','Available','Active','2021-11-20 17:49:39');


DROP TABLE suppliers;

CREATE TABLE `suppliers` (
  `supplierId` int(11) NOT NULL AUTO_INCREMENT,
  `supplierName` varchar(100) DEFAULT NULL,
  `supplierEmail` varchar(100) DEFAULT NULL,
  `supplierContact` varchar(20) DEFAULT NULL,
  `supplierStatus` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`supplierId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO suppliers (supplierId, supplierName, supplierEmail, supplierContact, supplierStatus) VALUES ('1','Supplier1','supplier1@supplier.com','0124566612','Active');

INSERT INTO suppliers (supplierId, supplierName, supplierEmail, supplierContact, supplierStatus) VALUES ('2','Supplier2','supplier2@supplier.com','0125678819','Active');


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('1','Jun Xian','demo@demo.com','0124293014','Male','2001-07-29','SuperUser','$2y$10$F4cPSTpZqsGizPCcp1PqTOvvMoTnGx/7MIJqZAWGANcl7OKxRh1SK','Active','Sun 18:54:18 28/11/2021','Online','heartPirates.jpg');

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('2','Demo2','demo2@demo.com','0128891121','Male','1998-06-16','Admin','$2y$10$/vMSmUYTdJ2SPNr.ey/TTuYQm0QN2RsdLONsYqaiDT8bIS2R0g7Z.','Active','Sat 17:55:10 20/11/2021','Offline','demon.jpg');

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('3','demo3','demo3@demo.com','0124566612','Female','1997-11-20','Staff','$2y$10$H4nmPbsrgfusHUPNv9oycORcmd4rPrVktFOlMdPU.JKoiUvUfLTIC','Active','Sun 18:09:10 21/11/2021','Offline','jisoo.jpg');
