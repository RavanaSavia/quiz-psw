<?php
// ============================================================================
// CONTROLLER DE CADASTRO
// Recebe os dados do formulário de registro e envia para a função de salvamento.
// ============================================================================

// 1. Importa as funções principais do sistema
require_once '../includes/funcoes.php';

// 2. Verifica se os dados vieram de forma segura via método POST do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 3. Sanitização básica: recebe os dados e remove espaços em branco extras
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    // 4. Chama a função de cadastrar que criamos no funcoes.php
    // Essa função vai adicionar o usuário no data/usuarios.json e redirecionar
    cadastrar_usuario($usuario, $senha);
    
} else {
    // 5. Segurança: Se alguém tentar acessar esse arquivo direto pelo link, 
    // é redirecionado de volta para a tela de cadastro
    header('Location: ../cadastro.php');
    exit;
}
?>