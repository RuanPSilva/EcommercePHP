<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
</head>
<body>
    <div class="login">

        <h2>Login</h2>
        <form action="processaLogin.php" method="post">


            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Senha" required><br>
            
            <span id="error-message" class="error"></span>
            
            
            <div>
                <button type="submit">Entrar</button>
            </div>
            
            <div>
                <input type="button" value="Cadastre-se" onclick="window.location.href='cadastrar.php'">
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

    <div>
        <input type="button" onclick="window.location.href='recuperarSenha.php'" value='Recuperar Senha'>
      
    </div>
</body>
</html>

