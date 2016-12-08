<?php 
$servername = "localhost";
$username = "twoleos_twoleos";
$password = "^INS)hDwT_)F";
$dbname = "twoleos_test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO users (email)
VALUES ('John@gmail.com')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();