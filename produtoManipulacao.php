<?php

$codigo = '';
$nome = '';
$descricao = '';
$preco = '';
$img = '';

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

function db_query($cmd, $conn)
{
    try {
        return $conn->query($cmd);
    } catch (mysqli_sql_exception $e) {
        echo ("Deu Errado");
    }
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
                else {
                $resultadoQuery = db_query("insert into tb_produto values(null,$codigo,'$nome','$descricao',$preco,'$img');", $mySQL);
                $_SESSION['situacao_query'] = "Cadastro efetuado com sucesso!";
            }
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
         $codigo = $_POST["codigo"];
         if ($codigo != null) {
            $resultadoQuery = db_query("select * from tb_produto where cod_prod = $codigo;", $mySQL);

            if ($resultadoQuery) {
                if ($resultadoQuery->num_rows > 0) {
                    $resultadoQuery = db_query("delete from tb_produto where cod_prod = $codigo;", $mySQL);
                    $_SESSION['situacao_query'] = "O código:$codigo ja foi de arrasta!";
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
    <link rel="stylesheet" href="style.css">
    <title>Produtos</title>
</head>

    <body>
         <h2 id="paragrafoProduto">Cadastro de Produto</h2>
        <section class="containerProduto">
           
            <form class="produto" method="POST" style='display:grid'>

                <label class="descricao">Código do produto</label>
                <center><input class="caixaTxtProduto" type="text" name="codigo" placeholder="Ex. 10" value='<?php echo ($codigo); ?>'></center><br>

                <label class="descricao">Nome do produto</label>
                <center><input class="caixaTxtProduto" type="text" name="nome" placeholder="Ex. Bicicleta" value='<?php echo ($nome); ?>'></center><br>

                <label class="descricao">Descrição do produto</label>
                <center><input class="caixaTxtProduto" type="text" name="descricao" placeholder="Ex. Rápida leve e resistente" value='<?php echo ($descricao); ?>'></center><br>

                <label class="descricao">Valor do produto</label>
                <center><input class="caixaTxtProduto" type="text" name="preco" placeholder="Ex. 4999.99" value='<?php echo ($preco); ?>'></center><br>

                <label class="descricao">Caminho da imagem</label>
                <center><input class="caixaTxtProduto" type="text" name="img" placeholder="Ex. Img/exemplo.jpg" value='<?php echo ($img); ?>'></center><br>


                <?php
                if (isset($_SESSION['situacao_query'])) {
                    echo "<p style='color: white; font-weight: bold;'>" . $_SESSION['situacao_query'] . "</p>";
                    unset($_SESSION['situacao_query']); // Limpa a mensagem após exibir
                }
                ?>
                <div>
                    <input class="botoesGeral" type="submit" name="Pesquisar" value="Pesquisar">
                    <input class="botoesGeral" type="submit" name="Limpar" value="Limpar">
                    <input class="botoesGeral" type="submit" name="Editar" value="Editar">
                    <input class="botoesGeral" type="submit" name="Cadastrar" value="Cadastrar">
                    <input class="botoesGeral" type="submit" name="Excluir" value="Excluir">
                    <input class="botoesGeral" type="button" value="Retornar menu" onclick="retornarMenu()" ></input>
                </div>

            </form>

        </section>
    </body>
<script src="JavaScipt.js"></script>
</html>