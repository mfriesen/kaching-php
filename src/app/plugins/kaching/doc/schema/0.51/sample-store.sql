truncate table product_stores;
truncate table product_categories;
truncate table products;
truncate table categories;
truncate table stores;
truncate table countries;
truncate table regions;
truncate table shippingzones;
truncate table shippingaliases;
truncate table shippingamounts;
truncate table store_shippingzones;

/* Store */
INSERT INTO stores(id, number, name, website, email, tax1name, tax1, tax2name, tax2, shipping_tax, service_fee, address, city, province, phonenumber, tollfree, currency)
  VALUES(1, 1, 'Kaching Widget Store', 'www.kachingphp.org', 'mfriesen@kachingphp.org', 'GST (5%)', 5, 'PST (7%)', 7, 5, 0.0, '123 Flowershop street', 'Winnipeg', 'MB', '(204) 555-1234', '1-800-555-1234', 'CAD');
  
/* Categories */
INSERT INTO categories(id, name, page, lft, rght, active)
  VALUES(1, 'Small Widgets', '', 1, 1, 1);
INSERT INTO categories(id, name, page, lft, rght, active)
  VALUES(2, 'Medium Widgets', '', 2, 2, 1);
INSERT INTO categories(id, name, page, lft, rght, active)
  VALUES(3, 'Large Widgets', '', 3, 3, 1);
INSERT INTO categories(id, parent_id, lft, rght, name, page, active, description)
  VALUES(4, 3, 3, 4, 'Large Widgets < $50', '', 1, 'Contains widgets that are less than $50');
    
