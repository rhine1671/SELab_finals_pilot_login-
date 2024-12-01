<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php';
 
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Pilot</title>
	<style>
		body {
			font-family: "Arial";
		}
		input {
			font-size: 1.5em;
			height: 50px;
			width: 200px;
		}
		table, th, td {
			border:1px solid black;
		}
	</style>
</head>
<body>
	<h1>Are you sure you want to delete this pilot?</h1>
	<?php $getPilotByID = getPilotByID($pdo, $_GET['pilot_id']); ?>
	<div class="container" style="border-style: solid; border-color: red; background-color: #ffcbd1;height: 590px;">
		<h2>First Name: <?php echo $getPilotByID['first_name']; ?></h2>
		<h2>Last Name: <?php echo $getPilotByID['last_name']; ?></h2>
		<h2>Email: <?php echo $getPilotByID['email']; ?></h2>
		<h2>Gender: <?php echo $getPilotByID['gender']; ?></h2>
		<h2>Address: <?php echo $getPilotByID['address']; ?></h2>
		<h2>Date of Birth: <?php echo $getPilotByID['date_of_birth']; ?></h2>
		<h2>Nationality: <?php echo $getPilotByID['nationality']; ?></h2>
		<h2>Total Flight Hours: <?php echo $getPilotByID['total_flight_hours']; ?></h2>
		<h2>Years of Experience: <?php echo $getPilotByID['years_of_experience']; ?></h2>
		<h2>License: <?php echo $getPilotByID['license']; ?></h2>
		<h2>Aircraft Flown: <?php echo $getPilotByID['aircraft_flown']; ?></h2>
		<h2>Type Rating: <?php echo $getPilotByID['type_rating']; ?></h2>

		<div class="deletePilotBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?pilot_id=<?php echo $_GET['pilot_id']; ?>" method="POST">
				<input type="submit" name="deletePilotBtn" value="Delete" style="background-color: #f69697; border-style: solid;">
			</form>			
		</div>	

	</div>
</body>
</html>