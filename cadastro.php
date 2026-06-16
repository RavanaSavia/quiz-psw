<?php
// Caminho funções e o header
session_start();
require_once __DIR__ . '/includes/funcoes.php';
include RAIZ . 'includes/header.php';

$erro = "";
?>

<h2>📝 Cadastrar Novo Usuário</h2>

<?php if (isset($_SESSION['erro'])): ?>
  <div class="feedback errou">
    <?= $_SESSION['erro'];
    unset($_SESSION['erro']); ?>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['sucesso'])): ?>
  <div class="feedback acertou">
    <?= $_SESSION['sucesso'];
    unset($_SESSION['sucesso']); ?>
  </div>
<?php endif; ?>

<form method="POST" action="<?= RAIZ ?>controllers/proc_cadastro.php">
  <label>Nome de usuário:</label>
  <input type="text" name="nome" required minlength="3" placeholder="Mínimo 3 caracteres">

  <label>Senha:</label>
  <input type="password" name="senha" required minlength="4" placeholder="Mínimo 4 caracteres">

  <button type="submit">Cadastrar</button>
</form>

<p style="text-align:center; margin-top:15px;">
  Já tem conta? <a href="<?= RAIZ ?>login.php">Faça login</a>
</p>

<?php
//  Caminho para o rodapé
include RAIZ . 'includes/footer.php';
?>
<?php
// Caminho funções e o header
session_start();
require_once __DIR__ . '/includes/funcoes.php';
include RAIZ . 'includes/header.php';

$erro = "";
?>

<h2>📝 Cadastrar Novo Usuário</h2>

<?php if (isset($_SESSION['erro'])): ?>
  <div class="feedback errou">
    <?= $_SESSION['erro'];
    unset($_SESSION['erro']); ?>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['sucesso'])): ?>
  <div class="feedback acertou">
    <?= $_SESSION['sucesso'];
    unset($_SESSION['sucesso']); ?>
  </div>
<?php endif; ?>

<form method="POST" action="<?= RAIZ ?>controllers/proc_cadastro.php">
  <label>Nome de usuário:</label>
  <input type="text" name="nome" required minlength="3" placeholder="Mínimo 3 caracteres">

  <label>Senha:</label>
  <input type="password" name="senha" required minlength="4" placeholder="Mínimo 4 caracteres">

  <button type="submit">Cadastrar</button>
</form>

<p style="text-align:center; margin-top:15px;">
  Já tem conta? <a href="<?= RAIZ ?>login.php">Faça login</a>
</p>

<?php
// Caminho para o rodapé
include RAIZ . 'includes/footer.php';
?>
