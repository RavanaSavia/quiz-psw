<?php
// 1. Puxa as funções do arquivo que acabamos de criar
require_once '../includes/funcoes.php';

// 2. Verifica se o usuário clicou no botão do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // 3. Chama a função login() que está lá no funcoes.php
    login($usuario, $senha);
} else {
    // Se tentar acessar o controlador direto pelo link, devolve para o login
    header('Location: ../login.php');
    exit;
}
?>