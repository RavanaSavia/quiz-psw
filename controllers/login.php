<?php
include 'includes/header.php';
$erro = "";

// Se já estiver logado, vai para o painel
if (isset($_SESSION['usuario'])) {
    header("Location: painel.php");
    exit;
}
?>

<h2>🔑 Acesso ao Sistema</h2>

<?php if ($erro): ?>
    <div class="feedback errou"><?= $erro ?></div>
<?php endif; ?>

<form method="POST" action="controllers/proc_login.php">
   <label>Nome de usuário:</label>
    <input type="text" name="nome" required placeholder="Digite seu nome">

    <label>Senha:</label>
    <input type="password" name="senha" required placeholder="Digite sua senha">

     <button type="submit">Entrar</button>
     </form>

     <p style="text-align:center; margin-top:15px;">
         Ainda não tem conta? <a href="cadastro.php">Cadastre-se</a>
     </p>

     <?php include 'includes/footer.php'; ?>