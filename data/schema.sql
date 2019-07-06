CREATE TABLE orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    customer_name varchar(80) NOT NULL, 
    customer_email varchar(120) NOT NULL,
    customer_mobile varchar(40) NOT NULL,
    status varchar(20) NOT NULL,
    created_at datetime NOT NULL,
    updated_at datetime NOT NULL);