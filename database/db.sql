DROP DATABASE IF EXISTS project;
CREATE DATABASE project;

-- use created database
use project;


-- Create User Table
CREATE TABLE users (
    id INT NOT NULL  AUTO_INCREMENT,
    username VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR(200) NOT NULL,

    PRIMARY KEY (id),
    UNIQUE (email),
    UNIQUE (username)
);

CREATE TABLE admins (
    id INT NOT NULL  AUTO_INCREMENT,
    username VARCHAR(150) NOT NULL,
    password VARCHAR(200) NOT NULL,
    permission INT NOT NULL,

    PRIMARY KEY (id),
    UNIQUE (username)
);

-- Create Product Table
CREATE TABLE products (
    -- first level
    -- create basic product
    id INT NOT NULL AUTO_INCREMENT,
    admin_name VARCHAR(150) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    photo_dir_path VARCHAR(300) NOT NULL,
    introduction_to_product TEXT NOT NULL,

    -- second level, choosing a product from user and send expected date
    -- and the signal file path
    choosen_by_customer BOOLEAN NOT NULL,
    sent_signal_dir_path VARCHAR(300),
    customer_name VARCHAR(150),
    expected_date DATE,
    sent_date DATE,

    -- therd level:
    --  accept or deny from admin
    --  send product price and date
    choosen_by_admin TINYINT NOT NULL,
    price VARCHAR(20),
    accepted_date DATE,

    -- forth level:
    --  accept user and do successful payment
    success_payment BOOLEAN NOT NULL,

    -- fifth:
    -- send final product file from admin.
    final_product_path VARCHAR(250),

    -- define promary key and foreign key
    PRIMARY KEY (id),
    FOREIGN KEY (admin_name) REFERENCES admins (username),
    FOREIGN KEY (customer_name) REFERENCES users (username)
);

-- run fake datas
SOURCE fake-data.sql