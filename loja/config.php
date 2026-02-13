<?php
$host = "localhost";
$user = "root"; // padrão XAMPP
$pass = "";     // padrão XAMPP
$db   = "only_shop";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die("Falha na conexão: " . $conn->connect_error); }
?>