/* Products */
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(1, 'SW-1', 'Small Widget #1', 'Description of Small Widget #1', 'small widget', 'sw-1.jpg', 'sw-1.jpg', 'small-widget-1.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(2, 'SW-2', 'Small Widget #2', 'Description of Small Widget #2', 'small widget', 'sw-2.jpg', 'sw-2.jpg', null, '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(3, 'SW-3', 'Small Widget #3', 'Description of Small Widget #3', 'small widget', 'sw-3.jpg', 'sw-3.jpg', null, '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(4, 'SW-4', 'Small Widget #4', 'Description of Small Widget #4', 'small widget', 'sw-4.jpg', 'sw-4.jpg', 'small-widget-4.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(5, 'SW-5', 'Small Widget #5', 'Description of Small Widget #5', 'small widget', 'sw-5.jpg', 'sw-5.jpg', 'small-widget-5.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(6, 'SW-6', 'Small Widget #6', 'Description of Small Widget #6', 'small widget', 'sw-6.jpg', 'sw-6.jpg', 'small-widget-6.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');

INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(7, 'MW-1', 'Medium Widget #1', 'Description of Medium Widget #1', 'medium widget', 'mw-1.jpg', 'mw-1.jpg', 'medium-widget-1.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(8, 'MW-2', 'Medium Widget #2', 'Description of Medium Widget #2', 'medium widget', 'mw-2.jpg', 'mw-2.jpg', 'medium-widget-2.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(9, 'MW-3', 'Medium Widget #3', 'Description of Medium Widget #3', 'medium widget', 'mw-3.jpg', 'mw-3.jpg', 'medium-widget-3.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(10, 'MW-4', 'Medium Widget #4', 'Description of Medium Widget #4', 'medium widget', 'mw-4.jpg', 'mw-4.jpg', 'medium-widget-4.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(11, 'MW-5', 'Medium Widget #5', 'Description of Medium Widget #5', 'medium widget', 'mw-5.jpg', 'mw-5.jpg', 'medium-widget-5.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(12, 'MW-6', 'Medium Widget #6', 'Description of Medium Widget #6', 'medium widget', 'mw-6.jpg', 'mw-6.jpg', 'medium-widget-6.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');

INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(13, 'LW-1', 'Large Widget #1', 'Description of Large Widget #1', 'large widget', 'mw-1.jpg', 'mw-1.jpg', 'large-widget-1.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(14, 'LW-2', 'Large Widget #2', 'Description of Large Widget #2', 'large widget', 'mw-2.jpg', 'mw-2.jpg', 'large-widget-2.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(15, 'LW-3', 'Large Widget #3', 'Description of Large Widget #3', 'large widget', 'mw-3.jpg', 'mw-3.jpg', 'large-widget-3.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(16, 'LW-4', 'Large Widget #4', 'Description of Large Widget #4', 'large widget', 'mw-4.jpg', 'mw-4.jpg', 'large-widget-4.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(17, 'LW-5', 'Large Widget #5', 'Description of Large Widget #5', 'large widget', 'mw-5.jpg', 'mw-5.jpg', 'large-widget-5.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
INSERT INTO products(id, number, title, description, keywords, thumbnail, image, page, inserted_date, modified_date)
  VALUES(18, 'LW-6', 'Large Widget #6', 'Description of Large Widget #6', 'large widget', 'mw-6.jpg', 'mw-6.jpg', 'large-widget-6.html', '2009-03-22 00:00:00.0', '2009-03-22 00:00:00.0');
    
/* Product Categories */
INSERT INTO product_categories(id, product_id, category_id) VALUES(1, 1, 1);
INSERT INTO product_categories(id, product_id, category_id) VALUES(2, 2, 1);
INSERT INTO product_categories(id, product_id, category_id) VALUES(3, 3, 1);
INSERT INTO product_categories(id, product_id, category_id) VALUES(4, 4, 1);
INSERT INTO product_categories(id, product_id, category_id) VALUES(5, 5, 1);
INSERT INTO product_categories(id, product_id, category_id) VALUES(6, 6, 1);

INSERT INTO product_categories(id, product_id, category_id) VALUES(7, 7, 2);
INSERT INTO product_categories(id, product_id, category_id) VALUES(8, 8, 2);
INSERT INTO product_categories(id, product_id, category_id) VALUES(9, 9, 2);
INSERT INTO product_categories(id, product_id, category_id) VALUES(10, 10, 2);
INSERT INTO product_categories(id, product_id, category_id) VALUES(11, 11, 2);
INSERT INTO product_categories(id, product_id, category_id) VALUES(12, 12, 2);

INSERT INTO product_categories(id, product_id, category_id) VALUES(13, 13, 3);
INSERT INTO product_categories(id, product_id, category_id) VALUES(14, 13, 4);
INSERT INTO product_categories(id, product_id, category_id) VALUES(15, 14, 3);
INSERT INTO product_categories(id, product_id, category_id) VALUES(16, 14, 4);
INSERT INTO product_categories(id, product_id, category_id) VALUES(17, 15, 3);
INSERT INTO product_categories(id, product_id, category_id) VALUES(18, 15, 4);
INSERT INTO product_categories(id, product_id, category_id) VALUES(19, 16, 3);
INSERT INTO product_categories(id, product_id, category_id) VALUES(20, 17, 3);
INSERT INTO product_categories(id, product_id, category_id) VALUES(21, 18, 3);
  
/* Product Store Link */
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(1, 1, 1, 20, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(2, 2, 1, 40, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(3, 3, 1, 50, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(4, 4, 1, 60, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(5, 5, 1, 80, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(6, 6, 1, 100, 1, 1, 1, 1);
  
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(7, 7, 1, 20, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(8, 8, 1, 40, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(9, 9, 1, 50, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(10, 10, 1, 60, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(11, 11, 1, 80, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(12, 12, 1, 100, 1, 1, 1, 1);

INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(13, 13, 1, 10, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(14, 14, 1, 22, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(15, 15, 1, 43, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(16, 16, 1, 84, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(17, 17, 1, 90, 1, 1, 1, 1);
INSERT INTO product_stores(id, product_id, store_id, retail_level_1, active, tax1, tax2, shipping)
  VALUES(18, 18, 1, 120, 1, 1, 1, 1);

INSERT INTO `countries` VALUES('CA', 'Canada');
INSERT INTO `countries` VALUES('US', 'United States');

INSERT INTO `regions`(country_id, name) VALUES('US', 'Alaska');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Alabama');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Arkansas');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Arizona');
INSERT INTO `regions`(country_id, name) VALUES('US', 'California');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Colorado');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Connecticut');
INSERT INTO `regions`(country_id, name) VALUES('US', 'District of Columbia');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Delaware');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Florida');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Georgia');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Hawaii');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Iowa');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Idaho');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Illinois');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Indiana');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Kansas');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Kentucky');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Louisiana');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Massachusetts');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Maryland');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Maine');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Michigan');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Minnesota');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Missouri');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Mississippi');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Montana');
INSERT INTO `regions`(country_id, name) VALUES('US', 'North Carolina');
INSERT INTO `regions`(country_id, name) VALUES('US', 'North Dakota');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Nebraska');
INSERT INTO `regions`(country_id, name) VALUES('US', 'New Hampshire');
INSERT INTO `regions`(country_id, name) VALUES('US', 'New Jersey');
INSERT INTO `regions`(country_id, name) VALUES('US', 'New Mexico');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Nevada');
INSERT INTO `regions`(country_id, name) VALUES('US', 'New York');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Ohio');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Oklahoma');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Oregon');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Pennsylvania');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Rhode Island');
INSERT INTO `regions`(country_id, name) VALUES('US', 'South Carolina');
INSERT INTO `regions`(country_id, name) VALUES('US', 'South Dakota');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Tennessee');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Texas');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Utah');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Virginia');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Vermont');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Washington');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Wisconsin');
INSERT INTO `regions`(country_id, name) VALUES('US', 'West Virginia');
INSERT INTO `regions`(country_id, name) VALUES('US', 'Wyoming');

INSERT INTO `regions`(country_id, name) VALUES('CA', 'Alberta');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'British Columbia');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'Manitoba');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'New Brunswick');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'Newfoundland and Labrador');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'Northwest Territories');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'Nova Scotia');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'Nunavut');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'Prince Edward Island');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'Saskatchewan');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'Ontario');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'Quebec');
INSERT INTO `regions`(country_id, name) VALUES('CA', 'Yukon');

