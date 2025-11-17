DROP DATABASE IF EXISTS teehub;
CREATE DATABASE teehub;
USE teehub;

CREATE TABLE `User` (
	id_user INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(255) UNIQUE NOT NULL,
	username VARCHAR(15) UNIQUE NOT NULL,
	pass VARCHAR(50) NOT NULL,
	playername VARCHAR(15),
	created_at TIMESTAMP DEFAULT current_timestamp,
	deleted_at TIMESTAMP
);

CREATE TABLE Clan (
	id_clan INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(15) UNIQUE NOT NULL,
	created_at TIMESTAMP DEFAULT current_timestamp,
	deleted_at TIMESTAMP,
	logo BLOB -- ver que onda acá
);

CREATE TABLE UserRoleXClan (
	id_role INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	role ENUM("OWNER", "MEMBER") DEFAULT "MEMBER",
	id_user INT UNSIGNED,
	FOREIGN KEY (id_user) REFERENCES User(id_user),
	id_clan INT UNSIGNED,
	FOREIGN KEY (id_clan) REFERENCES Clan(id_clan)
);

CREATE TABLE Post (
	id_post INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(50) NOT NULL,
	content BLOB, -- ver que onda acá
	created_at TIMESTAMP DEFAULT current_timestamp,
	deleted_at TIMESTAMP,
	id_clan INT UNSIGNED,
	FOREIGN KEY (id_clan) REFERENCES Clan(id_clan)
);

insert into `User` (email, username, playername) values ("franbag@gmail.com", "fran", "francisco");
SELECT * FROM `User`;
