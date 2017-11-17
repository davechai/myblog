SET NAMES UTF8;
DROP DATABASE IF EXISTS myblog;
CREATE DATABASE myblog CHARSET=UTF8;
USE myblog;


CREATE TABLE article(
  art_id INT PRIMARY KEY AUTO_INCREMENT,
  art_title VARCHAR(256) NOT NULL,
  art_pic VARCHAR(128),
  art_des VARCHAR(512) NOT NULL,
  art_pubtime DATETIME,
  art_type VARCHAR(64) NOT NULL,
  art_path VARCHAR(128),
  art_hits INT,
  art_content BLOB
);


CREATE TABLE message(
  msg_id INT PRIMARY KEY AUTO_INCREMENT,
  msg_user VARCHAR(128),
  msg_content VARCHAR(2048) NOT NULL,
  msg_date DATETIME,
  user_email VARCHAR(128),
  user_url VARCHAR(256)
);
