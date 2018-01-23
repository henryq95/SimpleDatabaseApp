<?php
   if (isset($_POST['submit'])) /*This code will run only if the form has been submitted*/
   {
	   require "../config.php"; /*variables pulled from config.php*/
	   require "../common.php"; /*escape html function pulled from commmon.php*/

	   try
	   {
		   $connection = new PDO($dsn, $username, $password, $options);
           /*fetch data code, select users from specified location*/
           
           $id  =   $_POST['id'];

           $updated_user = array(
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "email" => $_POST['email'],
            "age"   => $_POST['age'],
            "location"  => $_POST['location']
        );

        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, age = :age, location = :location WHERE id=$id";
        /*prepare and execute*/
        $statement = $connection->prepare($sql);
        $statement->execute($updated_user);
       }
       


	   catch(PDOException $error)
	   {
		   echo $sql . "<br>" . $error->getMessage();
	   }
   }
?>

<?php include "templates/header.php"; ?>

<?php 
    if (isset($_POST['submit']) && $statement)
    {   ?>
        <blockquote>ID <?php echo escape($_POST['id']); ?> successfully updated. </blockquote>
    <?php
    }
?>

<h2>Update a user's data based on ID number</h2>

<form method="post">
	<label for="id">ID</label>
	<input type="number" id="id" name="id">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname">
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email">
    <label for="age">Age</label>
    <input type="text" name="age" id="age">
    <label for="location">Location</label>
    <input type="text" name="location" id="location">
    <input type="submit" name="submit" value="submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>