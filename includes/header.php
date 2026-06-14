<?php
session_start();
define('ACESSO_PERMITIDO', true);
require_once 'funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Interativo</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
     <div class="container">
         <header class="cabecalho">
            <h1>📚 Quiz de Conhecimentos</h1>
            <?php if (isset($_SESSION['usuario'])): ?>
                   <div class="usuario-logado">
                    Olá, <strong><?= htmlspecialchars($_SESSION['usuario']) ?>
                    </strong> |
                                Pontos: <?= $_SESSION['pontos'] ?? 0 ?> |
                                <a href="logout.php" class="link-sair">Sair</a>
                                </div>
                                <?php endif; ?>
                                </header>
                                <main>

