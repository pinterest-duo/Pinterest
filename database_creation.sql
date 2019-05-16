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
    user_image VARCHAR(200),
    reg_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id)
);
CREATE TABLE boards(
    board_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    board_name VARCHAR(50) NOT NULL,
    blurb VARCHAR(500),
    category VARCHAR(50),
    cover_pin_url VARCHAR(1000),
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
    pin_url VARCHAR(1000) NOT NULL,
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
INSERT INTO users(user_id, username, email, password, age, first_name, gender, user_language, country, user_location, user_image) 
VALUES(1, 'blinky', 'test@test.com', 'pass', '21', 'test', 'female', 'English', 'United States', 'New York', 'images/paris.jpg');

INSERT INTO boards(board_id, board_name, user_id) VALUES(1,'Photography', 1);
INSERT INTO boards(board_id, board_name, user_id) VALUES(3,'Nature', 1);
INSERT INTO boards(board_id, board_name, user_id) VALUES(28,'Favorite Characters', 1);
INSERT INTO boards(board_id, board_name, user_id) VALUES(29,'Micellaneous', 1);

INSERT INTO pins(pin_url, board_id, user_id) VALUES
('images/paris.jpg','1','1'),
('images/palm-tree.jpg','1','1'),
('images/bicycle.jpg','1','1'),
('images/roadway.jpg','1','1');

INSERT INTO pins(pin_url, board_id, user_id) VALUES
('https://hdwallpaper20.com/wp-content/uploads/2017/07/c35db9c3f107decf6da1361c124b248f-friends-thanksgiving-pooh-bear.png','28','1'),
('https://theartsherpa.com/gallery/image/gallery_image/2309/1280','3','1'),
('https://image.tmdb.org/t/p/w1280//lKNYRlJ9jJAPU7yNYU0qTSQ4AYa.jpg','28','1'),
('https://66.media.tumblr.com/9db8aaa07e363833cd89408618c90ecb/tumblr_o1g3c8G9hY1rc5v2so1_1280.jpg','29','1'),
('http://66.media.tumblr.com/cf7966c1c181ff333ba1a46f3413bd0e/tumblr_mvxct9e9Pr1qb4b9io2_1280.jpg','3','1'),
('http://pm1.narvii.com/6949/0683b68086b1574688983bc946553bffdd6661a2r1-1280-1920v2_uhq.jpg','28','1'),
('http://static1.squarespace.com/static/5a3c5739aeb625ba533819a0/5b759ef10ebbe831cc13922e/5b818c96575d1f3286c3a283/1551790262155/modern-calligraphy-wedding-invitation-suite-floral-wreath-1.jpg?format=1500w','1','1'),
('http://66.media.tumblr.com/427db1b728286aab4f69ff4accdaa754/tumblr_np1evcpBhp1rnh2c3o1_1280.jpg','1','1'),
('https://ovrlkd.com/wp-content/uploads/2015/04/tumblr_mkz52tzydR1ro3fdho1_1280.jpg','1','1'),
('https://i.pinimg.com/originals/bd/4f/92/bd4f92456f12855c8565d45f81500283.jpg','28','1'),
('https://image.tmdb.org/t/p/w1280/4PAxaNpzm3gkUe5diZocsp5twSq.jpg','28','1'),
('https://image.tmdb.org/t/p/w1280/9VZmMzINVdO3ZYGsKItU39pNO2l.jpg','28','1'),
('https://i.pinimg.com/originals/76/22/d9/7622d9d40fe3bfe0abcbb9b3715253f2.jpg','3','1'),
('https://image.tmdb.org/t/p/w1280/kfSV92df7aXspRI1mH88y08ZzIZ.jpg','28','1'),
('https://i.pinimg.com/originals/3f/bd/18/3fbd184af3f7552a43f46a4db9483573.jpg','29','1'),
('https://78.media.tumblr.com/7a612681d30259eb589f2fd3fc13bb49/tumblr_p8mg8y7GAM1rlqdmro1_1280.jpg','29','1'),
('https://s3.amazonaws.com/sbedebi/wp-content/uploads/2018/05/19025546/EF04A786-1ACB-4B89-8561-D1783E5B4AA9.jpeg','29','1'),
('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRt288-772yQtemYnX0nT11ChTfifHh0ia-6HIvXDMkGa4r-37yhw','3','1'),
('https://pineapplesupply.co/wp-content/uploads/2018/06/iphone-pineapple-background-hit-the-beach-1280x1920.jpg','29','1'),
('https://66.media.tumblr.com/9b234c7fedf45f43540e606bad7ce119/tumblr_pljvaairut1w9rsho_1280.jpg','3','1'),
('https://i.pinimg.com/originals/c9/ef/cf/c9efcf5542e6af8ad7331242c2bdbc2d.jpg','1','1'),
('https://i.pinimg.com/originals/93/83/a4/9383a4f304a8ec6d4b9e5cf72bb56bff.jpg','28','1'),
('images/sunsets.jpg','29','1'),
('https://www.climbinggriermountain.com/wp-content/uploads/2019/02/Ultimate-Dark-Chocolate-Cake-with-Marshmallow-Frosting-www.climbinggriermountain.com-2.jpg','29','1'),
('https://i.pinimg.com/originals/9b/14/b3/9b14b3a3c2d6d178e5f2daed495eddfd.jpg','29','1'),
('https://66.media.tumblr.com/defec9db802afd17ac52f51ea4bc5ba7/tumblr_ppulpazuuv1s3nqmu_1280.jpg','29','1'),
('https://honestlyyum.com/wp-content/uploads/2017/10/apple.pizza_.8709.1-1.jpg','29','1'),
('https://steelehousekitchen.com/wp-content/uploads/2014/03/blackberry-pita-pizza.jpg','29','1'),
('http://c1.peakpx.com/wallpaper/340/787/777/tree-trees-redwood-giant-california-wallpaper.jpg','29','1'),
('https://i.pinimg.com/originals/b5/56/4f/b5564f8b6042c7f73e5164da6ecb7663.jpg','29','1'),
('https://wallpaperbro.com/img/84230.jpg','29','1'),
('https://66.media.tumblr.com/1a91cbb58d5b617c8f35dffcd6ba108d/tumblr_p0b46fwcTV1tjubsmo1_1280.png','29','1'),
('https://i.pinimg.com/originals/66/96/7c/66967cb439c7544ba9d40949d407977e.jpg','29','1'),
('https://i.pinimg.com/originals/83/cf/36/83cf36f8f9f73857ca5e3011bdece64e.jpg','29','1'),
('https://i.pinimg.com/originals/72/b0/b1/72b0b1aae3f730aa51d0f17709a6af85.png','29','1'),
('https://i.redd.it/l8718l65tt211.jpg','29','1'),
('https://i.pinimg.com/originals/a0/92/73/a0927344e7626558c77b13e97c7fd388.jpg','28','1'),
('https://i.pinimg.com/originals/c1/d5/e0/c1d5e0b0ce5f06c80f6dbfe5c477d027.jpg','1','1'),
('http://66.media.tumblr.com/42c1a98ca3c8ed4c3ee615ed28a94761/tumblr_np1evcpBhp1rnh2c3o2_1280.jpg','1','1'),
('https://66.media.tumblr.com/024982ea5cbf5fccf0833bda56cca998/tumblr_phtumqtXYo1r9hr09o1_1280.jpg','1','1'),
('https://66.media.tumblr.com/17339a848071ff4514ad1d8b3d0dd937/tumblr_otva6bd2cC1tihsowo1_1280.jpg','1','1'),
('https://66.media.tumblr.com/82abdf40b6c2a62088bcb871f20f3741/tumblr_oqoimnYtBd1tihsowo1_1280.jpg','1','1'),
('https://i.pinimg.com/originals/9f/6f/71/9f6f71aa2cb6ef5d22c90bb4467963c1.jpg','1','1'),
('https://i0.wp.com/wallup.net/wp-content/uploads/2017/03/28/401837-nature-photography-portrait_display.jpg','1','1'),
('http://66.media.tumblr.com/56156f41ea1fc4f58e07c590235a3dde/tumblr_n1xbuhuFw21soesuko3_1280.jpg','1','1'),
('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRswP7rxSQdAMyxda-5uI_rXPyvV0rzxCLV5Qs4ulrfNXKE7RFg','1','1');

SELECT * FROM users;
SELECT * FROM boards;
SELECT * FROM pins;

DESCRIBE users;
DESCRIBE boards;