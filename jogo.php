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

// 2. LEITURA DO ARQUIVO: Verifica se as perguntas existem
$perguntas = [];
if (file_exists($caminho_perguntas)) {
    $perguntas = json_decode(file_get_contents($caminho_perguntas), true) ?? [];
}

// Se não houver perguntas cadastradas para essa matéria
if (empty($perguntas)) {
    echo "<div class='container' style='text-align:center; padding: 40px;'><p>⚠️ Nenhuma pergunta encontrada.</p></div>";
    require_once 'includes/footer.php';
    exit;
}

// 3. LÓGICA DE CORREÇÃO DETALHADA (Quando o usuário envia o formulário)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respostas_usuario = $_POST['respostas'] ?? [];
    $pontos_finais = 0;
    ?>

    <div class="container" style="max-width: 700px;">
        <h2 style="text-align: center; margin-bottom: 10px;">📊 Correção do seu Quiz</h2>
        <p style="text-align: center; color: #747d8c; margin-bottom: 30px;">Veja abaixo onde você acertou e onde errou.</p>

        <?php 
        foreach ($perguntas as $num => $pergunta): 
            $id_pergunta = $pergunta['id'];
            $resposta_marcada = $respostas_usuario[$id_pergunta] ?? 'Nenhuma';
            $resposta_correta = $pergunta['correta'];
            
            // Verifica se o aluno acertou ou errou a questão
            $acertou = ($resposta_marcada === $resposta_correta);
            
            if ($acertou) {
                $pontos_finais += 10;
                $cor_borda = "#1dd1a1"; // Verde
                $status = "🟢 Você acertou!";
            } else {
                $cor_borda = "#ff6b6b"; // Vermelho
                $status = "🔴 Você errou!";
            }
        ?>
            <div style="background-color: #f1f2f6; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid <?= $cor_borda ?>;">
                <p style="font-size: 15px; font-weight: bold; margin-bottom: 10px;">
                    <?= ($num + 1) ?>. <?= htmlspecialchars($pergunta['pergunta']) ?>
                </p>
                
                <p style="font-size: 14px; margin: 5px 0;">
                    <strong>Sua resposta:</strong> 
                    <span style="color: <?= $acertou ? '#10ac84' : '#ee5253' ?>; font-weight: bold;">
                        <?= $resposta_marcada ?>) <?= htmlspecialchars($pergunta['alternativas'][$resposta_marcada] ?? 'Não respondida') ?>
                    </span>
                </p>

                <?php if (!$acertou): ?>
                    <p style="font-size: 14px; margin: 5px 0; color: #222f3e;">
                        <strong>💡 Resposta correta:</strong> 
                        <span style="font-weight: bold; color: #10ac84;">
                            <?= $resposta_correta ?>) <?= htmlspecialchars($pergunta['alternativas'][$resposta_correta]) ?>
                        </span>
                    </p>
                <?php endif; ?>

                <span style="display: inline-block; margin-top: 8px; font-size: 12px; font-weight: bold;"><?= $status ?></span>
            </div>
        <?php endforeach; ?>

        <div style="background-color: #2f3640; color: white; padding: 25px; border-radius: 10px; text-align: center; margin-top: 30px;">
            <span style="font-size: 16px; color: #a4b0be;">Pontuação Total Conquistada:</span>
            <h1 style="font-size: 50px; color: #f1c40f; margin: 10px 0;"><?= $pontos_finais ?> Pontos</h1>

            <form action="controllers/proc_dados.php" method="POST" style="margin-top: 15px;">
                <input type="hidden" name="pontos" value="<?= $pontos_finais ?>">
                <button type="submit" class="btn" style="background-color: #1dd1a1; width: 100%;">💾 Gravar esses pontos no Ranking</button>
            </form>
        </div>
    </div>

    <?php
    require_once 'includes/footer.php';
    exit;
}

// 4. EXIBIÇÃO DO FORMULÁRIO DO QUIZ (Quando entra na página para responder)
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