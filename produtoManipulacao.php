<?php

$codigo = '';
$nome = '';
$descricao = '';
$preco = '';
$img = '';
function db_query($cmd, $conn)
{
    try {
        return $conn->query($cmd);
    } catch (mysqli_sql_exception $e) {
        echo ("Dados incorretos");
    }
}

try {
    $mySQL = new mysqli(
        "localhost", //HOST
        "root",     //PERFIL     
        "12345678", //SENHA
        "db_2ads"    //NOME DA DATABASE
    );
} catch (mysqli_sql_exception $e) {
    echo ("O seu burro tá errado");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $codigo = '';
    $nome = '';
    $descricao = '';
    $preco = '';
    $img = '';

    if (isset($_POST['Pesquisar'])) {
        $codigo = $_POST["codigo"];
        if ($codigo != null) {
            $resultadoQuery = db_query("select * from tb_produto where cod_prod = $codigo;", $mySQL);

            if ($resultadoQuery) {
                if ($resultadoQuery->num_rows > 0) {
                    while ($linha = $resultadoQuery->fetch_assoc()) {
                        $codigo = $linha['cod_prod'];
                        $nome = $linha['nome_prod'];
                        $descricao = $linha['descricao_prod'];
                        $preco = $linha['preco_prod'];
                        $img = $linha['img_path'];
                    }
                } else {
                    $_SESSION['situacao_query'] = "O código:$codigo não existe!";
                }
            }

        } else {
            $_SESSION['situacao_query'] = "Utilize um código válido para efetuar a pesquisa!";
        }
    }

    if (isset($_POST['Cadastrar'])) {

        $codigo = $_POST["codigo"];
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $img = $_POST["img"];
        if ($codigo != null) {
            $resultadoQuery = db_query("select * from tb_produto where cod_prod = $codigo;", $mySQL);
            if ($resultadoQuery) {
                if ($resultadoQuery->num_rows > 0) {
                    $_SESSION['situacao_query'] = "O código:$codigo já está sendo utilizado!";
                }
            } else {
                $resultadoQuery = db_query("insert into tb_produto values(null,$codigo,'$nome','$descricao',$preco,'$img');", $mySQL);
                $_SESSION['situacao_query'] = "Cadastro efetuado com sucesso!";
            }
        } else {
            $_SESSION['situacao_query'] = "O código não pode ser cadastrado vazio!";
        }
    }
    if (isset($_POST['Editar'])) {
        $codigo = $_POST["codigo"];
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $img = $_POST["img"];

        $resultadoQuery = db_query("select * from tb_produto where cod_prod = $codigo;", $mySQL);
        if ($resultadoQuery) {
            if ($resultadoQuery->num_rows > 0) {
                $resultadoQuery = db_query("SET SQL_SAFE_UPDATES = 0;", $mySQL);
                $resultadoQuery = db_query("update tb_produto set 
                cod_prod= $codigo,
                nome_prod = '$nome',
                descricao_prod ='$descricao',
                preco_prod= '$preco',
                img_path = '$img' 
                where cod_prod= $codigo;", $mySQL);
                $resultadoQuery = db_query("SET SQL_SAFE_UPDATES = 1;", $mySQL);
                $_SESSION['situacao_query'] = "Produto atualizado com sucesso!";
            } else {
                $_SESSION['situacao_query'] = "O código:$codigo não existe!";
            }
        }
    }
    if (isset($_POST['Excluir'])) {

         if ($codigo != null) {
            $resultadoQuery = db_query("select * from tb_produto where cod_prod = $codigo;", $mySQL);

            if ($resultadoQuery) {
                if ($resultadoQuery->num_rows > 0) {
                    $resultadoQuery = db_query("select * from tb_produto where cod_prod = $codigo;", $mySQL);
                } else {
                    $_SESSION['situacao_query'] = "O código:$codigo não existe!";
                }
            }

        } else {
            $_SESSION['situacao_query'] = "Utilize um código válido para executar a exclusão!";
        }
    }

    if (isset($_POST['Limpar'])) {
        $codigo = '';
        $nome = '';
        $descricao = '';
        $preco = '';
        $img = '';
    }

}
?>

<!-- HTML-->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div align-content="center">
        <h2>Cadastro de Produto</h2>
        <form method="POST" style='display:grid'>

            <label>Código do produto:</label>
            <input type="text" name="codigo" placeholder="Código do produto" value='<?php echo ($codigo); ?>'><br>

            <label>Nome do produto:</label>
            <input type="text" name="nome" placeholder="Nome do produto" value='<?php echo ($nome); ?>'><br>

            <label>Descrição do produto:</label>
            <input type="text" name="descricao" placeholder="Descrição" value='<?php echo ($descricao); ?>'><br>

            <label>Valor do produto:</label>
            <input type="text" name="preco" placeholder="Preço" value='<?php echo ($preco); ?>'><br>

            <label>Caminho da imagem:</label>
            <input type="text" name="img" placeholder="Img" value='<?php echo ($img); ?>'><br>

            <?php
            if (isset($_SESSION['situacao_query'])) {
                echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['situacao_query'] . "</p>";
                unset($_SESSION['situacao_query']); // Limpa a mensagem após exibir
            }
            ?>
            <div>
                <input type="submit" name="Pesquisar" value="Pesquisar">
                <input type="submit" name="Limpar" value="Limpar">
                <input type="submit" name="Editar" value="Editar">
                <input type="submit" name="Cadastrar" value="Cadastrar">
                <input type="submit" name="Excluir" value="Excluir">
                <input type="submit" value="Voltar para o menu" onclick="windon.location.href='menu.html'">
            </div>

        </form>

    </div>
</body>

</html>