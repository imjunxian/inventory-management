

DROP TABLE attributes;

CREATE TABLE `attributes` (
  `attributeId` int(11) NOT NULL AUTO_INCREMENT,
  `attributeName` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`attributeId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO attributes (attributeId, attributeName, status) VALUES ('1','Color','Active');

INSERT INTO attributes (attributeId, attributeName, status) VALUES ('3','Display','Inactive');

INSERT INTO attributes (attributeId, attributeName, status) VALUES ('11','TestForRecycleBin','Inactive');

INSERT INTO attributes (attributeId, attributeName, status) VALUES ('12','Storage','Active');


DROP TABLE attributes_value;

CREATE TABLE `attributes_value` (
  `attvalueId` int(11) NOT NULL AUTO_INCREMENT,
  `attvalueName` varchar(100) DEFAULT NULL,
  `parentId` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`attvalueId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('1','Black','1','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('2','5.8 inches','3','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('5','Red','1','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('6','6.1 inches','3','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('7','White','1','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('11','Blue','1','Inactive');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('21','Graphite','1','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('22','6.7 inches','3','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('23','64GB','12','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('24','128GB','12','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('25','256GB','12','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('26','512GB','12','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('27','1TB','12','Active');

INSERT INTO attributes_value (attvalueId, attvalueName, parentId, status) VALUES ('28','Space Grey','1','Active');


DROP TABLE backup;

CREATE TABLE `backup` (
  `backupId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `dateTime` varchar(255) NOT NULL,
  `users` varchar(20) NOT NULL,
  PRIMARY KEY (`backupId`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

INSERT INTO backup (backupId, name, dateTime, users) VALUES ('82','Backup_01-11-2021_(17-22-09).sql','01 Nov 2021 17:22:09','6');


DROP TABLE brands;

CREATE TABLE `brands` (
  `brandId` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`brandId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO brands (brandId, brandName, status) VALUES ('1','Apple','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('3','Vivo','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('4','Huawei','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('10','Asus','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('11','Klipsch','Active');

INSERT INTO brands (brandId, brandName, status) VALUES ('12','hgf','Inactive');


DROP TABLE category;

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) DEFAULT NULL,
  `categoryStatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO category (categoryId, categoryName, categoryStatus) VALUES ('1','Tablet','Active');

INSERT INTO category (categoryId, categoryName, categoryStatus) VALUES ('2','ACC','Active');

INSERT INTO category (categoryId, categoryName, categoryStatus) VALUES ('4','Mobile','Active');

INSERT INTO category (categoryId, categoryName, categoryStatus) VALUES ('14','Second-hand','Inactive');

INSERT INTO category (categoryId, categoryName, categoryStatus) VALUES ('15','Laptop','Active');


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO company (companyId, companyName, address1, address2, postcode, city, state, country, contact, email) VALUES ('1','Mobile Shop','3, Jalan Perai 5','Bandar Perai Jaya','13700','Perai','Penang','Malaysia','0169696969','mobilestore@demo.com');


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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('1','cust1','cust@cust.com','0123456788','Female','Active','6');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('5','cust3','cust3@cust.com','0123547988','Female','Active','10');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('6','cust2','cust20@cust.com','9123829002','Male','Active','6');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('7','cust4','cust4@cust.com','0128971123','Male','Active','7');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('8','cust5','cust5@cust.com','0129990000','Female','Inactive','6');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('18','cust10','cust10@cust.com','01290878900','Male','Active','6');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('20','cust12','cust12@cust.com','0126789902','Female','Active','16');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('28','cust13','cust13@cust.com','0123445571','Male','Active','6');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('29','cust14','cust14@cust.com','0123445521','Male','Active','6');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('30','cust16','cust16@cust16.com','0199382346','Male','Active','6');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('31','cust15','cust15@cust15.com','0152242223','Female','Active','6');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('32','cust17','cust17@cust.com','0192890097','Male','Active','32');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('33','cust18','cust18@cust.com','0124453321','Male','Inactive','6');

INSERT INTO customers (customerId, customerName, customerEmail, customerContact, customerGender, status, AddedBy) VALUES ('34','cust19','cust19@cust.com','0124562271','Female','Inactive','6');


DROP TABLE notes;

CREATE TABLE `notes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `date` varchar(100) NOT NULL,
  `userId` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

INSERT INTO notes (Id, title, description, date, userId) VALUES ('27','Note1','Note1 Description','Fri, 15 Oct 2021, 19:18:49','6');

INSERT INTO notes (Id, title, description, date, userId) VALUES ('28','Note2','Note2 Description','Fri, 15 Oct 2021, 19:19:03','6');

INSERT INTO notes (Id, title, description, date, userId) VALUES ('29','Note3','Note3 Description
','Fri, 15 Oct 2021, 19:19:38','6');

INSERT INTO notes (Id, title, description, date, userId) VALUES ('30','Note4','Note4 Description','Fri, 15 Oct 2021, 19:19:49','6');

INSERT INTO notes (Id, title, description, date, userId) VALUES ('31','Note5','Note5 Description5
','Fri, 15 Oct 2021, 19:20:10','6');


DROP TABLE orderitem;

CREATE TABLE `orderitem` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `unitAmount` varchar(50) NOT NULL,
  `sumAmount` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('4','7','3','2','4599','9198.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('5','7','10','2','89','178.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('6','8','4','1','1099','1099.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('7','8','10','2','89','178.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('8','9','19','2','1299','2598.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('13','10','10','2','89','178.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('14','10','19','1','1299','1299.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('15','11','3','1','4599','4599.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('16','11','10','1','89','89.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('17','11','16','1','2499','2499.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('18','11','19','1','1299','1299.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('19','12','10','2','89','178.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('20','13','18','1','3299','3299.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('22','19','10','3','89','267.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('23','20','4','1','1099','1099.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('24','21','19','6','1299','7794.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('25','22','28','1','6599','6599.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('28','24','28','1','6599','6599.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('29','24','4','2','1099','2198.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('30','27','3','1','4599','4599.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('31','27','10','1','89','89.00');

INSERT INTO orderitem (Id, orderId, productId, quantity, unitAmount, sumAmount) VALUES ('32','27','4','1','1099','1099.00');


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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('7','PO-P270707','cust1','0123456788','cust@cust.com','9376.00','0','9376.00','8736.00','Cash','Cancelled','12 Oct 2021 12:26:52','Oct','2021','12 Oct 2021','12:26:52','640.00','6','bbbbb');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('8','PO-8853059','cust3','0123547988','cust3@cust.com','1267.00','10','1277.00','1137.00','Card','Completed','12 Oct 2021 12:55:36','Oct','2021','12 Oct 2021','12:55:36','130.00','6','Paid');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('9','PO-7097914','cust12','0126789902','cust12@cust.com','2598.00','0','2598.00','1998.00','Transfer','Completed','12 Oct 2021 13:46:09','Oct','2021','12 Oct 2021','13:46:09','600.00','6','Take it on 5pm 12/10/2021');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('10','PO-9271112','cust10','01290878900','cust10@cust.com','1477.00','0','1477.00','1137.00','Card','Completed','12 Oct 2021 21:43:23','Oct','2021','12 Oct 2021','21:43:23','340.00','6','hththt');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('11','PO-2570315','cust1','0123456788','cust@cust.com','8486.00','0','8486.00','7666.00','Cash','Completed','12 Oct 2021 21:48:33','Oct','2021','12 Oct 2021','21:48:33','820.00','6','SomeNoteHere');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('12','PO-1673859','cust13','0123445571','cust13@cust.com','178.00','0','178.00','138.00','Cash','Completed','12 Oct 2021 21:50:07','Oct','2021','12 Oct 2021','21:50:07','40.00','7','noNote');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('13','PO-5339841','cust16','0199382346','cust16@cust16.com','3299.00','0','3299.00','2999.00','Cash','Pending','13 Oct 2021 12:33:47','Oct','2021','13 Oct 2021','12:33:47','300.00','6','frrfv');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('19','PO-9835809','cust15','0152242223','cust15@cust15.com','267.00','0','267.00','207.00','Cash','Completed','13 Oct 2021 23:39:38','Oct','2021','13 Oct 2021','23:39:38','60.00','10','NoteHere');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('20','PO-9670554','cust3','0123547988','cust3@cust.com','1099.00','0','1099.00','999.00','Cash','Pending','14 Oct 2021 11:14:53','Oct','2021','14 Oct 2021','11:14:53','100.00','6','cdc');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('21','PO-1310561','cust12','0126789902','cust12@cust.com','7794.00','0','7794.00','5994.00','Cash','Completed','14 Oct 2021 16:57:45','Oct','2021','14 Oct 2021','16:57:45','1800.00','7','ecd');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('22','PO-4936286','cust12','0126789902','cust12@cust.com','6599.00','0','6599.00','6299.00','Cash','Completed','14 Oct 2021 17:02:33','Oct','2021','14 Oct 2021','17:02:33','300.00','16','Blabla');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('24','PO-1571943','cust15','0152242223','cust15@cust15.com','8797.00','0','8797.00','8297.00','Cash','Completed','14 Oct 2021 21:43:38','Oct','2021','14 Oct 2021','21:43:38','500.00','10','BlahBlahBlah');

INSERT INTO orders (orderId, invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('27','PO-4849174','cust17','0192890097','cust17@cust.com','5787.00','0','5787.00','5367.00','Cash','Completed','18 Oct 2021 23:44:31','Oct','2021','18 Oct 2021','23:44:31','420.00','6','qqqq');


DROP TABLE password_reset;

CREATE TABLE `password_reset` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expires` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;


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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('2','TESTSKU','TestProductName','am.jpg','0','99','50','This is Testing Product Description.','1','["2","4"]','["1","7","23"]','["1","7"]','Unavailable','Active','2021-09-06 19:34:04');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('3','IPHN12P','Apple IPhone 12 Pro','p1.jpg','1','4599','4299','Color : Black , 512GB. Warranty 1 year at Apple Service Center.','1','["2"]','["1"]','["1"]','Available','Active','2021-09-06 19:58:03');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('4','APPRO','Apple AirPods Pro','p3.jpg','3','1099','999','Color : White, Noise Cancellation. Warranty 6 months in Apple Service Center.','1','["4"]','["7"]','[]','Available','Active','2021-09-06 20:20:04');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('6','IPHN12','Apple IPhone 12','p2.jpg','1','3599','3399','Color : Red, 256GB. Warranty 1 year in Apple Service Center.','1','["2"]','["5","25"]','["7"]','Available','Active','2021-09-06 21:44:50');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('10','IPHCABLE','Apple IPhone Lightning Cable','p5.jpg','9','89','69','Apple Original Charging Cable. Warranty 3 months.','1','["4"]','["7"]','["7"]','Available','Active','2021-09-07 02:34:01');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('16','ASROG','Asus ROG','asusrog.jpg','4','2499','2299','Processor: speed-binned 2.96GHz Qualcomm Snapdragon 845.&nbsp;RAM &amp; Storage: 512GB / 1TB, 12 GB RAM','10','["4"]','["1","7"]','["12"]','Unavailable','Active','2021-09-21 11:50:25');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('17','HWMATE','Huawei Mate 30 Pro','huaweimate30pro.png','5','2999','2799','8GB RAM 128GB Storage.','4','["4"]','["5","24"]','["7"]','Available','Inactive','2021-09-21 11:52:04');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('18','VVNEX','Vivo Nex 3','vivonex3.png','0','3299','2999','8GB RAM 128GB Storage.','3','["4"]','["1"]','["16"]','Available','Active','2021-09-21 11:53:12');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('19','KPSMC','Klipsch T5 II True Wireless Sport McLaren Edition Earphones','klipsch.jpg','5','1299','999','It designed for the harshest, loudest conditions on the planet. Engineered for extreme performance and reliability. Forged with premium materials and advanced technology. Created in concert with McLaren for the ultimate in fidelity, fit and finish. #SPEEDOFSOUND','11','["2"]','["1"]','["1"]','Available','Active','2021-09-27 21:52:28');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('20','IPH13PM','IPhone 13 Pro Max','iphone-13-pro-max-graphite.png','0','7599','7299','','1','["4"]','["21"]','["16"]','Available','Active','2021-09-28 22:43:40');

INSERT INTO products (productId, productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, availability, status, addDate) VALUES ('28','APPMACBPRO','Apple Macbook Pro 13 inches 2020','macbookpro1.jpg','3','6599','6299','Apple Macbook Pro 2020 256GB.','1','["15"]','["28","25"]','["16"]','Available','Active','2021-10-12 22:28:09');


DROP TABLE suppliers;

CREATE TABLE `suppliers` (
  `supplierId` int(11) NOT NULL AUTO_INCREMENT,
  `supplierName` varchar(100) DEFAULT NULL,
  `supplierEmail` varchar(100) DEFAULT NULL,
  `supplierContact` varchar(20) DEFAULT NULL,
  `supplierStatus` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`supplierId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO suppliers (supplierId, supplierName, supplierEmail, supplierContact, supplierStatus) VALUES ('1','Supplier1','supplier1@demo.com','01987765633','Active');

INSERT INTO suppliers (supplierId, supplierName, supplierEmail, supplierContact, supplierStatus) VALUES ('7','Supplier2','supplier2@demo.com','0198787666','Active');

INSERT INTO suppliers (supplierId, supplierName, supplierEmail, supplierContact, supplierStatus) VALUES ('12','Supplier4','supplier4@demo.com','0165526652','Active');

INSERT INTO suppliers (supplierId, supplierName, supplierEmail, supplierContact, supplierStatus) VALUES ('16','Supplier5','supplier5@demo.com','0123212232','Active');

INSERT INTO suppliers (supplierId, supplierName, supplierEmail, supplierContact, supplierStatus) VALUES ('18','Supplier3','supplier3@supplier.com','0123451132','Inactive');


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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('6','Jun Xian','junxian010729@gmail.com','0124293014','Male','2001-07-29','SuperUser','$2y$10$F4cPSTpZqsGizPCcp1PqTOvvMoTnGx/7MIJqZAWGANcl7OKxRh1SK','Active','Mon 17:21:48 01/11/2021','Online','heartPirates.jpg');

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('7','demo2','demo2@demo.com','0124925526','Male','1998-06-24','Admin','$2y$10$LoxFUC0UlzuGkPgA2gskKOykdqBqqH6j5EdwBZ5JNVwd5Pbpdzvie','Active','Mon 16:06:00 01/11/2021','Offline','demon.jpg');

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('10','demo3','demo3@demo.com','0124355621','Female','1999-02-16','Staff','$2y$10$jxt/xqog2S0UMSTAFfiXA.5GZK6bCabofyWpTf0jX6IiMZ/54HBuC','Active','Mon 16:09:36 01/11/2021','Offline','jisoo.jpg');

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('11','demo4','demo4@demo.com','01234567655','Female','2002-03-13','Staff','$2y$10$R1pcDTC7FaTEL9.YCSEzoOjUWGVF2P62CgInng4aF6nxUKsQ206Gm','Banned','Sun 23:23:30 22/08/2021','Offline','');

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('13','demo5','demo5@demo.com','0124556789','Male','1994-08-15','Staff','$2y$10$ZJNKlbXdDl930.na8oSqAu.FeUctLmZMfoU6bbaD.xRlPYImQE38a','Banned','Sun 23:23:44 22/08/2021','Offline','');

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('16','demo6','demo6@demo.com','01243356798','Female','1997-05-07','Staff','$2y$10$XUzQ5zMqMCXAu4xxAXJgAeLs9pYbIWYT3j38snRQIcDQlDYBRm6Ga','Active','Thu 17:02:13 14/10/2021','Offline','');

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('31','demo100','demo100@demo.com','01288735422','Male','2021-09-06','Admin','$2y$10$ZnmWkHGfXTl/omJiCPwzfu2Cv0A/XbC6Q.XoFGDKKH8bjo4EgbBJ2','Closed','','Offline','ap.jpg');

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('32','leejx','leejx-pm19@student.tarc.edu.my','0123425512','Male','2021-09-09','Staff','$2y$10$tH5oEHZNefbWyoYIOA2jkenyPcTgd/xmDhyx6t1FdUtQzPo9VGrIi','Active','Mon 00:41:58 18/10/2021','Offline','jisoo3.jpg');

INSERT INTO users (userId, userName, userEmail, userContact, userGender, userBirthDate, userRoles, userPassword, status, lastLogin, currentStatus, profileImg) VALUES ('35','Superuser1','demo@demo.com','0124595526','Male','2001-07-29','SuperUser','$2y$10$phKqCrURy0LTbGlV4ZA7QOr9JP4yWXeOxbVQoAkHRF83KAaMwEVNa','Active','Tue 16:39:48 05/10/2021','Offline','law.JPG');
