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
    reg_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id)
);
CREATE TABLE boards(
    board_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    board_name VARCHAR(50) NOT NULL,
    blurb VARCHAR(500),
    category VARCHAR(50),
    cover_pin_url VARCHAR(200),
    secret_board VARCHAR(3) DEFAULT 'NO',
    board_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(board_id),
    user_id INT UNSIGNED,
    FOREIGN KEY (user_id)
        REFERENCES users(user_id)
        ON DELETE CASCADE
);
CREATE TABLE pins(
    pin_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    pin_url VARCHAR(200) NOT NULL,
    blurb VARCHAR(500),
    pin_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(pin_id),
    board_id INT UNSIGNED,
    FOREIGN KEY fk_boards(board_id)
        REFERENCES boards(board_id)
        ON DELETE CASCADE,
    user_id INT UNSIGNED,
    FOREIGN KEY fk_users(user_id)
        REFERENCES users(user_id)
        ON DELETE CASCADE
);

-- Test data
INSERT INTO users(user_id, username, email, password, age, first_name, gender, user_language, country, user_location) 
VALUES(1, 'test_user', 'test@test.com', 'pass', '21', 'test', 'female', 'English', 'United States', 'New York');

INSERT INTO boards(board_id, board_name, user_id) VALUES(1,'test_board', 1);
INSERT INTO boards(board_name, user_id) VALUES('test_board2', 1);

INSERT INTO pins(pin_url, board_id, user_id) VALUES('google.com','1','1');
INSERT INTO pins(pin_url, board_id, user_id) VALUES
('images/paris.jpg','1','1'),
('images/palm-tree.jpg','1','1'),
('images/bicycle.jpg','1','1'),
('images/roadway.jpg','1','1');


DELETE FROM users WHERE user_id='1';
DELETE FROM boards WHERE board_id='1';

SELECT * FROM users;
SELECT * FROM boards;
SELECT * FROM pins;

DESCRIBE users;
DESCRIBE boards;