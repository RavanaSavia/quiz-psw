<?php
// O header já inicia a sessão e puxa o funcoes.php automaticamente
require_once 'includes/header.php';

// CONTROLE DE ACESSO: Se o usuário não estiver logado na sessão, expulsa para o login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<div class="container" style="max-width: 800px;">
    
    <h2 style="text-align: center; margin-bottom: 10px;">🎮 Escolha uma Categoria</h2>
    <p style="text-align: center; color: #747d8c; margin-bottom: 30px;">
        Selecione a matéria que deseja jogar hoje!
    </p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 15px; margin-bottom: 40px;">
        <a href="jogo.php?materia=gerais" class="btn" style="text-decoration: none; padding: 15px; font-size: 14px; text-align: center;">🌍 Gerais</a>
        <a href="jogo.php?materia=portugues" class="btn" style="text-decoration: none; padding: 15px; font-size: 14px; text-align: center;">📖 Português</a>
        <a href="jogo.php?materia=matematica" class="btn" style="text-decoration: none; padding: 15px; font-size: 14px; text-align: center;">🧮 Matemática</a>
        <a href="jogo.php?materia=ingles" class="btn" style="text-decoration: none; padding: 15px; font-size: 14px; text-align: center;">🗽 Inglês</a>
        <a href="jogo.php?materia=espanhol" class="btn" style="text-decoration: none; padding: 15px; font-size: 14px; text-align: center;">💃 Espanhol</a>
    </div>

    <h2 style="text-align: center; margin-bottom: 20px;">🏆 Ranking Geral</h2>
    
    <?php
    // Define o caminho absoluto para o arquivo de ranking
    $caminho_ranking = __DIR__ . '/data/ranking.json';
    $ranking = [];
    
    // Se o arquivo existir, lê os dados e converte o JSON em Array do PHP
    if (file_exists($caminho_ranking)) {
        $ranking = json_decode(file_get_contents($caminho_ranking), true) ?? [];
    }

    // Se a lista de ranking não estiver vazia, ordena e exibe
    if (!empty($ranking)):
        // LÓGICA DA SÁVIA: Ordena o array por pontos (do maior para o menor)
        usort($ranking, function ($a, $b) {
            return $b['pontos'] - $a['pontos'];
        });
    ?>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #f1f2f6; border-radius: 8px; overflow: hidden;">
            <tr style="background-color: #2f3640; color: white;">
                <th style="padding: 12px; text-align: center;">Posição</th>
                <th style="padding: 12px; text-align: left;">Jogador</th>
                <th style="padding: 12px; text-align: center;">Pontos</th>
            </tr>
            
            <?php 
            // LÓGICA DA SÁVIA: Pega apenas os 10 primeiros colocados do array para exibir
            foreach (array_slice($ranking, 0, 10) as $pos => $dados): 
            ?>
                <tr style="border-bottom: 1px solid #dfe4ea;">
                    <td style="padding: 12px; text-align: center; font-weight: bold; color: #e1b12c;"><?= $pos + 1 ?>º</td>
                    <td style="padding: 12px;"><?= htmlspecialchars($dados['usuario']) ?></td>
                    <td style="padding: 12px; text-align: center; font-weight: bold;"><?= $dados['pontos'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div style="background-color: #f1f2f6; padding: 20px; text-align: center; border-radius: 8px; color: #747d8c;">
            🎯 Nenhuma pontuação registrada ainda. Seja o primeiro a jogar!
        </div>
    <?php endif; ?>

</div>

<?php 
// Inclui o rodapé do sistema
require_once 'includes/footer.php'; 
?>