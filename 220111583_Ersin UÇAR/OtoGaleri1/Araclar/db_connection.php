<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "otogaleri";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}


?>