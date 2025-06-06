<div?php
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
        
    <section id="containerCadastro">
        <div id="cadastro">
        <h1 id="paragrafoCad">Cadastre-se</h1>    
            <form action="processaCadastro.php" method="post">
                <div class="botoes">
                    <input class="caixaTxtCadastrar" type="email" name="email" placeholder="Usuario" required><br>
                    <input class="caixaTxtCadastrar" type="password" name="password" placeholder="Senha" required><br>
                    <span id="error-message" class="error"></span>
                </div>
                <div>
                    <button class="botoesGeral" type="submit">Cadastrar</button>
                </div>
            </form>

                <?php
                if (isset($_SESSION['conteudo'])) {
                    echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['conteudo'] . "</p>";
                    unset($_SESSION['conteudo']); // Limpa a mensagem após exibir
                }
                ?>
        </div>
</section>
</body> 
</html>