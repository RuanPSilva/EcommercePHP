<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        
    <section class="container">
        <h1 class="Paragrafos">Cadastre-se</h1>    
            <form action="processaCadastro.php" method="post">
                <div class="botoes">
                    <input type="email" name="email" placeholder="Usuario" required><br>
                    <input type="password" name="password" placeholder="Senha" required><br>
                    <span id="error-message" class="error"></span>
                </div>
                <div>
                    <button type="submit">Cadastrar</button>
                </div>
            </form>

                <?php
                if (isset($_SESSION['conteudo'])) {
                    echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['conteudo'] . "</p>";
                    unset($_SESSION['conteudo']); // Limpa a mensagem após exibir
                }
                ?>
    </section>
</body> 
</html>