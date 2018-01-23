<?php
   if (isset($_POST['submit'])) /*This code will run only if the form has been submitted*/
   {
	   require "../config.php"; /*variables pulled from config.php*/
	   require "../common.php"; /*escape html function pulled from commmon.php*/

	   try
	   {
		   $connection = new PDO($dsn, $username, $password, $options);
           
            $id  =   $_POST['id'];        
                
            $sql = "DELETE FROM users WHERE id = :id";
         
            /*prepare, bind, execute*/
            $statement = $connection->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
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
        <blockquote>ID <?php echo escape($_POST['id']); ?> successfully deleted. </blockquote>
    <?php
    }
?>

<h2>Delete a user's data based on ID number</h2>

<form method="post">
	<label for="id">ID</label>
    <input type="number" id="id" name="id">
    <input type="submit" name="submit" value="submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>