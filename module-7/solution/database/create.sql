CREATE DATABASE IF NOT EXISTS modphp;

USE modphp;

CREATE TABLE IF NOT EXISTS user
  (
     id            INTEGER auto_increment,
     username      VARCHAR(150) NOT NULL UNIQUE,
     password_hash VARCHAR(200) NOT NULL,
     firstname     VARCHAR(50) NOT NULL,
     lastname      VARCHAR(50) NOT NULL,
     email         VARCHAR(254) NOT NULL,
     prefered_supervisor         INTEGER,
     prefered_room         INTEGER,
     CONSTRAINT pk_user PRIMARY KEY (id)
  );

CREATE TABLE IF NOT EXISTS supervisor
  (
     id            INTEGER auto_increment,
     username      VARCHAR(150) NOT NULL UNIQUE,
     password_hash VARCHAR(200) NOT NULL,
     firstname     VARCHAR(50) NOT NULL,
     lastname      VARCHAR(50) NOT NULL,
     email         VARCHAR(254) NOT NULL,
     CONSTRAINT pk_supervisor PRIMARY KEY (id)
  );

CREATE TABLE IF NOT EXISTS booking
  (
     id            INTEGER auto_increment,
     supervisor_id INTEGER,
     user_id       INTEGER,
     time          DATETIME NOT NULL,
     subject       VARCHAR(150),
     description   VARCHAR(2000),
     room          INTEGER,
     CONSTRAINT pk_booking PRIMARY KEY (id),
     CONSTRAINT fk_supervisor FOREIGN KEY(supervisor_id) REFERENCES supervisor(id),
     CONSTRAINT fk_user FOREIGN KEY(user_id) REFERENCES user(id)
  );  
