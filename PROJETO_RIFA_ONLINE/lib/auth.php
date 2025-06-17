<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        http_response_code(401);
        echo json_encode(["error" => "Usuário não autenticado"]);
        exit;
    }
}

function loginUser($user_id) {
    $_SESSION['user_id'] = $user_id;
}

function logoutUser() {
    session_destroy();
}
?>
