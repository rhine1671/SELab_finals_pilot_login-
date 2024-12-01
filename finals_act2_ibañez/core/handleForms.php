<?php  
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertNewUserBtn'])) {
	$username = trim($_POST['username']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$password = trim($_POST['password']);
	$confirm_password = trim($_POST['confirm_password']);

	if (!empty($username) && !empty($first_name) && !empty($last_name) && !empty($password) && !empty($confirm_password)) {

		if ($password == $confirm_password) {

			$insertQuery = insertNewUser($pdo, $username, $first_name, $last_name, password_hash($password, PASSWORD_DEFAULT));
			$_SESSION['message'] = $insertQuery['message'];

			if ($insertQuery['status'] == '200') {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../login.php");
			}

			else {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../register.php");
			}

		}
		else {
			$_SESSION['message'] = "Please make sure both passwords are equal";
			$_SESSION['status'] = '400';
			header("Location: ../register.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../register.php");
	}
}

if (isset($_POST['loginUserBtn'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = checkIfUserExists($pdo, $username);
		$userIDFromDB = $loginQuery['userInfoArray']['user_id'];
		$usernameFromDB = $loginQuery['userInfoArray']['username'];
		$passwordFromDB = $loginQuery['userInfoArray']['password'];

		if (password_verify($password, $passwordFromDB)) {
			$_SESSION['user_id'] = $userIDFromDB;
			$_SESSION['username'] = $usernameFromDB;
			header("Location: ../index.php");
		}

		else {
			$_SESSION['message'] = "Username/password invalid";
			$_SESSION['status'] = "400";
			header("Location: ../login.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../register.php");
	}

}


if (isset($_POST['insertPilotBtn'])) {
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$email = trim($_POST['email']);
	$gender = trim($_POST['gender']);
	$address = trim($_POST['address']);
	$date_of_birth = trim($_POST['date_of_birth']);
	$nationality = trim($_POST['nationality']);
	$total_flight_hours = trim($_POST['total_flight_hours']);
	$years_of_experience = trim($_POST['years_of_experience']);
	$license = trim($_POST['license']);
	$aircraft_flown = trim($_POST['aircraft_flown']);
	$type_rating = trim($_POST['type_rating']);

	if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($gender)
		&& !empty($address) && !empty($date_of_birth) && !empty($nationality) && !empty($total_flight_hours)
		&& !empty($years_of_experience) && !empty($license) && !empty($aircraft_flown) && !empty($type_rating)) {
		$insertNewPilot = insertNewPilot($pdo, $first_name, $last_name, $email, 
		$gender, $address, $date_of_birth, $nationality, $total_flight_hours, $years_of_experience, $license, $aircraft_flown, $type_rating, $_SESSION['username']);
		$_SESSION['status'] =  $insertNewPilot['status']; 
		$_SESSION['message'] =  $insertNewPilot['message']; 
		header("Location: ../index.php");
	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../index.php");
	}

}

if (isset($_POST['editPilotBtn'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$date_of_birth = $_POST['date_of_birth'];
	$nationality = $_POST['nationality'];
	$total_flight_hours = $_POST['total_flight_hours'];
	$years_of_experience = $_POST['years_of_experience'];
	$license = $_POST['license'];
	$aircraft_flown = $_POST['aircraft_flown'];
	$type_rating = $_POST['type_rating'];
	$date = date('Y-m-d H:i:s');

	if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($gender)
		&& !empty($address) && !empty($date_of_birth) && !empty($nationality) && !empty($total_flight_hours)
		&& !empty($years_of_experience) && !empty($license) && !empty($aircraft_flown) && !empty($type_rating)) {

		$editPilot = editPilot($pdo, $first_name, $last_name, $email, 
		$gender, $address, $date_of_birth, $nationality, $total_flight_hours, $years_of_experience, $license, $aircraft_flown, $type_rating, 
		$date, $_SESSION['username'], $_GET['pilot_id']);

		$_SESSION['message'] = $editPilot['message'];
		$_SESSION['status'] = $editPilot['status'];
		header("Location: ../index.php");
	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../register.php");
	}

}

if (isset($_POST['deletePilotBtn'])) {
	$pilot_id = $_GET['pilot_id'];

	if (!empty($pilot_id)) {
		$deletePilot = deletePilot($pdo, $pilot_id);
		$_SESSION['message'] = $deletePilot['message'];
		$_SESSION['status'] = $deletePilot['status'];
		header("Location: ../index.php");
	}
}

if (isset($_GET['logoutUserBtn'])) {
	unset($_SESSION['username']);
	header("Location: ../login.php");
}

?>