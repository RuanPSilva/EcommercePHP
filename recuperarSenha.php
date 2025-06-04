<?php
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
    <section class="container">
        <form action="processaSenha.php" method="post">
            <div>
                <h1 class="Paragrafos">Redefina sua senha</h1>
                <input type="email" name="email" placeholder="email" required><br>
            </div>
        <?php
        if (isset($_SESSION['erro_recuperar_senha'])) {
            echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['erro_recuperar_senha'] . "</p>";
            unset($_SESSION['erro_recuperar_senha']); // Limpa a mensagem após exibir
        }
        ?>
        <div>
            <button type="submit">Redefinir senha</button>
        </div>
        </form>
    </section>
</body>

</html>