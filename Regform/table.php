<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE students (
ID INT(9) PRIMARY KEY, 
NAME VARCHAR(30) NOT NULL,
ROLLNO INT(9) NOT NULL,
DEPARTMENT VARCHAR(50) NOT NULL,
YEAR INT(4) NOT NULL,
EMAIL VARCHAR(50) NOT NULL,
PASSWORD VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Students created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>