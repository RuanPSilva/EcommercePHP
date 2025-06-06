<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tela de login</title>
</head>
<body>

    <section class="containerLogin">
        <div class="Login">
            <h2 class="paragrafosLogin">Login</h2>
            <form action="processaLogin.php" method="post">
                <input class="caixaTextoLogin" type="email" name="email" placeholder="Email" required><br>

                <input class="caixaTextoLogin" type="password" name="password" placeholder="Senha" required><br> 

                <span id="error-message" class="error"></span>
                
                <div class="botaoLogin">
                    <button type="submit" class="botoesGeral">Entrar</button>
                </div>
                
                <div>
                    <button value="Cadastre-se" class="botoesGeral" onclick="window.location.href='cadastrar.php'">Cadastre-se</button>
                </div> 
                <div>
                    <a onclick="window.location.href='recuperarSenha.php'">Recupere sua senha</a>
                </div>
            </form>

            <?php
                if (isset($_SESSION['erro_login'])) {
                    echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['erro_login'] . "</p>";
                    unset($_SESSION['erro_login']);
                }

                if (isset($_SESSION['conteudo'])) {
                    echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['conteudo'] . "</p>";
                    unset($_SESSION['conteudo']);
                }
            ?>
        </div>
    </section>

</body>
</html>
