drop table if exists users;
drop table if exists storesmtps;
drop table if exists shippingzones;
drop table if exists shippingamounts;
drop table if exists store_shippingzones;
drop table if exists categories;
drop table if exists mailinglists;
drop table if exists order_details;
drop table if exists orders;
drop table if exists product_categories;
drop table if exists product_stores;
drop table if exists stores;
drop table if exists products;
drop table if exists coupons;
drop table if exists groups;
drop table if exists shippingaliases;
drop table if exists countries;
drop table if exists regions;
drop table if exists store_holidays;

/* users */
CREATE TABLE users ( 
    id      	int(10) AUTO_INCREMENT NOT NULL,
    username	varchar(50) NOT NULL,
    password	varchar(64) NOT NULL,
    group_id	int(10) NOT NULL,
    active  	tinyint(1) NOT NULL,
    PRIMARY KEY(id)
);

/* groups */
CREATE TABLE groups ( 
    id      	int(10) AUTO_INCREMENT NOT NULL,
    name	varchar(50) NOT NULL,
    PRIMARY KEY(id)
);

/* Store */
CREATE TABLE stores ( 
    id          	int(11) AUTO_INCREMENT NOT NULL,
    number      	int(11) NOT NULL,
    name        	varchar(64) NOT NULL,
    website     	varchar(64) NOT NULL,
    email       	varchar(64) NOT NULL,
    tax1name    	varchar(64) NULL,
    tax1        	float NOT NULL DEFAULT 0,
    tax2name    	varchar(64) NULL,
    tax2        	float NOT NULL DEFAULT 0,
    shipping_tax	float NOT NULL DEFAULT 0,
    service_fee  	float NOT NULL DEFAULT 0,
    address     	varchar(64) NULL,
    city        	varchar(64) NULL,
    province    	varchar(64) NULL,
    postalcode    	varchar(16) NULL,
    phonenumber 	varchar(20) NULL,
    tollfree    	varchar(20) NULL,
    payment_process varchar(20) NOT NULL DEFAULT 'manual',
    currency varchar(7) NOT NULL,
    credit_cards tinyint NOT NULL DEFAULT 0,
    PRIMARY KEY(id)
);

CREATE UNIQUE INDEX store_number_index ON stores(number);

/* Stores Smtps - used for sending order confirmation emails */
CREATE TABLE storesmtps ( 
    id           	int(11) AUTO_INCREMENT NOT NULL,
    store_id     	int(11) NOT NULL,
    smtp_server  	varchar(64) NOT NULL,
    smtp_port    	varchar(5) NULL,
    smtp_username	varchar(64) NOT NULL,
    smtp_password	varchar(64) NOT NULL,
    order_bcc     	varchar(64) NULL,
    PRIMARY KEY(id)
);

CREATE TABLE store_holidays (
  id int(11) AUTO_INCREMENT NOT NULL,
  store_id int(11) NOT NULL,
  date datetime NOT NULL,
  PRIMARY KEY  (`id`)
);
CREATE INDEX store_id_holidays on store_holidays(store_id);

/* Shipping Zones */
CREATE TABLE shippingzones ( 
    id   	int(11) AUTO_INCREMENT NOT NULL,
    label	varchar(64) NOT NULL,
    description    	varchar(255) NULL,
    PRIMARY KEY(id)
);

