<?php
session_start();
include_once './conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Usuários</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            padding: 8px;
            margin: 5px;
            border: 1px solid #ddd;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }

        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <a href="index.php">Listar</a>
    <a href="cadastrar.php">Cadastrar</a>
    <h1>Listar</h1>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    // Receber o número da página
    $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

    // Setar a quantidade de registros por página
    $limite_resultado = 40;

    // Calcular o inicio da visualização
    $inicio = ($limite_resultado * $pagina) - $limite_resultado;

    $query_usuarios = "SELECT id, nome, email FROM usuarios ORDER BY id DESC LIMIT $inicio, $limite_resultado";
    $result_usuarios = $conn->prepare($query_usuarios);
    $result_usuarios->execute();

    if (($result_usuarios) AND ($result_usuarios->rowCount() != 0)) {
    ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
            <?php
            while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
                extract($row_usuario);
                ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $nome; ?></td>
                    <td><?php echo $email; ?></td>
                    <td>
                        <a href='visualizar.php?id=<?php echo $id; ?>'>Visualizar</a>
                        <a href='editar.php?id=<?php echo $id; ?>'>Editar</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php

        // Contar a quantidade de registros no BD
        $query_qnt_registros = "SELECT COUNT(id) AS num_result FROM usuarios";
        $result_qnt_registros = $conn->prepare($query_qnt_registros);
        $result_qnt_registros->execute();
        $row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);

        // Quantidade de página
        $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);

        // Máximo de link
        $maximo_link = 2;

        echo "<br><br><a href='index.php?page=1'>Primeira</a> ";

        for ($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++) {
            if ($pagina_anterior >= 1) {
                echo "<a href='index.php?page=$pagina_anterior'>$pagina_anterior</a> ";
            }
        }

        echo "$pagina ";

        for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
            if ($proxima_pagina <= $qnt_pagina) {
                echo "<a href='index.php?page=$proxima_pagina'>$proxima_pagina</a> ";
            }
        }

        echo "<a href='index.php?page=$qnt_pagina'>Última</a> ";
    } else {
        echo "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>";
    }
    ?>

    <h1>Lista de Estudantes</h1>
