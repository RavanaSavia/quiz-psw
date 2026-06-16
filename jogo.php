<?php
// Inclui o cabeçalho global do sistema
require_once 'includes/header.php';

// CONTROLE DE ACESSO: Só joga quem estiver logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// 1. CAPTURA A MATÉRIA: Pega o nome da matéria enviado pela URL (?materia=...)
$materia = $_GET['materia'] ?? 'gerais';
$caminho_perguntas = __DIR__ . "/data/{$materia}.json";

// 2. LEITURA DO ARQUIVO: Corrigido para verificar se as perguntas existem!
$perguntas = [];
if (file_exists($caminho_perguntas)) {
    $perguntas = json_decode(file_get_contents($caminho_perguntas), true) ?? [];
}

// Se não houver perguntas cadastradas para essa matéria
if (empty($perguntas)) {
    echo "<div class='container' style='text-align:center; padding: 40px;'><p>⚠️ Nenhuma pergunta encontrada para a matéria: <strong>" . htmlspecialchars($materia) . "</strong>.</p><p style='margin-top: 15px;'><a href='painel.php' class='btn' style='text-decoration:none;'>Voltar ao Painel</a></p></div>";
    require_once 'includes/footer.php';
    exit;
}

// 3. LÓGICA DE CORREÇÃO (Processa quando o usuário envia as respostas)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respostas_usuario = $_POST['respostas'] ?? [];
    $pontos_finais = 0;

    // Confere cada resposta enviada com o gabarito do JSON
    foreach ($perguntas as $index => $pergunta) {
        $id_pergunta = $pergunta['id'];
        if (isset($respostas_usuario[$id_pergunta]) && $respostas_usuario[$id_pergunta] === $pergunta['correta']) {
            $pontos_finais += 10;
        }
    }

    // Exibe a tela de fim de jogo
    ?>
    <div class="container" style="text-align: center;">
        <h2>🎉 Fim de Jogo!</h2>
        <p style="font-size: 18px; margin-top: 10px;">Você terminou o Quiz de <strong><?= ucfirst($materia) ?></strong>.</p>
        
        <div style="background-color: #f1f2f6; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <span style="font-size: 16px; color: #747d8c;">Sua Pontuação nesta rodada:</span>
            <h1 style="font-size: 48px; color: #4a69bd; margin-top: 5px;"><?= $pontos_finais ?> Pontos</h1>
        </div>

        <form action="controllers/proc_dados.php" method="POST">
            <input type="hidden" name="points" value="<?= $pontos_finais ?>">
            <button type="submit" class="btn">💾 Salvar Pontuação no Ranking</button>
        </form>
    </div>
    <?php
    require_once 'includes/footer.php';
    exit;
}

// 4. EXIBIÇÃO DO FORMULÁRIO DO QUIZ
?>
<div class="container" style="max-width: 700px;">
    <h2 style="text-align: center; margin-bottom: 5px;">📝 Quiz: <?= ucfirst($materia) ?></h2>
    <p style="text-align: center; color: #747d8c; margin-bottom: 30px;">Responda com atenção! Cada acerto vale 10 pontos.</p>

    <form method="POST" action="">
        <?php foreach ($perguntas as $num => $pergunta): ?>
            <div style="background-color: #f1f2f6; padding: 20px; border-radius: 8px; margin-bottom: 25px; border-left: 5px solid #4a69bd;">
                <p style="font-size: 16px; font-weight: bold; color: #2f3640; margin-bottom: 15px;">
                    <?= ($num + 1) ?>. <?= htmlspecialchars($pergunta['pergunta']) ?>
                </p>
                
                <?php foreach ($pergunta['alternativas'] as $letra => $texto): ?>
                    <label style="display: block; padding: 10px; background-color: white; margin-bottom: 8px; border-radius: 5px; cursor: pointer; border: 1px solid #dfe4ea; text-align: left;">
                        <input type="radio" name="respostas[<?= $pergunta['id'] ?>]" value="<?= $letra ?>" required style="margin-right: 10px;">
                        <strong><?= $letra ?>)</strong> <?= htmlspecialchars($texto) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn" style="width: 100%; padding: 15px; font-size: 16px;">Finalizar e Ver Pontos 🚀</button>
    </form>
</div>

<?php
require_once 'includes/footer.php';
?>