-- schema.sql
-- Run this in phpMyAdmin's SQL tab (or via mysql CLI) to set up the database.

CREATE DATABASE IF NOT EXISTS alumni_system;
USE alumni_system;

CREATE TABLE IF NOT EXISTS alumni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    date_of_birth DATE NOT NULL,
    student_id VARCHAR(50) NOT NULL,
    degree VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    graduation_year YEAR NOT NULL,
    current_job VARCHAR(150),
    company VARCHAR(150),
    city VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    address TEXT,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);