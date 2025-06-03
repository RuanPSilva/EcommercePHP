<?php
try{
$mySQL= new mysqli(
    "localhost",//HOST
    "root",     //PERFIL     
    "12345678", //SENHA
    "db_2ads"    //NOME DA TABELA
);
}catch(mysqli_sql_exception $e){
    echo("O seu burro tá errado");
}

echo("<Table border>");
echo("<tr>");
echo("<td>");
echo("Id");
echo("</td>");
echo("<td>");
echo("Email");
echo("</td>");
echo("<td>");
echo("Senha");
echo("</td>");
echo("<td>");
echo("Ativo");
echo("</td>");
echo("</tr>");
/***********************************************************************************/
/*Listar usuarios*/
$resultadoQuery = db_query('select * from tb_usuario;', $mySQL);
if($resultadoQuery){
   while($linha = $resultadoQuery->fetch_assoc()){
    echo("<tr>");
    echo("<td>");
    echo $linha['id'];
    echo("</td>");
    echo("<td>");
    echo $linha['email'];
    echo("</td>");
    echo("<td>");
    echo $linha['senha'];
    echo("</td>");
    echo("<td>");
    echo $linha['ativo'];
    echo("</td>");
    echo("</tr>");
}
} else{
    echo("Não deu certo");
}
/************************************************************************************

//Este metodo esta preparando para retornar uma linha determinada por um where

$resultadoQuery = db_query("select * from db_2ads.tb_usuario where usu_codigo = '$Usuario';", $mySQL);
if($resultadoQuery){
    $linha = $resultadoQuery->fetch_assoc();
        echo $linha['email'];
        echo $linha['senha'];
        echo $linha['ativo'];
        echo"<br>";

}
else{
    echo"Não deu certo o comando no banco";
}


//Este metodo esta preparado para realizar um Insert no banco de dados de acordo com o preenchimento das variaveis
$id = 7;
$usuario = 'nickname@dkad.com';
$senha = '65748';
$ativo = 'S';
$resultadoQuery = db_query("insert into db_2ads.tb_usuario 
                           (id, email,senha,ativo) 
                          VALUES ('$id','$usuario','$senha','$ativo')",$mySQL);

if ($resultadoQuery){
    echo "registro gravado no banco com sucesso";
}else{
    echo "Nao deu certo a gravação";
}


/*Este metodo esta preparado para realzar um Update no banco de dados

$usuario_old = 'nickname@dkad.com';
$usuario_new = 'LewisHamilton@email.com';

$resultadoQuery = db_query("Update tb_usuario set email = '$usuario_new' 
                             where email = '$usuario_old' ", $mySQL);

if($resultadoQuery){
    echo "registro Atualizado no banco com sucesso";

}else{
    echo "Nao deu certo a gravação";
}



$email = 'LewisHamilton@email.com';

$resultadoQuery = db_query("delete from tb_usuario where email = '$email' ",$mySQL);

if($resultadoQuery){
    echo "registro apagado da historia da humanidade";
}else{
    echo "Oooops, ainda há esperança";
}

/***********************************************************************************/

function db_query($cmd, $conn){
    try{
      return $conn->query($cmd);
    }
     catch(mysqli_sql_exception $e){
        echo("Deu Errado");

    }
}


?>