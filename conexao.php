<?php
$servidor = "localhost";
$usuario = "meu_usuario_mysql";
$senha = "minha_senha_mysql";
$banco = "gerenciamento_usuarios";

// Conectar ao banco de dados
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verificar a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Outra conexão (para ser usada conforme necessário)
$servername = "meu_mysql_servidor";
$username = "meu_mysql_usuario";
$password = "meu_mysql_senha";
$dbname = "universidade";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
