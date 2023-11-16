<?php
$servername = "meu_mysql_servidor";
$username = "meu_mysql_usuario";
$password = "meu_mysql_senha";
$dbname = "universidade";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Fetch data from the database
$result = $conn->query("SELECT id, nome, curso FROM estudantes");

// Store data in an array
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Send data as JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
