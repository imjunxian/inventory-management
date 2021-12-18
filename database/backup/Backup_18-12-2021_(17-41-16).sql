

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('1','Black','1','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('2','White','1','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('3','Blue','1','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('4','US 9','2','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('5','US 9.5','2','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('6','US 10','2','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('7','US 10.5','2','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('8','US 11','2','Active');


DROP TABLE backup;

CREATE TABLE `backup` (
  `backupId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `dateTime` varchar(255) NOT NULL,
  `users` varchar(20) NOT NULL,
  PRIMARY KEY (`backupId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO backup (backupId, name, dateTime, users) VALUES ('4','Backup_18-12-2021_(17-41-16).sql','18 Dec 2021 17:41:16','1');


DROP TABLE brands;

CREATE TABLE `brands` (
  `brandId` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`brandId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO brands (brandId, brandName, status) VALUES ('1','Nike','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('2','Adidas Original','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('3','Balenciaga','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('4','Alexander Mcqueen','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('5','Gucci','Active');


DROP TABLE category;

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) DEFAULT NULL,
  `categoryStatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO category (categoryId, categoryName, categoryStatus) VALUES ('1','Sport','Active');

INSERT INTO category (categoryId, categoryName, categoryStatus) VALUES ('2','Luxury','Active');


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

INSERT INTO company (companyId, companyName, address1, address2, postcode, city, state, country, contact, email) VALUES ('1','SneakersStore','100, SomeWhere','Middle of NoWhere','14000','NoWhere','Penang','Malaysia','0192283374','sneakers@demo.com');


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('1','customer1','customer1@customer.com','0128092212','Female','Active','1');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('2','customer2','customer2@cust.com','0125667718','Male','Active','1');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('3','Customer3','customer3@cust.com','0125667781','Male','Active','1');


DROP TABLE notes;

CREATE TABLE `notes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `date` varchar(100) NOT NULL,
  `userId` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO notes (Id, title, description, date, userId) VALUES ('1','Note1','Note1 Description','Mon, 13 Dec 2021, 23:57:23','1');

INSERT INTO notes (Id, title, description, date, userId) VALUES ('2','Note2','Note 2 Description','Thu, 16 Dec 2021, 23:47:59','1');


DROP TABLE orderitem;

CREATE TABLE `orderitem` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `unitAmount` varchar(50) NOT NULL,
  `sumAmount` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('1','1','1','2','1500','3000.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('2','1','2','1','2399','2399.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('3','2','2','1','2399','2399.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('4','3','1','1','1500','1500.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('5','4','5','1','2199','2199.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('6','5','4','1','1500','1500.00');


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('1','PO-1225801','customer1','0128092212','customer1@customer.com','5399.00','0','5399.00','4700.00','Cash','Completed','15 Dec 2021 12:57:48','Dec','2021','15 Dec 2021','12:57:48','699.00','1','Notes...');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('2','PO-3272544','customer2','0125667718','customer2@cust.com','2349.00','50','2399.00','2100.00','Card','Completed','16 Dec 2021 23:44:50','Dec','2021','16 Dec 2021','23:44:50','249.00','1','Sample Order Note');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('3','PO-8942857','customer2','0125667718','customer2@cust.com','1500.00','0','1500.00','1300.00','Cash','Completed','17 Dec 2021 16:21:54','Dec','2021','17 Dec 2021','16:21:54','200.00','1','dfedvv');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('4','PO-6279985','Customer3','0125667781','customer3@cust.com','2199.00','0','2199.00','1800.00','Cash','Completed','18 Dec 2021 13:31:23','Dec','2021','18 Dec 2021','13:31:23','399.00','1','vdcdcd');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('5','PO-7323189','customer2','0125667718','customer2@cust.com','1500.00','0','1500.00','1300.00','Cash','Completed','18 Dec 2021 13:31:43','Dec','2021','18 Dec 2021','13:31:43','200.00','1','');


DROP TABLE password_reset;

CREATE TABLE `password_reset` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expires` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;


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

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('1','ALXDMQ10.5','Oversized Sneakers US 10.5','am.jpg','7','1500','1300','Alexander McQueen White Oversized Sneakers US 10.5.','4','["2"]','["2","7"]','["1"]','Available','Active','2021-12-11 15:20:33');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('2','BLCG1','Recycled Sneakers','balenciaga1.jpg','8','2399','2100','<p>Balenciaga Recycled Sneakers</p>','3','["1","2"]','["1","6","8"]','["1"]','Available','Active','2021-12-11 15:24:11');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('4','ALXDMQ','Oversized Sneakers US 10','am.jpg','7','1500','1300','Alexander Mcqueen Sneakers US 10','4','["2"]','["2","6"]','["1"]','Available','Active','2021-12-15 12:54:56');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('5','GWSN','Gucci White Sneaker','gucci.jpg','9','2199','1800','<p>Gucci White Sneakers</p>','5','["2"]','["2","6","7","8"]','["1"]','Available','Active','2021-12-18 13:30:36');


DROP TABLE suppliers;

CREATE TABLE `suppliers` (
  `supplierId` int(11) NOT NULL AUTO_INCREMENT,
  `supplierName` varchar(100) DEFAULT NULL,
  `supplierEmail` varchar(100) DEFAULT NULL,
  `supplierContact` varchar(20) DEFAULT NULL,
  `supplierStatus` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`supplierId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO suppliers (supplierId, supplierName, supplierEmail, supplierContact, supplierStatus) VALUES ('1','Supplier1','supplier1@supplier.com','0124566611','Active');


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('1','Jun Xian','demo@demo.com','0124293014','Male','2001-07-29','SuperUser','$2y$10$F4cPSTpZqsGizPCcp1PqTOvvMoTnGx/7MIJqZAWGANcl7OKxRh1SK','Active','Sat 17:41:02 18/12/2021','Online','heartPirates.jpg');

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('2','demo2','demo2@demo.com','0125677781','Female','1998-06-18','Admin','$2y$10$.00liR4qWmgJ6IW1VwTgaOSL7cD3IUnysFEnlupQBosgvKLg4J5z6','Active','Wed 18:05:31 15/12/2021','Offline','');
