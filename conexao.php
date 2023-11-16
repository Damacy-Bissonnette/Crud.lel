<?php
$servidor = "localhost";
$usuario = "meu_usuario_mysql";
$senha = "minha_senha_mysql";
$banco = "gerenciamento_usuarios";

$conexao = new mysql($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>
