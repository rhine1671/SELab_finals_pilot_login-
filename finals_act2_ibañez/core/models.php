<?php  

require_once 'dbConfig.php';

function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM user_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"result"=> false,
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertNewUser($pdo, $username, $first_name, $last_name, $password) {
	$response = array();
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	if (!$checkIfUserExists['result']) {

		$sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_accounts";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getAllPilots($pdo) {
	$sql = "SELECT * FROM pilots_data 
			ORDER BY first_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function searchForAPilot($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM pilots_data WHERE 
			CONCAT(first_name,last_name,email,gender,
				address,date_of_birth,nationality,total_flight_hours, years_of_experience, license, aircraft_flown, type_rating, 
				date_added,added_by,last_updated,last_updated_by) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getPilotByID($pdo, $id) {
	$sql = "SELECT * from pilots_data WHERE pilot_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function insertAnActivityLog($pdo, $operation, $pilot_id, $first_name, $last_name, $email, 
$gender, $address, $date_of_birth, $nationality, $total_flight_hours, $years_of_experience, $license, $aircraft_flown, $type_rating, $username) {

	$sql = "INSERT INTO activity_logs (operation, pilot_id, first_name, last_name, email, gender,
				address, date_of_birth, nationality, total_flight_hours, years_of_experience, license, aircraft_flown, type_rating, username) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$operation, $pilot_id,$first_name, $last_name, $email, 
	$gender, $address, $date_of_birth, $nationality, $total_flight_hours, $years_of_experience, $license, $aircraft_flown, $type_rating, $username]);

	if ($executeQuery) {
		return true;
	}

}

function getAllActivityLogs($pdo) {
	$sql = "SELECT * FROM activity_logs 
			ORDER BY date_added DESC";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute()) {
		return $stmt->fetchAll();
	}
}

function insertNewPilot($pdo, $first_name, $last_name, $email, 
	$gender, $address, $date_of_birth, $nationality, $total_flight_hours, $years_of_experience, $license, $aircraft_flown, $type_rating, $added_by) {
	$response = array();
	$sql = "INSERT INTO pilots_data (first_name,
				last_name,
				email,
				gender,
				address,
				date_of_birth,
				nationality,
				total_flight_hours,
				years_of_experience,
				license,
				aircraft_flown,
				type_rating, 
				added_by
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$insertBranch = $stmt->execute([$first_name, $last_name, $email, 
	$gender, $address, $date_of_birth, $nationality, $total_flight_hours, $years_of_experience, $license, $aircraft_flown, $type_rating, $added_by]);

	if ($insertBranch) {
		$findInsertedItemSQL = "SELECT * FROM pilots_data ORDER BY date_added DESC LIMIT 1";
		$stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
		$stmtfindInsertedItemSQL->execute();
		$getPilotID = $stmtfindInsertedItemSQL->fetch();

		$insertAnActivityLog = insertAnActivityLog($pdo, "INSERT", $getPilotID['pilot_id'], 
			$getPilotID['first_name'], $getPilotID['last_name'], $getPilotID['email'], $getPilotID['gender'], 
			$getPilotID['address'], $getPilotID['date_of_birth'], $getPilotID['nationality'], $getPilotID['total_flight_hours'],
			$getPilotID['years_of_experience'], $getPilotID['license'], $getPilotID['aircraft_flown'], $getPilotID['type_rating'],
			$_SESSION['username']);

		if ($insertAnActivityLog) {
			$response = array(
				"status" =>"200",
				"message"=>"Pilot added successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			); 
		}
		
	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"Insertion of data failed!"
		);

	}

	return $response;
}

function editPilot($pdo, $first_name, $last_name, $email, 
	$gender, $address, $date_of_birth, $nationality, $total_flight_hours, $years_of_experience, $license, $aircraft_flown, $type_rating, 
	$last_updated, $last_updated_by, $pilot_id) {

	$response = array();
	$sql = "UPDATE pilots_data
			SET first_name = ?,
					last_name = ?,
					email = ?,
					gender = ?,
					address = ?,
					date_of_birth = ?,
					nationality = ?,
					total_flight_hours = ?,
					years_of_experience = ?,
					license = ?,
					aircraft_flown = ?,
					type_rating = ?,
					last_updated = ?,
					last_updated_by = ?
				WHERE pilot_id = ? 
			";
	$stmt = $pdo->prepare($sql);
	$editPilot = $stmt->execute([$first_name, $last_name, $email, 
	$gender, $address, $date_of_birth, $nationality, $total_flight_hours, $years_of_experience, $license, $aircraft_flown, $type_rating, 
	$last_updated, $last_updated_by, $pilot_id]);

	if ($editPilot) {

		$findInsertedItemSQL = "SELECT * FROM pilots_data WHERE pilot_id = ?";
		$stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
		$stmtfindInsertedItemSQL->execute([$pilot_id]);
		$getPilotID = $stmtfindInsertedItemSQL->fetch(); 

		$insertAnActivityLog = insertAnActivityLog($pdo, "UPDATE", $getPilotID['pilot_id'], 
			$getPilotID['first_name'], $getPilotID['last_name'], $getPilotID['email'], $getPilotID['gender'], 
			$getPilotID['address'], $getPilotID['date_of_birth'], $getPilotID['nationality'], $getPilotID['total_flight_hours'],
			$getPilotID['years_of_experience'], $getPilotID['license'], $getPilotID['aircraft_flown'], $getPilotID['type_rating'],
			$_SESSION['username']);

		if ($insertAnActivityLog) {

			$response = array(
				"status" =>"200",
				"message"=>"Pilot updated successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}

	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;

}


function deletePilot($pdo, $pilot_id) {
	$response = array();
	$sql = "SELECT * FROM pilots_data WHERE pilot_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$pilot_id]);
	$getPilotByID = $stmt->fetch();

	$insertAnActivityLog = insertAnActivityLog($pdo, "DELETE", $getPilotByID['pilot_id'], 
		$getPilotByID['first_name'], $getPilotByID['last_name'], $getPilotByID['email'], $getPilotByID['gender'], 
		$getPilotByID['address'], $getPilotByID['date_of_birth'], $getPilotByID['nationality'], $getPilotByID['total_flight_hours'],
		$getPilotByID['years_of_experience'], $getPilotByID['license'], $getPilotByID['aircraft_flown'], $getPilotByID['type_rating'],
		$_SESSION['username']);

	if ($insertAnActivityLog) {
		$deleteSql = "DELETE FROM pilots_data WHERE pilot_id = ?";
		$deleteStmt = $pdo->prepare($deleteSql);
		$deleteQuery = $deleteStmt->execute([$pilot_id]);

		if ($deleteQuery) {
			$response = array(
				"status" =>"200",
				"message"=>"Pilot deleted successfully!"
			);
		}
		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}
	}
	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;
}


// $getAllpilots_dataBySearch = getAllpilots_dataBySearch($pdo, "Dasma");
// echo "<pre>";
// print_r($getAllpilots_dataBySearch);
// echo "<pre>";



?>