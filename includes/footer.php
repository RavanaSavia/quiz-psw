<?php
// Verificação de segurança - bloqueia acesso direto
if (!defined('ACESSO_PERMITIDO')) {
    header("Location: ../login.php");
     exit;
}
?>
<!-- foi aberta no header.php -->  </main>

 <footer class="rodape">
    <div class="conteudo-rodape">
         <p><strong>Quiz Interativo</strong> - Trabalho de Programação de Sistemas para Web I</p>
         <p>Curso Técnico em Informática para Internet - 2º Ano</p>
         <p>Desenvolvido conforme requisitos: Sessões, Arquivos, Formulários e Validação</p>
         <p><?= date('Y') ?> - Todos os direitos reservados</p>
    </div>
    </footer>

      </div> <!-- Fecha o container principal -->
      </body>
      </html>