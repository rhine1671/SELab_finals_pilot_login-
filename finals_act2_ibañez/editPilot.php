<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update Pilot</title>
	<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
	<?php include 'navbar.php'; ?>

	<?php $getPilotByID = getPilotByID($pdo, $_GET['pilot_id']); ?>
	<form action="core/handleForms.php?pilot_id=<?php echo $_GET['pilot_id']; ?>" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="first_name" value="<?php echo $getPilotByID['first_name']; ?>">
		</p>
		<p>
			<label for="firstName">Last Name</label> 
			<input type="text" name="last_name" value="<?php echo $getPilotByID['last_name']; ?>">
		</p>
		<p>
			<label for="firstName">Email</label> 
			<input type="text" name="email" value="<?php echo $getPilotByID['email']; ?>">
		</p>
		<p>
			<label for="firstName">Gender</label> 
			<input type="text" name="gender" value="<?php echo $getPilotByID['gender']; ?>">
		</p>
		<p>
			<label for="firstName">Address</label> 
			<input type="text" name="address" value="<?php echo $getPilotByID['address']; ?>">
		</p>
		<p>
			<label for="firstName">Date of Birth</label> 
			<input type="text" name="date_of_birth" value="<?php echo $getPilotByID['date_of_birth']; ?>">
		</p>
		<p>
			<label for="firstName">Nationality</label> 
			<input type="text" name="nationality" value="<?php echo $getPilotByID['nationality']; ?>">
		</p>
		<p>
			<label for="firstName">Total Flight Hours</label> 
			<input type="text" name="total_flight_hours" value="<?php echo $getPilotByID['total_flight_hours']; ?>">
		</p>
		<p>
			<label for="firstName">Years of Experience</label> 
			<input type="text" name="years_of_experience" value="<?php echo $getPilotByID['years_of_experience']; ?>">
		</p>
		<p>
			<label for="firstName">License</label> 
			<input type="text" name="license" value="<?php echo $getPilotByID['license']; ?>">
		</p>
		<p>
			<label for="firstName">Aircraft Flown</label> 
			<input type="text" name="aircraft_flown" value="<?php echo $getPilotByID['aircraft_flown']; ?>">
		</p>
		<p>
			<label for="firstName">Type Rating</label> 
			<input type="text" name="type_rating" value="<?php echo $getPilotByID['type_rating']; ?>">
			<input type="submit" value="Update" name="editPilotBtn">
		</p>
	</form>
</body>
</html>