CREATE DATABASE pinterest;
USE pinterest;

-- Creating Tables
CREATE TABLE users(
    user_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(70) NOT NULL,
    password VARCHAR(40) NOT NULL,
    age INT UNSIGNED NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50),
    gender VARCHAR(30) NOT NULL,
    user_language VARCHAR(20) NOT NULL,
    country VARCHAR(20) NOT NULL,
    user_location VARCHAR(30) NOT NULL,
    reg_date DATETIME NOT NULL,
    PRIMARY KEY(user_id)
);