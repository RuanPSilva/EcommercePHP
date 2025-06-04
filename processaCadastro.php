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
        
                                        
        $resultadoQuery = db_query("insert into tb_usuario(email, senha, ativo) values ('$Usuario', '$Senha', 's');", $mySQL);
        if ($resultadoQuery) {
            $_SESSION['conteudo'] = "Usuário '$Usuario' cadastrado com sucesso!";
            header('Location:Login.php');
        }else{
            $_SESSION['conteudo'] = "Problema ao realizar o cadastro de '$Usuario' !";
            echo 'deu errado';
            header('Location:cadastrar.php');
        }
}
?>