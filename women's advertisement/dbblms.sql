CREATE DATABASE contact_form_db;
USE contact_form_db;

CREATE TABLE contact_form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    message TEXT NOT NULL
);
