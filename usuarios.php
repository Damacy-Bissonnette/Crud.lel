<?php
$servername = "meu_mysql_servidor";
$username = "meu_mysql_usuario";
$password = "meu_mysql_senha";
$dbname = "gerenciamento_usuarios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Adicionar usuário
    if (isset($_POST['add_user'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar usuário: " . $conn->error;
        }
    }

    // Editar usuário
    if (isset($_POST['edit_user'])) {
        $id = $_POST['edit_id'];
        $nome = $_POST['edit_nome'];
        $email = $_POST['edit_email'];

        $sql = "UPDATE usuarios SET nome='$nome', email='$email' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário editado com sucesso!";
        } else {
            echo "Erro ao editar usuário: " . $conn->error;
        }
    }

    // Excluir usuário
    if (isset($_POST['delete_user'])) {
        $id = $_POST['delete_id'];

        $sql = "DELETE FROM usuarios WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário excluído com sucesso!";
        } else {
            echo "Erro ao excluir usuário: " . $conn->error;
        }
    }
}

// Buscar todos os usuários
$result = $conn->query("SELECT * FROM usuarios");

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
</head>
<body>
    <h2>Lista de Usuários</h2>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li><?= $row['nome'] ?> - <?= $row['email'] ?></li>
        <?php endwhile; ?>
    </ul>

    <h2>Adicionar Novo Usuário</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" name="email" required>

        <button type="submit" name="add_user">Adicionar Usuário</button>
    </form>

    <h2>Editar Usuário</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="edit_id">ID do Usuário:</label>
        <input type="text" name="edit_id" required>

        <label for="edit_nome">Novo Nome:</label>
        <input type="text" name="edit_nome" required>

        <label for="edit_email">Novo E-mail:</label>
        <input type="email" name="edit_email" required>

        <button type="submit" name="edit_user">Editar Usuário</button>
    </form>

    <h2>Excluir Usuário</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="delete_id">ID do Usuário:</label>
        <input type="text" name="delete_id" required>

        <button type="submit" name="delete_user">Excluir Usuário</button>
    </form>
</body>
</html>