CREATE TABLE shippingaliases ( 
    id             	int(11) AUTO_INCREMENT NOT NULL,
    shippingzone_id	int(11) NOT NULL,
    city   varchar(64) NULL,
    region   varchar(64) NOT NULL,
    postalcode   varchar(16) NULL,
    country   varchar(64) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE shippingamounts ( 
    id             	int(11) AUTO_INCREMENT NOT NULL,
    shippingzone_id	int(11) NOT NULL,
    amount         	float NOT NULL DEFAULT '0',
    weight         	int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY(id)
);

CREATE TABLE store_shippingzones ( 
    id             	int(11) AUTO_INCREMENT NOT NULL,
    store_id       	int(11) NOT NULL,
    shippingzone_id	int(11) NOT NULL,
    PRIMARY KEY(id)
);

CREATE INDEX store_id_index ON store_shippingzones(store_id);

/* Categories Table */
CREATE TABLE categories ( 
    id     	int(11) AUTO_INCREMENT NOT NULL,
    parent_id int(10) unsigned NULL,
    lft int(10) unsigned NOT NULL,
    rght int(10) unsigned NOT NULL,
    name   	varchar(64) NOT NULL,
    page   	varchar(64) NULL,
    active	tinyint(4) NOT NULL DEFAULT '0',
    description varchar(255) NULL,
    PRIMARY KEY(id)
);

/* Mailinglist */
CREATE TABLE mailinglists ( 
    id   	int(11) AUTO_INCREMENT NOT NULL,
    email	varchar(100) NOT NULL,
    code 	varchar(20) NOT NULL,
    name 	varchar(100) NULL,
    PRIMARY KEY(id)
);
CREATE UNIQUE INDEX email_ind ON mailinglists(email);

/* Orders */
CREATE TABLE orders ( 
    id                    	int(11) AUTO_INCREMENT NOT NULL,
    billto_email           	varchar(30) NOT NULL,
    billto_name				varchar(45) NULL,
    billto_address			varchar(64) NULL,
    billto_city				varchar(64) NULL,
    billto_region			varchar(64) NULL,
    billto_postalcode		varchar(12) NULL,
    billto_country			varchar(64) NULL,
    shipto_name				varchar(45) NULL,
    shipto_address			varchar(64) NULL,
    shipto_city				varchar(64) NULL,
    shipto_region			varchar(64) NULL,
    shipto_postalcode		varchar(12) NULL,
    shipto_country			varchar(64) NULL,    
    credit_card           	varchar(20) NULL,
    credit_card_number    	varchar(16) NULL,
    credit_card_expiry    	char(4) NULL,
    credit_card_security_code char(4) NULL,
    total                 	float NOT NULL DEFAULT '0',
    inserted_date         	datetime NOT NULL,
    modified_date        	datetime NULL,
    store_id              	int(11) NOT NULL,
    tax1                  	float NOT NULL DEFAULT '0',
    tax2                  	float NOT NULL DEFAULT '0',
    shipping              	float NOT NULL DEFAULT '0',
    shipping_tax          	float NOT NULL DEFAULT '0',
    shipping_coupon        	float NOT NULL DEFAULT '0',
    service_fee           	float NOT NULL DEFAULT '0',
    coupon                	float NOT NULL DEFAULT '0',
    coupon_code           	varchar(16) NULL,
    status                	tinyint(4) NOT NULL DEFAULT '0',
    error					varchar(255) NULL,
    transactionId			varchar(64) NULL,
    PRIMARY KEY(id)
);

CREATE TABLE order_details ( 
    id           	int(11) AUTO_INCREMENT NOT NULL,
    retail       	float NOT NULL DEFAULT '0',
    order_id     	int(11) NOT NULL,
    product_id   	int(11) NOT NULL,
    qty          	tinyint(4) NOT NULL DEFAULT '0',
    PRIMARY KEY(id)
);

CREATE INDEX order_id_index ON order_details(order_id);

/* Products */
CREATE TABLE products ( 
    id           	int(11) AUTO_INCREMENT NOT NULL,
    number       	varchar(25) NOT NULL,
    title        	varchar(64) NOT NULL,
    weight			float NOT NULL DEFAULT 0,
    description  	text NULL,
    keywords     	varchar(255) NULL,
    thumbnail    	varchar(20) NULL,
    image        	varchar(20) NULL,
    page         	varchar(64) NULL,
    inserted_date	datetime NOT NULL,
    modified_date	datetime NOT NULL,
    PRIMARY KEY(id)
);

CREATE INDEX page_index ON products(page);
CREATE INDEX Keywords_2 ON products(keywords);
CREATE INDEX ProductIndex ON products(number);
CREATE UNIQUE INDEX productnumber_ind ON products(number);
CREATE INDEX Keywords ON products(keywords);


CREATE TABLE product_categories ( 
    id         	int(11) AUTO_INCREMENT NOT NULL,
    product_id 	int(11) NULL,
    category_id	int(11) NULL,
    PRIMARY KEY(id)
);

CREATE unique INDEX product_id ON product_categories(product_id, category_id);

CREATE TABLE product_stores ( 
    id              	int(11) AUTO_INCREMENT NOT NULL,
    product_id      	int(11) NOT NULL,
    store_id        	int(11) NOT NULL,
    active          	tinyint(4) NOT NULL DEFAULT '0',
    variable_pricing	tinyint(4) NOT NULL DEFAULT '0',
    qty             	int(11) NOT NULL DEFAULT '-1',
    tax1         	tinyint(4) NOT NULL DEFAULT '0',
    tax2         	tinyint(4) NOT NULL DEFAULT '0',
    shipping     	tinyint(4) NOT NULL DEFAULT '0',
    retail_level_1 	float NOT NULL DEFAULT 0,
    retail_level_2 	float NOT NULL DEFAULT 0,
    retail_level_3 	float NOT NULL DEFAULT 0,
    discount_level_1 	float NOT NULL DEFAULT 0,
    discount_level_2 	float NOT NULL DEFAULT 0,
    discount_level_3 	float NOT NULL DEFAULT 0,
    qty_level_1_start tinyint NOT NULL DEFAULT 0,
	qty_level_1_end tinyint NOT NULL DEFAULT 0,
	qty_level_2_start tinyint NOT NULL DEFAULT 0,
	qty_level_2_end tinyint NOT NULL DEFAULT 0,
	qty_level_3_start tinyint NOT NULL DEFAULT 0,
	qty_level_3_end tinyint NOT NULL DEFAULT 0,    
    PRIMARY KEY(id)
);

CREATE INDEX ProductKey ON product_stores(product_id);
CREATE UNIQUE INDEX productstore_ind ON product_stores(product_id, store_id);
CREATE INDEX StoreKey ON product_stores(store_id);

/* Create Coupons Table */
CREATE TABLE coupons ( 
    id         	int(11) AUTO_INCREMENT NOT NULL,
    store_id   	int(11) NOT NULL,
    title      	varchar(40) NOT NULL,
    description	varchar(255) NULL,    
    percent    	float NOT NULL DEFAULT 0,
    shipping_percent float NOT NULL DEFAULT 0,
    amount     	float NOT NULL DEFAULT 0,
    min_amount	float NOT NULL DEFAULT 0,
    start      	datetime NOT NULL,
    end        	datetime NOT NULL,
    conditions 	varchar(255) NULL,
    code       	varchar(16) NULL,
    PRIMARY KEY(id));
CREATE INDEX CouponsCode ON coupons(code);

CREATE TABLE `countries` (
  `id` char(4) NOT NULL,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE `regions` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `country_id` char(4) NOT NULL,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY  (`id`)
);
CREATE INDEX CountryId on regions(country_id);