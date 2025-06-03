<?php
if($_SERVER['REQUEST_METHOD'] ==='POST'){
    
    session_start();

    function db_query($cmd, $conn){
        try{
        return $conn->query($cmd);
        }
        catch(mysqli_sql_exception $e){
            echo("Dados incorretos");

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

    $Usuario = $_POST["email"];
    $Senha = $_POST["password"];

    //Este metodo esta preparando para retornar uma linha determinada por um where

    $resultadoQuery = db_query("select * from tb_usuario where email = '$Usuario' and senha = '$Senha';", $mySQL);
    if($resultadoQuery){
        $resultado = $resultadoQuery->fetch_assoc();
        if($resultadoQuery->num_rows > 0){
             header("location:menu.html");
        }else{
            $_SESSION['erro_login'] = "Usuário '$Usuario' acesso não permitido!";
            header("location:Login.php");
        }
    }else{
        echo("nao foi achado seu erro");
    }
    
}
?>
