<?php

// $servername = "localhost";
// $username = "root";
// $password = "root";
// $dbname = "fullstack";


// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

$db_user = 'root';
$pass = 'root';

$conn = new PDO('mysql:host=localhost;dbname=fullstack_vp;port=3306', $db_user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
