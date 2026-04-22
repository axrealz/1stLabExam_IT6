<?php
$conn = new mysqli("localhost", "root", "", "Hotel_Management_DB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>