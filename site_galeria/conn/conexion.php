<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database_name = 'galeriaf_filamento'; 

$conn = new mysqli($host, $user, $password, $database_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>