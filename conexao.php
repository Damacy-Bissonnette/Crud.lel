<?php
$servidor = "localhost";
$usuario = "meu_usuario_mysql";
$senha = "minha_senha_mysql";
$banco = "gerenciamento_usuarios";

$conexao = new mysql($servidor, $usuario, $senha, $banco);

$conn = new mysql($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);

}$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

?>
