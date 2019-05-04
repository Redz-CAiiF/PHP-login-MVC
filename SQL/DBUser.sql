DROP DATABASE IF EXISTS DBUser;
CREATE DATABASE  IF NOT EXISTS DBUser;
USE DBUser;

--INSERT INTO User(email,username,password,name,surname,provincia,address,picture,birthdate,description,banner) VALUES ('admin@admin.admin','admin','5E884898DA28047151D0E56F8DC6292773603D0D6AABBDD62A11EF721D1542D8','admin','admin','27','via admin 55','mypicture.jpg','2000/01/01','im the admin','u must do what i want');

CREATE TABLE Region (
		codice INT NOT NULL,
		nome VARCHAR(100) NOT NULL,
		-- PRIMARY KEY
        PRIMARY KEY (codice)
);

CREATE TABLE Province (
		Regione INT NOT NULL,
		codice INT NOT NULL,
		iniziali VARCHAR(100) NOT NULL,
		nome VARCHAR(100) NOT NULL,
		-- PRIMARY KEY
        PRIMARY KEY (codice),

		FOREIGN KEY(Regione) REFERENCES Region(codice)
            -- ON UPDATE <UPDATE_ACTION> ON DELETE <DELETE_ACTION>,
            -- WHERE ACTION = RESTRICT | NO ACTION | CASCADE | SET NULL
            -- E.g. ON UPDATE CASCADE ON DELETE SET NULL,
            ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE User (
	email VARCHAR(100) NOT NULL COMMENT "Mail unique identifier",
	username VARCHAR(100) NOT NULL COMMENT "Credential unique identifier",

	password VARCHAR(255) NOT NULL COMMENT "Password hash",

	name VARCHAR(100) NOT NULL COMMENT "user name",
	surname VARCHAR(100) NOT NULL COMMENT "user surname",
	provincia INT NOT NULL COMMENT "user country region",
	address VARCHAR(100) NOT NULL COMMENT "user address",
	picture VARCHAR(300) NOT NULL COMMENT "picture path",
	birthdate date NOT NULL DEFAULT curdate() COMMENT 'user birthdate',
	ageinyears tinyint(4) GENERATED ALWAYS AS (timestampdiff(YEAR,`birthdate`,current_timestamp())) VIRTUAL COMMENT 'Current user age in years',
	description VARCHAR(500) COMMENT "user chosen description",
	banner VARCHAR(50) COMMENT "user special sentence",
	
	PRIMARY KEY(username),
	UNIQUE KEY(email),

	FOREIGN KEY(provincia) REFERENCES Province(codice)
            -- ON UPDATE <UPDATE_ACTION> ON DELETE <DELETE_ACTION>,
            -- WHERE ACTION = RESTRICT | NO ACTION | CASCADE | SET NULL
            -- E.g. ON UPDATE CASCADE ON DELETE SET NULL,
            ON UPDATE CASCADE ON DELETE CASCADE
);
