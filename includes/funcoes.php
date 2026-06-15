<?php
// Inicia a sessão se ainda não existir
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$CAMINHO = __DIR__ . "/../data/usuarios.json";

function carregar_arquivo() {
    global $CAMINHO;
    if (!file_exists($CAMINHO)) {
        return [];
    }
    $arquivo = file_get_contents($CAMINHO);
    return json_decode($arquivo, true) ?? [];
}

function salvar_arquivo($dados) {
    global $CAMINHO;
    if (empty($dados)) {
        return false;
    }
    file_put_contents($CAMINHO, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    return true;
}

function cadastrar_usuario($usuario, $senha) {
    if (empty($usuario) || empty($senha)) {
        return false;
    }

    $novo_usuario = [
        "usuario" => $usuario,
        "senha" => $senha,
    ];

    $usuarios = carregar_arquivo();
    $usuarios[] = $novo_usuario;

    if (salvar_arquivo($usuarios)) {
        header("Location: ../login.php");
        exit;
    } else {
        header("Location: ../cadastro.php");
        exit;
    }
}

function login($usuarioDigitado, $senhaDigitada) {
    $usuarios = carregar_arquivo();

    foreach ($usuarios as $user) {
        if ($user['usuario'] === $usuarioDigitado && $user['senha'] === $senhaDigitada) {
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['logado'] = true;
            header('Location: ../painel.php'); // Redireciona para o painel de matérias
            exit();
        }
    }
    
    $_SESSION['erro'] = "Usuário ou senha incorretos";
    header('Location: ../login.php?erro=1');
    exit();
}

function logout() {
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../login.php');
    exit;
}
?>