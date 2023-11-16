<?php
include('conexao.php');

$resultado = $conexao->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Usuários</title>
</head>
<body>
    <h2>Listagem de Usuários</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
        </tr>
        <?php while ($usuario = $resultado->fetch_assoc()) : ?>
            <tr>
                <td><?= $usuario['id'] ?></td>
                <td><?= $usuario['nome'] ?></td>
                <td><?= $usuario['email'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
