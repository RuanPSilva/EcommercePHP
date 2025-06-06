<div?php
 session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recupera Senha</title>
</head>

<body>
    <section id="containerSenha">
        <div id="Senha">
            <form action="processaSenha.php" method="post">
                <div>
                    <h1 id="paragrafoSenha">Redefina sua senha</h1>
                    <input id="caixaTxtSenha" type="email" name="email" placeholder="email" required><br>
                </div>
            <?php
            if (isset($_SESSION['erro_recuperar_senha'])) {
                echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['erro_recuperar_senha'] . "</p>";
                unset($_SESSION['erro_recuperar_senha']); // Limpa a mensagem após exibir
            }
            ?>
            <div id="botaoRecuperar">
                <button class="botoesGeral" type="submit">Redefinir senha</button>
            </div>
            </form>
        </div>    
    </section>
</body>

</html>