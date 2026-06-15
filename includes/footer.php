<?php
// ============================================================================
// VALIDAÇÃO E BOAS PRÁTICAS DE SEGURANÇA: Bloqueia o acesso direto a este arquivo.
// Se a constante 'ACESSO_PERMITIDO' não estiver definida (tentativa de acessar o link do footer direto),
// chuta o invasor de volta para a tela de login por segurança.
// ============================================================================
if (!defined('ACESSO_PERMITIDO')) {
    header("Location: ../login.php");
    exit;
}
?>
    </main> <footer class="rodape">
        <div class="conteudo-rodape">
             <p><strong>Quiz Interativo</strong> - Trabalho de Programação de Sistemas para Web I</p>
             <p>Curso Técnico em Informática para Internet - 2º Ano</p>
             <p>Desenvolvido conforme requisitos: Sessões, Arquivos, Formulários e Validação</p>
             
             <p><?= date('Y') ?> - Todos os direitos reservados</p>
        </div>
    </footer>

</body>
</html>