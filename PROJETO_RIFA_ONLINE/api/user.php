<?php
header("Content-Type: application/json");
require_once "../config/database.php";
require_once "../lib/auth.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $action = $_GET['action'] ?? '';

    if ($action === 'login') {
        $email = $data['email'] ?? '';
        $senha = $data['senha'] ?? '';

        // Buscar usuário
        $stmt = $pdo->prepare("SELECT * FROM users_company WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['password'])) {
            loginUser($user['id']);
            echo json_encode(["message" => "Login realizado", "user" => $user]);
        } else {
            http_response_code(401);
            echo json_encode(["error" => "Email ou senha inválidos"]);
        }
    } elseif ($action === 'logout') {
        logoutUser();
        echo json_encode(["message" => "Logout realizado"]);
    } elseif ($action === 'register') {
        $email = $data['email'] ?? '';
        $senha = password_hash($data['senha'] ?? '', PASSWORD_DEFAULT);
        $nome = $data['nome'] ?? '';

        // Inserir usuário
        $stmt = $pdo->prepare("INSERT INTO users_company (email, password, nome) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$email, $senha, $nome]);
            echo json_encode(["message" => "Usuário cadastrado"]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao cadastrar usuário"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Ação inválida"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido"]);
}
?>

