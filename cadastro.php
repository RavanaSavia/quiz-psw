<?php
// O header já cuida da sessão e de puxar o funcoes.php, então o código fica super limpo! [cite: 64]
require_once 'includes/header.php';
?>

<div class="container">
    <h2>📝 Cadastrar Novo Usuário</h2>
    <p style="margin-bottom: 20px; color: #747d8c;">Preencha os dados abaixo para se cadastrar e começar a jogar.</p>

    <?php if (isset($_SESSION['erro'])): ?>
        <div style="background-color: #ffeef0; color: #ea2027; padding: 12px; border-radius: 5px; border: 1px solid #ffccc7; margin-bottom: 20px; text-align: center; font-weight: bold;">
            ❌ <?= htmlspecialchars($_SESSION['erro']); ?>
            <?php unset($_SESSION['erro']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['sucesso'])): ?>
        <div style="background-color: #e3fcef; color: #10ac84; padding: 12px; border-radius: 5px; border: 1px solid #1dd1a1; margin-bottom: 20px; text-align: center; font-weight: bold;">
            ✅ <?= htmlspecialchars($_SESSION['sucesso']); ?>
            <?php unset($_SESSION['sucesso']); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="controllers/proc_cadastro.php">
        <div class="form-group">
            <label for="usuario">Nome de usuário:</label>
            <input type="text" id="usuario" name="usuario" class="form-control" required minlength="3" placeholder="Mínimo 3 caracteres">
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" class="form-control" required minlength="4" placeholder="Mínimo 4 caracteres">
        </div>

        <button type="submit" class="btn">Cadastrar</button>
    </form>

    <div style="margin-top: 15px; text-align: center;">
        <p>Já tem conta? <a href="login.php" style="color: #4a69bd; font-weight: bold; text-decoration: none;">Faça login</a></p>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>