INSERT INTO shippingzones(id, label, description) VALUES(1, 'US Zone', 'This is for shipments to the US.');
INSERT INTO shippingzones(id, label, description) VALUES(2, 'Manitoba Zone', 'This is for shipments to the province of Manitoba, Canada.');
INSERT INTO shippingzones(id, label, description) VALUES(3, 'Canada Shipping', 'This is for shipping in the rest of Canada.');

INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '1', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '2', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '3', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '4', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '5', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '6', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '7', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '8', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '9', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '10', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '11', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '12', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '13', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '14', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '15', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '16', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '17', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '18', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '19', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '20', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '21', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '22', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '23', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '24', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '25', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '26', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '27', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '28', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '29', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '30', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '31', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '32', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '33', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '34', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '35', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '36', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '37', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '38', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '39', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '40', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '41', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '42', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '43', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '44', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '45', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '46', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '47', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '48', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '49', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '50', '', 'US');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(1, '', '51', '', 'US');

INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '52', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '53', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(2, '', '54', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '55', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '56', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '57', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '58', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '59', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '60', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '61', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '62', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '63', '', 'CA');
INSERT INTO shippingaliases(shippingzone_id, city, region, postalcode, country) VALUES(3, '', '64', '', 'CA');

INSERT INTO shippingamounts(shippingzone_id, amount, weight) VALUES(1, 100.0, 0);
INSERT INTO shippingamounts(shippingzone_id, amount, weight) VALUES(2, 5.0, 0);
INSERT INTO shippingamounts(shippingzone_id, amount, weight) VALUES(3, 50.0, 0);

INSERT INTO store_shippingzones(store_id, shippingzone_id) VALUES(1, 1);
INSERT INTO store_shippingzones(store_id, shippingzone_id) VALUES(1, 2);
INSERT INTO store_shippingzones(store_id, shippingzone_id) VALUES(1, 3);