<?php
// ============================================================================
// REQUISITO DE SESSÕES: Garante que a sessão seja iniciada com segurança.
// Se nenhuma sessão estiver ativa no servidor, inicializa uma nova session_start().
// ============================================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define uma constante de segurança para autorizar o carregamento dos arquivos filhos (como o footer)
define('ACESSO_PERMITIDO', true);

// REQUISITO DE ORGANIZAÇÃO: Puxa o arquivo global de funções utilizando a constante mágica __DIR__.
// Isso garante que o caminho absoluto seja exato, independente de qual pasta chame este cabeçalho.
require_once __DIR__ . '/funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Interativo</title>
    
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>

    <header class="cabecalho">
        <h1>📚 Quiz de Conhecimentos</h1>
        
        <?php 
        // CONTROLE DE ACESSO VIA SESSÃO: Se a variável $_SESSION['usuario'] estiver preenchida,
        // significa que o jogador está logado. Logo, exibe a barra de status personalizada.
        if (isset($_SESSION['usuario'])): 
        ?>
            <div class="usuario-logado">
                Olá, <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong> |
                
                Pontos: <?= $_SESSION['pontos'] ?? 0 ?> |
                
                <a href="logout.php" class="link-sair">Sair</a>
            </div>
        <?php endif; // Fim da verificação do usuário logado ?>
    </header>
    
    <main>