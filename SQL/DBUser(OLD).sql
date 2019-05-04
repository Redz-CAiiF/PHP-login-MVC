SELECT "DROP DATABASE IF EXISTS DBUser;" AS "Eliminazione database eventualmente esistente";
DROP DATABASE IF EXISTS DBUser;

SELECT "CREATE DATABASE IF NOT EXISTS DBUser;" AS "Creazione database vuoto";
CREATE DATABASE  IF NOT EXISTS DBUser;

SELECT "USE DBUser;" AS "Impostazione database di default (per evitare database.table...)";
USE DBUser;

SELECT "CREATE TABLE region (...);" AS "Creazione nuova tabella region";
CREATE TABLE region (
		codiceRegione INT NOT NULL,
		nomeRegione VARCHAR(100) NOT NULL,
		codiceProvincia INT NOT NULL,
		inizialiProvincia VARCHAR(100) NOT NULL,
		nomeProvincia VARCHAR(100) NOT NULL,
		-- PRIMARY KEY
        PRIMARY KEY (codiceProvincia)
);

SELECT "CREATE TABLE Credential (...);" AS "Creazione nuova tabella Credential";
CREATE TABLE Credential (
	email VARCHAR(100) NOT NULL COMMENT "Mail unique identifier",
	username VARCHAR(100) NOT NULL COMMENT "Credential unique identifier",
	hash VARCHAR(100) NOT NULL COMMENT "Password hash",
	
	PRIMARY KEY(username),
	UNIQUE KEY(email)
);

SELECT "CREATE TABLE profileData (...);" AS "Creazione nuova tabella profileData";
CREATE TABLE profileData (
        -- primary key field
		username VARCHAR(100) NOT NULL COMMENT "Credential unique identifier",
		-- other data
		name VARCHAR(100) NOT NULL COMMENT "user name",
		surname VARCHAR(100) NOT NULL COMMENT "user surname",
		
		provincia INT NOT NULL COMMENT "user country region",
		address VARCHAR(100) NOT NULL COMMENT "user address",
		
		picture VARCHAR(300) NOT NULL COMMENT "picture path",
		birthdate date NOT NULL DEFAULT curdate() COMMENT 'user birthdate',
		ageinyears tinyint(4) GENERATED ALWAYS AS (timestampdiff(YEAR,`birthdate`,current_timestamp())) VIRTUAL COMMENT 'Current user age in years',
		description VARCHAR(500) COMMENT "user chosen description",
		banner VARCHAR(50) COMMENT "user special sentence",
		
		-- PRIMARY KEY
        PRIMARY KEY (username),
		
        -- FOREIGN KEYS
        FOREIGN KEY(username) REFERENCES Credential(username)
            -- ON UPDATE <UPDATE_ACTION> ON DELETE <DELETE_ACTION>,
            -- WHERE ACTION = RESTRICT | NO ACTION | CASCADE | SET NULL
            -- E.g. ON UPDATE CASCADE ON DELETE SET NULL,
            ON UPDATE CASCADE ON DELETE CASCADE,
		FOREIGN KEY(provincia) REFERENCES region(codiceProvincia)
            -- ON UPDATE <UPDATE_ACTION> ON DELETE <DELETE_ACTION>,
            -- WHERE ACTION = RESTRICT | NO ACTION | CASCADE | SET NULL
            -- E.g. ON UPDATE CASCADE ON DELETE SET NULL,
            ON UPDATE CASCADE ON DELETE CASCADE
);

-- INSERT INTO Credential values ('admin@admin.admin','admin','5E884898DA28047151D0E56F8DC6292773603D0D6AABBDD62A11EF721D1542D8');
-- INSERT INTO profileData (username,name,surname,provincia,address,picture,birthdate,description,banner) values ('admin','admin','admin','27','via admin 55','mypicture.jpg','2000/01/01','im the admin','u must do what i want');