<?php 
    /*In PHP when a form is submitted all inputs are placed into a $_POST array, ex: <input type="text" name="firstname"> becomes $_POST['firstname] */
    if (isset($_POST['submit'])) /*This code will run only if the form has been submitted*/
    {
        require "../config.php"; /*variables pulled from config.php*/
        require "../common.php";/*escape html function pulled from commmon.php*/

        try
        {
            $connection = new PDO($dsn, $username, $password, $options); /*$dsn is set to mysql:host=$host;dbname=$dbname to connect to the created test database*/

            $new_user = array(
                "firstname" => $_POST['firstname'],
                "lastname" => $_POST['lastname'],
                "email" => $_POST['email'],
                "age"   => $_POST['age'],
                "location"  => $_POST['location']
            );

            $sql = sprintf(     /*sprintf allows INSERT INTO x (y) values (:z)*/
                "INSERT INTO %s (%s) values (%s)", /*string format for sprintf*/
                "users", /*first $s parameter*/
                /*second (%s) parameter*/
                implode(",", array_keys($new_user)),                    /*implode joins array elements with a string, 
                /*string of $new_user array elements separated by ","*//*returns a string containing a string representation of all
                                                                        the array elements in the same order, with the glue string
                                                                         between each element. string implode ( string $glue, array $pieces )*/
                ":" . implode(", :", array_keys($new_user)) /* dot . is string concatnation operator*/
                /*third (%s) parameter*/

                /*final string returned by sprintf is INSERT INTO users (firstname, lastname, email, age, location) values (:firstname, :lastname, :email, :age, :location) */
            );
            /*(:firstname, :lastname, :email, :age, :location) are NAMED PLACEHOLDERS*/

            $statement = $connection->prepare($sql);
            $statement->execute($new_user); /*variable data from $new_user will be put in place by the prepared statement*/
            

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
        <blockquote><?php echo escape($_POST['firstname']); ?> successfully added. </blockquote>
    <?php
    }
?>

<h2>Add a user</h2>

<form method="post">
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