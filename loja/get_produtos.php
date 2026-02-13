<?php
include 'config.php';
header('Content-Type: application/json');

$result = $conn->query("SELECT * FROM produtos");
$produtos = [];

while($row = $result->fetch_assoc()) {
    $produtos[] = $row;
}

echo json_encode($produtos);
?>