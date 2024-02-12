CREATE TABLE register (
	id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	dob DATE NOT NULL,
	address TEXT NOT NULL,
	phone VARCHAR(20) NOT NULL,
	agree TINYINT(1) NOT NULL
);
CREATE TABLE contact_form (
	id INT AUTO_INCREMENT PRIMARY KEY,
	full_name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	message TEXT NOT NULL
);
CREATE TABLE feedback (
	id INT AUTO_INCREMENT PRIMARY KEY,
	rating INT NOT NULL,
	opinion TEXT NOT NULL
);
CREATE TABLE enrollments (
	id INT AUTO_INCREMENT PRIMARY KEY,
	full_name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	phone VARCHAR(20) NOT NULL,
	address TEXT NOT NULL,
	date DATE NOT NULL,
	course VARCHAR(255) NOT NULL
);

CREATE TABLE chat_messages (
	id INT AUTO_INCREMENT PRIMARY KEY,
	expert_id INT NOT NULL,
	message TEXT NOT NULL
);

CREATE TABLE health_data (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	age INT NOT NULL,
	blood_pressure VARCHAR(255),
	bmi DECIMAL(5, 2),
	height DECIMAL(5, 2),
	weight DECIMAL(5, 2),
	heart_rate INT,
	date DATE NOT NULL
);

CREATE TABLE contact_form_2 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	firstname VARCHAR(255) NOT NULL,
	lastname VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	country VARCHAR(255) NOT NULL,
	message TEXT NOT NULL
);
