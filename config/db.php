<?php
$host = "127.0.0.1:3306";
$user = "u647109978_admin";
$pass = "admin";
$db   = "u647109978_wssb";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
