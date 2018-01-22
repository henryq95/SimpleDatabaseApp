CREATE DATABASE test;	--Create a database named test

use test;				--Select the test database to be used for the rest of the code

CREATE TABLE users (									--Create a table named users with 7 fields inside
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 	--id field of up to 11 Integers and automatically increase the primary key with each entry
	firstname VARCHAR(30) NOT NULL,				--Fields of variable characters(letters and numbers) of maximum 30 characters and cannot be null
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	age INT(3),									--Integer field of up to 3 integers for age
	location VARCHAR(50),						--Variable character field for location
	date TIMESTAMP								--Field for the current time in YYYY-MM-DD HH:MI:SS format by default
);