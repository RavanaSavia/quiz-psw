<?php
require_once 'includes/header.php';
?>

<div class="container">
    <h2>🔑 Acesso ao Sistema</h2>
    <p style="margin-bottom: 20px; color: #747d8c;">Digite seu usuário e senha para entrar.</p>

    <form action="controllers/login.php" method="POST">
        <div class="form-group">
            <label for="usuario">Nome de usuário:</label>
            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Digite seu nome" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required>
        </div>

        <button type="submit" class="btn">Entrar</button>
    </form>

    <div style="margin-top: 15px; text-align: center;">
        <p>Ainda não tem conta? <a href="cadastro.php" style="color: #4a69bd; font-weight: bold; text-decoration: none;">Cadastre-se</a></p>
    </div>
</div>

<?php

require_once 'includes/footer.php';
?>