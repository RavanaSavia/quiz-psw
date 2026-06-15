<?php
// ============================================================================
// CONTROLLER DE DADOS (PONTUAÇÃO / RANKING)
// Recebe os pontos do jogo e salva no arquivo ranking.json.
// ============================================================================

session_start();

// 1. Segurança: Só permite salvar pontos se o usuário estiver logado
if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit;
}

// 2. Define o caminho do arquivo de ranking
$caminho_ranking = __DIR__ . '/../data/ranking.json';

// 3. Verifica se a pontuação foi enviada via formulário (POST) ao fim do jogo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Pega a pontuação do jogo, o nome do jogador na sessão e a data atual
    $pontos_ganhos = (int)($_POST['pontos'] ?? 0);
    $usuario_logado = $_SESSION['usuario'];
    $data_atual = date('d/m/Y H:i'); // Pega a data e hora do servidor

    // 4. Carrega o histórico de pontuações existente (Leitura)
    $ranking = [];
    if (file_exists($caminho_ranking)) {
        $conteudo = file_get_contents($caminho_ranking);
        $ranking = json_decode($conteudo, true) ?? [];
    }

    // 5. Prepara a nova jogada
    $nova_pontuacao = [
        "usuario" => $usuario_logado,
        "pontos" => $pontos_ganhos,
        "data" => $data_atual
    ];

    // Adiciona a nova jogada na lista
    $ranking[] = $nova_pontuacao;

    // 6. Salva tudo de volta no arquivo JSON (Escrita - Exigência do Professor)
    file_put_contents($caminho_ranking, json_encode($ranking, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // 7. Atualiza os pontos totais na sessão para mostrar na barrinha do cabeçalho
    $_SESSION['pontos'] = ($_SESSION['pontos'] ?? 0) + $pontos_ganhos;

    // 8. Redireciona o jogador de volta para o painel com uma mensagem de sucesso
    header('Location: ../painel.php?sucesso=1');
    exit;
    
} else {
    // Bloqueia acesso direto
    header('Location: ../painel.php');
    exit;
}
?>