DROP SCHEMA E_COMMERCE;
CREATE SCHEMA E_COMMERCE;
USE E_COMMERCE;
CREATE TABLE E_COMMERCE.CUSTOMERS(
	id int PRIMARY KEY AUTO_INCREMENT,
	first_name varchar(15) NOT NULL,
	last_name varchar(15) NOT NULL,
	user_name varchar(15) NOT NULL UNIQUE,
	user_password varchar(255) NOT NULL,
	address varchar(25) NOT NULL,
	email varchar(64) NOT NULL,
	postal_code varchar(15) NOT NULL,
	country varchar(25) NOT NULL,
	city varchar(25) NOT NULL
);
CREATE TABLE E_COMMERCE.PRODUCTS(
	id int PRIMARY KEY AUTO_INCREMENT,
	category varchar(20),
	manufacturer varchar(20),
	description text,
	quantity int NOT NULL CHECK(quantity>=0),
	price float NOT NULL CHECK(price>0),
	rating float NOT NULL DEFAULT 0.0,
	num_ratings int NOT NULL DEFAULT 0,
    image varchar(256) DEFAULT '/images/nia.png'
);

CREATE TABLE E_COMMERCE.SHIPMENTS(
	shipment_id int PRIMARY KEY AUTO_INCREMENT,
	order_date date NOT NULL,
	customer int NOT NULL,
	FOREIGN KEY(customer) REFERENCES CUSTOMERS(id)
);

CREATE TABLE E_COMMERCE.ORDERS(
	id int PRIMARY KEY AUTO_INCREMENT,
	product_id int NOT NULL,
	quantity int NOT NULL,
	shipment_id int NOT NULL,
	FOREIGN KEY(product_id) REFERENCES PRODUCTS(id),
	FOREIGN KEY(shipment_id) REFERENCES SHIPMENTS(shipment_id)
);

CREATE TABLE E_COMMERCE.COMMENTS(
	id int PRIMARY KEY AUTO_INCREMENT,
	product_id int NOT NULL,
	comment_text varchar(255),
	super_id int DEFAULT NULL,  
	FOREIGN KEY(product_id) REFERENCES PRODUCTS(id),
	FOREIGN KEY(super_id) REFERENCES COMMENTS(id)
);

CREATE TABLE E_COMMERCE.SHOPPING_CART(
	id int PRIMARY KEY AUTO_INCREMENT,
	user_id int NOT NULL,
	product_id int NOT NULL,
	quantity int NOT NULL,
	FOREIGN KEY(user_id) REFERENCES CUSTOMERS(id),
	FOREIGN KEY(product_id) REFERENCES PRODUCTS(id)
);

/*
INSERTION OF PRODUCTS INTO DB.
*/

/* SAWS */
INSERT INTO E_COMMERCE.PRODUCTS(
	category,
	manufacturer,
	description,
	quantity,
	price,
    	image,
	rating)
 VALUES ('SAW',
	'BORSCH',
	'USED FOR FINE SAWING',
	4,
	100,
    '/images/fine_saw.png',
	2);

INSERT INTO E_COMMERCE.PRODUCTS(
	category,
	manufacturer,
	description,
	quantity,
	price,
	rating)
 VALUES ('SAW',
	'MAKITA',
	'USED FOR HEAVY-DUTY SAWING',
	7,
	250,
	4.5);

INSERT INTO E_COMMERCE.PRODUCTS(
	category,
	manufacturer,
	description,
	quantity,
	price,
	rating)
 VALUES ('SAW',
	'COCRAFT',
	'BASIC SAW',
	3,
	89,
	4);

INSERT INTO E_COMMERCE.PRODUCTS(
	category,
	manufacturer,
	description,
	quantity,
	price,rating)
 VALUES ('SAW',
	'BACHO',
	'METAL SAW',
	22,
	349,
	5);
/*

*/
INSERT INTO E_COMMERCE.PRODUCTS(
	category,
	manufacturer,
	description,
	quantity,
	price,rating
	)
 VALUES ('SAW',
	'MISC',
	'METAL SAW',
	15,
	200,
	1);

/* SCREWDRIVERS */

INSERT INTO E_COMMERCE.PRODUCTS(
	category,
	manufacturer,
	description,
	quantity,
	price)
 VALUES ('SCREWDRIVER',
	'BACHO',
	'STAR SCREWDRIVER',
	89,
	23);

INSERT INTO E_COMMERCE.PRODUCTS(
	category,
	manufacturer,
	description,
	quantity,
	price)
 VALUES ('SCREWDRIVER',
	'BACHO',
	'FLAT SCREWDRIVER',
	45,
	19);

INSERT INTO E_COMMERCE.PRODUCTS(
	category,
	manufacturer,
	description,
	quantity,
	price)
 VALUES ('HAMMER',
	'BACHO',
	'USED FOR HEAVY-DUTY HAMMERING',
	7,
	28);
    
INSERT INTO E_COMMERCE.COMMENTS(
	product_id,
    comment_text)
 VALUES (1,
	"GREAT");
    
INSERT INTO E_COMMERCE.COMMENTS(
	product_id,
    comment_text)
 VALUES (1,
	"SUPER SAW");
