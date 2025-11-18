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
	`name` VARCHAR(15) UNIQUE NOT NULL,
	created_at TIMESTAMP DEFAULT current_timestamp,
	deleted_at TIMESTAMP,
	logo BLOB -- ver que onda acá
);

CREATE TABLE User_Role_Clan (
	id_role INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`role` ENUM("OWNER", "MEMBER") DEFAULT "MEMBER",
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
	id_user INT UNSIGNED,
	FOREIGN KEY (id_user) REFERENCES User(id_user),
	id_clan INT UNSIGNED,
	FOREIGN KEY (id_clan) REFERENCES Clan(id_clan)
);

insert into `User` (email, username, playername, pass) values
("fran@gmail.com", "fran", "fran", "fran123"),
("bruno@gmail.com", "bruno", "bruno", "bruno123"),
("pedro@gmail.com", "pedro", "pedro", "pedro123"),
("juan@gmail.com", "juan", "juan", "juan123"),
("maria@gmail.com", "maria", "maria", "maria123");

insert into Clan (`name`) values
("Clan1"),
("Clan2"),
("Clan3");

insert into User_Role_Clan (`role`, id_user, id_clan) values
("OWNER", 1, 1),
("MEMBER", 2, 1),
("OWNER", 3, 3),
("OWNER", 4, 2),
("MEMBER", 5, 1);

DROP USER IF EXISTS "backend";
CREATE USER "backend" IDENTIFIED BY "backend_teehub";
GRANT SELECT, INSERT, UPDATE ON teehub.* TO "backend";

CREATE VIEW UserClanRoleView AS
SELECT 
    u.id_user,
    u.username, 
    r.`role` AS user_role,
    c.id_clan,
    c.`name` AS clan_name 
FROM `User` u
INNER JOIN User_Role_Clan r ON u.id_user = r.id_user
INNER JOIN Clan c ON c.id_clan = r.id_clan;


SELECT * FROM `User`;
SELECT * FROM Clan;

SELECT username, user_role, clan_name FROM UserClanRoleView;
SELECT username, user_role, clan_name FROM UserClanRoleView WHERE id_clan = 1;
SELECT username, user_role, clan_name FROM UserClanRoleView WHERE id_user = 2;


