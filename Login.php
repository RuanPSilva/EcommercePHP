<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tela de login</title>
</head>
<body>
    
    <div class="container">
    <h2 class="Paragrafos">Login</h2>
        <form action="processaLogin.php" method="post">
           
            <input class="caixaTexto" type="email" name="email" placeholder="Email" required><br>
            <input class="caixaTexto" type="password" name="password" placeholder="Senha" required><br> 
            <span id="error-message" class="error"></span>
                 
            <div class="botoes">
                <button type="submit">Entrar</button>
            </div>
            <div class="botoes">
                <button value="Cadastre-se" onclick="window.location.href='cadastrar.php'">Cadastre-se</button>
            </div> 
            <div>
                <a onclick="window.location.href='recuperarSenha.php'">Recupere sua senha</a>
            </div>
           
        </form>

        <?php

            if (isset($_SESSION['erro_login'])) {
                echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['erro_login'] . "</p>";
                unset($_SESSION['erro_login']); // Limpa a mensagem após exibir
            }

            if (isset($_SESSION['conteudo'])) {
                echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['conteudo'] . "</p>";
                unset($_SESSION['conteudo']); // Limpa a mensagem após exibir
            }
        ?>
    </div>
        <!--Colocar a imagem na lateral do forms-->
     <img src="img/pato1.png">
</body>
</html>

