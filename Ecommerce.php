<?php
try {
    $mySQL = new mysqli(
        "localhost", //HOST
        "root",     //PERFIL     
        "12345678", //SENHA
        "db_2ads"    //NOME DA TABELA
    );
} catch (mysqli_sql_exception $e) {
    echo ("O seu burro tá errado");
}
    
/***********************************************************************************/
/*Listar usuarios*/
$resultadoQuery = db_query('select * from tb_produto;', $mySQL);
if ($resultadoQuery) {
    echo('<body>');
    echo ("<div id='tabelinha'>");
    echo("<Table border>");
    echo ("<tr>");
    echo ("<td>");
    echo ("Cod");
    echo ("</td>");
    echo ("<td>");
    echo ("Nome");
    echo ("</td>");
    echo ("<td>");
    echo ("Descricao");
    echo ("</td>");
    echo ("<td>");
    echo ("Preco");
    echo ("</td>");
    echo ("<td>");
    echo ("Imagem");
    echo ("</td>");
    echo ("</tr>");
    echo('</body>');
    while ($linha = $resultadoQuery->fetch_assoc()) {

        echo ("<tr>");
        echo ("<td>");
        echo $linha['cod_prod'];
        echo ("</td>");
        echo ("<td>");
        echo $linha['nome_prod'];
        echo ("</td>");
        echo ("<td>");
        echo $linha['descricao_prod'];
        echo ("</td>");
        echo ("<td>");
        echo $linha['preco_prod'];
        echo ("</td>");
        echo ("<td>");
        echo $linha['img_path'];
        echo ("</td>");
        echo ("</tr>");
    }
echo ("</div>");
echo("<input class='estilo' type='button' value='Retornar menu' onclick='retornarMenu()'></input>");
} 
else {
    echo ("Não deu certo");
}



function db_query($cmd, $conn)
{
    try {
        return $conn->query($cmd);
    } catch (mysqli_sql_exception $e) {
        echo ("Deu Errado");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Ecommerce</title>
</head>

<script src="JavaScipt.js"></script>

</html>