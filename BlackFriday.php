<?php
session_start();
$dataInicio = '';
$dataFim = '';

function db_query($cmd, $conn)
{
    try {
        return $conn->query($cmd);
    } catch (mysqli_sql_exception $e) {
        echo ("Deu Errado");
    }
}

try{
    $mySQL= new mysqli(
        "localhost",//HOST
        "root",     //PERFIL     
        "12345678", //SENHA
        "db_2ads"    //NOME DA DATABASE
    );
    }catch(mysqli_sql_exception $e){
        echo("O seu burro tá errado");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if(isset($_POST['Cadastrar'])){
            $dataInicio = $_POST['datainicio'];
            $dataFim = $_POST['datafim'];
    
            $dataInicioFormatada = date("Y-m-d H:i:s", strtotime($dataInicio));
            $dataFimFormatada = date("Y-m-d H:i:s", strtotime($dataInicio));

            echo 'Data de incio Cadastrada:' . $dataInicioFormatada . '<br>';
            echo 'Data de Fim Cadastrada:' . $dataFimFormatada . '<br>';
        }
        
    }

    if (isset($_POST['Limpar'])) {
        $dataInicio = '';
        $dataFim = '';
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form class="" method="POST" style='display:grid'>

<label class="">Data de incio:</label>
<input class="" type="datetime-local" name="datainicio" value='<?php echo ($dataInicio); ?>'><br>

<label class="">Data de fim:</label>
<input class="" type="datetime-local" name="datafim" value='<?php echo ($dataFim); ?>'><br>

<?php
if (isset($_SESSION['situacao_query'])) {
    echo "<p style='color: white; font-weight: bold;'>" . $_SESSION['situacao_query'] . "</p>";
    unset($_SESSION['situacao_query']); // Limpa a mensagem após exibir
}
?>
<div>
    <input class="" type="submit" name="Limpar" value="Limpar">
    <input class="" type="submit" name="Cadastrar" value="Cadastrar">
</div>

</form>          
</body>
</html>
