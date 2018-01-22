<?php

/* 
Open a connection via PDO to create a
new database and table with structure.
*/

require "config.php"; /*Database variables pulled from config.php*/

try 
{
	$connection = new PDO("mysql:host=$host", $username, $password, $options);	/*Represents a connection between PHP & DB*/
	$sql = file_get_contents("data/init.sql"); /*Place the contents of data/init.sql into variable $sql*/
	$connection->exec($sql); /*Execute the sql commands on the database*/
	
	echo "Database and table users created successfully.";
}

catch(PDOException $error) /*If an error occurs catch the exception into the $error variable*/
{
	echo $sql . "<br>" . $error->getMessage(); /*upon error display the SQL code that was attempted to execute and display the error message*/
}
?>