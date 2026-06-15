<?php
// Página inicial do sistema
require_once 'includes/header.php';
?>

<div class="container" style="text-align: center; padding: 40px 20px;">
    <h1 style="color: #2f3640; margin-bottom: 20px;">Bem-vindo ao nosso Quiz Interativo! 🧠</h1>
    <p style="color: #747d8c; font-size: 18px; margin-bottom: 30px;">
        Teste seus conhecimentos em diversas matérias. Mostre que você é o melhor e suba no nosso Ranking Oficial!
    </p>

    <div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
        <a href="login.php" class="btn" style="text-decoration: none; width: 200px;">Fazer Login</a>
        <a href="cadastro.php" class="btn" style="background-color: #7f8fa6; text-decoration: none; width: 200px;">Criar uma Conta</a>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>