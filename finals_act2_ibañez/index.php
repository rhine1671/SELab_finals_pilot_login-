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
	<div class="searchForm">
		<form action="index.php" method="GET">
			<p>
				<input type="text" name="searchQuery" placeholder="Search here">
				<input type="submit" name="searchBtn" value="Search">
				<h3><a href="index.php">Search Again</a></h3>	
			</p>
		</form>
	</div>

	<?php  
	if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

		if ($_SESSION['status'] == "200") {
			echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";
		}

		else {
			echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";	
		}

	}
	unset($_SESSION['message']);
	unset($_SESSION['status']);
	?>

	<div class="tableClass">
		<table style="width: 100%;" cellpadding="20"> 
			<tr>
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
				<th>Date Added</th>
				<th>Added By</th>
				<th>Last Updated</th>
				<th>Last Updated By</th>
				<th>Action</th>
			</tr>
			<?php if (!isset($_GET['searchBtn'])) { ?>
				<?php $getAllPilots = getAllPilots($pdo); ?>
				<?php foreach ($getAllPilots as $row) { ?>
				<tr>
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
					<td><?php echo $row['date_added']; ?></td>
					<td><?php echo $row['added_by']; ?></td>
					<td><?php echo $row['last_updated']; ?></td>
					<td><?php echo $row['last_updated_by']; ?></td>
					<td>
						<a href="editPilot.php?pilot_id=<?php echo $row['pilot_id']; ?>">Update</a>
						<a href="deletePilot.php?pilot_id=<?php echo $row['pilot_id']; ?>">Delete</a>
					</td>
				</tr>
				<?php } ?>
			<?php } else { ?>
				<?php $searchsearchForAPilot =searchForAPilot($pdo, $_GET['searchQuery']); ?>
				<?php foreach ($searchsearchForAPilot as $row) { ?>
				<tr>
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
					<td><?php echo $row['date_added']; ?></td>
					<td><?php echo $row['added_by']; ?></td>
					<td><?php echo $row['last_updated']; ?></td>
					<td><?php echo $row['last_updated_by']; ?></td>
					<td>
						<a href="editPilot.php?pilot_id=<?php echo $row['pilot_id']; ?>">Update</a>
						<a href="deletePilot.php?pilot_id=<?php echo $row['pilot_id']; ?>">Delete</a>
					</td>
				</tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>
	
</body>
</html>