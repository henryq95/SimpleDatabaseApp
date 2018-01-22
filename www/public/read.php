<?php
   if (isset($_POST['submit'])) /*This code will run only if the form has been submitted*/
   {
	   require "../config.php"; /*variables pulled from config.php*/
	   require "../common.php"; /*escape html function pulled from commmon.php*/

	   try
	   {
		   $connection = new PDO($dsn, $username, $password, $options);
		   /*fetch data code, select users from specified location*/
		   $sql	=	"SELECT * FROM users
					   WHERE location = :location"; /*:location is NAMED PLACEHOLDER*/
			
			$location = $_POST['location'];

			/*prepare, bind, execute the sql statement*/
			$statement = $connection->prepare($sql);
			$statement->bindParam(':location', $location, PDO::PARAM_STR); /*represents the SQL CHAR or VARCHAR string data type*/
			$statement->execute();

			/*fetch the result*/
			$result = $statement->fetchAll();
	   }

	   catch(PDOException $error)
	   {
		   echo $sql . "<br>" . $error->getMessage();
	   }
   }
?>

<?php include "templates/header.php"; ?>

<?php
	if (isset($_POST['submit'])) /*Execute if form is submitted*/
	{
		if ($result && $statement->rowCount() > 0) /*Execute if query result has more than 0 rows*/
		{
			/*Open the table, loop through all results, then close the table*/
			/*Open table*/

			?>
			<h2>Results</h2>
	
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email Address</th>
						<th>Age</th>
						<th>Location</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
			<?php 

			foreach ($result as $row)
			{
				/*table contents*/
				?>
				<tr>
					<td><?php echo escape($row["id"]); ?></td>
					<td><?php echo escape($row["firstname"]); ?></td>
					<td><?php echo escape($row["lastname"]); ?></td>
					<td><?php echo escape($row["email"]); ?></td>
					<td><?php echo escape($row["age"]); ?></td>
					<td><?php echo escape($row["location"]); ?></td>
					<td><?php echo escape($row["date"]); ?> </td>
				</tr>
				<?php
			}
			/*close table*/
			?>
			</tbody>
		</table>
		<?php 
		}
		else
		{
			/*no results*/
			?>
			<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
			<?php
		}
	}
?>

<h2>Find user based on location</h2>

<form method="post">
	<label for="location">Location</label>
	<input type="text" id="location" name="location">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>