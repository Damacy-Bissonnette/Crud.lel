<?php
session_start();
ob_start();
include_once './conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location: index.php");
    exit();
}

$query_usuario = "SELECT id, nome, email FROM usuarios WHERE id = ?";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->bind_param('i', $id);
$result_usuario->execute();

$result_usuario = $result_usuario->get_result();

if (($result_usuario) && ($result_usuario->num_rows != 0)) {
    $row_usuario = $result_usuario->fetch_assoc();
    //var_dump($row_usuario);
} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Celke - Editar</title>
    <style>
        .success-message {
            color: green;
        }

        .error-message {
            color: #f00;
        }
    </style>
    <script>
        // JavaScript para fechar mensagens de sucesso após alguns segundos
        setTimeout(function () {
            document.getElementById("success-message").style.display = "none";
        }, 5000);
    </script>
</head>
<body>
<a href="index.php">Listar</a><br>
<a href="cadastrar.php">Cadastrar</a><br>

<h1>Editar</h1>

<?php
//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Verificar se o usuário clicou no botão
if (!empty($dados['EditUsuario'])) {
    $empty_input = false;
    $dados = array_map('trim', $dados);
    if (in_array("", $dados)) {
        $empty_input = true;
        echo "<p class='error-message'>Erro: Necessário preencher todos campos!</p>";
    } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $empty_input = true;
        echo "<p class='error-message'>Erro: Necessário preencher com e-mail válido!</p>";
    }

    if (!$empty_input) {
        $query_up_usuario = "UPDATE usuarios SET nome=?, email=? WHERE id=?";
        $edit_usuario = $conn->prepare($query_up_usuario);
        $edit_usuario->bind_param('ssi', $dados['nome'], $dados['email'], $id);
        if ($edit_usuario->execute()) {
            $_SESSION['msg'] = "<p class='success-message'>Usuário editado com sucesso!</p>";
            header("Location: index.php");
        } else {
            echo "<p class='error-message'>Erro: Usuário não editado com sucesso!</p>";
        }
    }
}
?>

<form id="edit-usuario" method="POST" action="">
    <label>Nome: </label>
    <input type="text" name="nome" id="nome" placeholder="Nome completo"
           value="<?php if (isset($dados['nome'])) { echo $dados['nome']; } elseif (isset($row_usuario['nome'])) { echo $row_usuario['nome']; } ?>" ><br><br>

    <label>E-mail: </label>
    <input type="email" name="email" id="email" placeholder="Melhor e-mail"
           value="<?php if (isset($dados['email'])) { echo $dados['email']; } elseif (isset($row_usuario['email'])) { echo $row_usuario['email']; } ?>" ><br><br>

    <input type="submit" value="Salvar" name="EditUsuario">
</form>

<!-- Exibir mensagem de sucesso -->
<div id="success-message"><?php
    if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?></div>

</body>
</html>
