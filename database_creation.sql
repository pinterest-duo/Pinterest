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
    reg_date DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id)
);
CREATE TABLE boards(
    board_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    board_name VARCHAR(50) NOT NULL,
    blurb VARCHAR(500),
    category VARCHAR(50),
    cover_pin VARCHAR(200),
    secret_board TINYINT UNSIGNED NOT NULL DEFAULT 0,
    board_date DATETIME NOT NULL,
    PRIMARY KEY(board_id),
    FOREIGN KEY fk_users(user_id)
        REFERENCES users(user_id)
        ON DELETE CASCADE
);
CREATE TABLE pins(
    pin_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    blurb VARCHAR(500),
    section VARCHAR(50),
    PRIMARY KEY(pin_id),
    FOREIGN KEY fk_boards(board_id)
        REFERENCES boards(board_id)
        ON DELETE CASCADE,
    FOREIGN KEY fk_users(user_id)
        REFERENCES users(user_id)
        ON DELETE CASCADE
);