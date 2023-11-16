<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>App de Demonstração</title>
</head>
<body>

<h1>Lista de Estudantes</h1>

<?php
$servername = "meu_mysql_servidor";
$username = "meu_mysql_usuario";
$password = "meu_mysql_senha";
$dbname = "minha_universidade";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Fetch data from the database
$result = $conn->query("SELECT id, nome, curso FROM estudantes");

// Display data in a table
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Curso</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['curso']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum estudante encontrado.";
}

$conn->close();
?>

</body>
</html>
