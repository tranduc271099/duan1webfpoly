<?php
$host = "localhost";
$dbname = "clothing_store";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Comment out or remove this line in production to prevent exposing connection status
    // echo "Kết nối cơ sở dữ liệu thành công!";
} catch (PDOException $e) {
    echo "Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage();
    exit; // Exit if connection fails
}
