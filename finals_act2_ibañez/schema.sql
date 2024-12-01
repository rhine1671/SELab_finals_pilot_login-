CREATE TABLE user_accounts (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255),
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	password TEXT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE pilots_data (
	pilot_id INT AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	email VARCHAR(255),
	gender VARCHAR(255),
	address VARCHAR(255),
	date_of_birth DATE,
	nationality VARCHAR(255),
	total_flight_hours INT,
	years_of_experience INT,
	license VARCHAR (50),
	aircraft_flown VARCHAR(255),
	type_rating VARCHAR(50),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	added_by VARCHAR(255),
	last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	last_updated_by VARCHAR(255)
);

CREATE TABLE activity_logs (
	activity_log_id INT AUTO_INCREMENT PRIMARY KEY,
	operation VARCHAR(255),
	pilot_id INT,
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	email VARCHAR(255),
	gender VARCHAR(255),
	address VARCHAR(255),
	date_of_birth DATE,
	nationality VARCHAR(255),
	total_flight_hours INT,
	years_of_experience INT,
	license VARCHAR (50),
	aircraft_flown VARCHAR(255),
	type_rating VARCHAR(50),
	username VARCHAR(255),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);



