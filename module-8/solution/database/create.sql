CREATE DATABASE IF NOT EXISTS bookingsystem;

USE bookingsystem;

CREATE TABLE IF NOT EXISTS user
  (
     id            INTEGER auto_increment,
     username      VARCHAR(150) NOT NULL UNIQUE,
     password_hash VARCHAR(200) NOT NULL,
     firstname     VARCHAR(50) NOT NULL,
     lastname      VARCHAR(50) NOT NULL,
     email         VARCHAR(254) NOT NULL,
     role         VARCHAR(50) NOT NULL,
     CONSTRAINT pk_user PRIMARY KEY (id)
  );

CREATE TABLE IF NOT EXISTS booking
  (
     id            INTEGER auto_increment,
     supervisor_id INTEGER NOT NULL,
     user_id       INTEGER NOT NULL,
     time          DATETIME NOT NULL,
     subject       VARCHAR(150),
     description   VARCHAR(2000),
     CONSTRAINT pk_booking PRIMARY KEY (id),
     CONSTRAINT fk_user FOREIGN KEY(user_id) REFERENCES user(id)
  );  
