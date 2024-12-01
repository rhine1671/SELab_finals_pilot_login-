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
	<title>Document</title>
	<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="tableClass">
		<table style="width: 100%;" cellpadding="20">
			<tr>
				<th>Activity Log ID</th>
				<th>Operation</th>
				<th>Pilot ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Address</th>
				<th>Date of Birth</th>
				<th>Nationality</th>
				<th>Total Flight Hours</th>
				<th>Years of Experience</th>
				<th>License</th>
				<th>Aircraft Flown</th>
				<th>Type Rating</th>
				<th>Username</th>
				<th>Date Added</th>
			</tr>
			<?php $getAllActivityLogs = getAllActivityLogs($pdo); ?>
			<?php foreach ($getAllActivityLogs as $row) { ?>
			<tr>
				<td><?php echo $row['activity_log_id']; ?></td>
				<td><?php echo $row['operation']; ?></td>
				<td><?php echo $row['pilot_id']; ?></td>
				<td><?php echo $row['first_name']; ?></td>
				<td><?php echo $row['last_name']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['gender']; ?></td>
				<td><?php echo $row['address']; ?></td>
				<td><?php echo $row['date_of_birth']; ?></td>
				<td><?php echo $row['nationality']; ?></td>
				<td><?php echo $row['total_flight_hours']; ?></td>
				<td><?php echo $row['years_of_experience']; ?></td>
				<td><?php echo $row['license']; ?></td>
				<td><?php echo $row['aircraft_flown']; ?></td>
				<td><?php echo $row['type_rating']; ?></td>
				<td><?php echo $row['username']; ?></td>
				<td><?php echo $row['date_added']; ?></td>
			</tr>
			<?php } ?>
		</table>
</body>
</html>