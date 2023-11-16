<?php
$servidor = "localhost";
$usuario = "seu_usuario_mysql";
$senha = "sua_senha_mysql";
$banco = "gerenciamento_usuarios";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>
