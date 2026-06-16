<?php
// Inicia a sessão para poder encerrá-la
session_start();

// Limpa as variáveis da sessão
session_unset();

// Destrói todos os dados da sessão (desloga o usuário)
session_destroy();

// Redireciona diretamente para a página de login (pois são vizinhos)
header("Location: login.php");
exit;
?>