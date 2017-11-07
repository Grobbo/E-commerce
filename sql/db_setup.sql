DROP SCHEMA E_COMMERCE;
CREATE SCHEMA E_COMMERCE;
USE E_COMMERCE;
CREATE TABLE E_COMMERCE.CUSTOMERS(
	id int PRIMARY KEY AUTO_INCREMENT,
	first_name varchar(15) NOT NULL,
    last_name varchar(15) NOT NULL,
    user_name varchar(15) NOT NULL,
	user_password varchar(50) NOT NULL,
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
    rating float NOT NULL,
    num_ratings int NOT NULL
);
CREATE TABLE E_COMMERCE.ORDERS(
	order_number int PRIMARY KEY AUTO_INCREMENT,
    order_date date,
    customer_id int,
    FOREIGN KEY(customer_id) REFERENCES CUSTOMERS(id)
);
CREATE TABLE E_COMMERCE.ORDERED_PRODUCTS(
	id int PRIMARY KEY AUTO_INCREMENT,
    order_number int,
    product_id int,
    FOREIGN KEY(order_number) REFERENCES ORDERS(order_number),
    FOREIGN KEY(product_id) REFERENCES PRODUCTS(id)
);

CREATE TABLE E_COMMERCE.COMMENTS(
	id int PRIMARY KEY AUTO_INCREMENT,
    product_id int NOT NULL,
    comment_text varchar(255),
    super_id int,
    
    FOREIGN KEY(product_id) REFERENCES PRODUCTS(id),
    FOREIGN KEY(super_id) REFERENCES COMMENTS(id)
);