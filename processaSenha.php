<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    session_start();

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
            "localhost",//HOST
            "root",     //PERFIL     
            "12345678", //SENHA
            "db_2ads"   //NOME DA DATABASE
        );
    } catch (mysqli_sql_exception $e) {
        echo ("O seu burro tá errado");
    }

    $Usuario = $_POST["email"];

    $resultadoQuery = db_query("select * from tb_usuario where email = '$Usuario';", $mySQL);

    if ($resultadoQuery) {
        $_SESSION['erro_recuperar_senha'] = "Erro ao acessar o banco";
        header("location:recuperarSenha.php");
    }

    if ($resultadoQuery->num_rows == 0) {
        $_SESSION['erro_recuperar_senha'] = "Usuário '$Usuario' não encontrado";
        header("location:recuperarSenha.php");
    }
    
    $resultadoQuery = db_query("SET SQL_SAFE_UPDATES = 0;", $mySQL);
    $resultadoQuery = db_query("update tb_usuario set senha = '123' where email= '$Usuario';", $mySQL);
    $resultadoQuery = db_query("SET SQL_SAFE_UPDATES = 1;", $mySQL);

    header("location:Login.php");

}
?>