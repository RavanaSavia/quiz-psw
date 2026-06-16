<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('ACESSO_PERMITIDO', true);

// Inclui de forma fixa o arquivo global de inteligência de funções
require_once __DIR__ . '/funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Interativo</title>
    
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

    <header class="cabecalho">
        <h1>📚 Quiz de Conhecimentos</h1>
        
        <?php if (isset($_SESSION['usuario'])): ?>
            <div class="usuario-logado">
                Olá, <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong> |
                Pontos Ganhos: <strong><?= $_SESSION['pontos'] ?? 0 ?></strong> |
                <a href="logout.php" class="link-sair" style="color: #ff6b6b; font-weight: bold; margin-left: 5px;">Sair</a>
            </div>
        <?php endif; ?>
    </header>
    
    <main>