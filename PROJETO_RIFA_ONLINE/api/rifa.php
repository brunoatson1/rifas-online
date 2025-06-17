<?php
header("Content-Type: application/json");
require_once "../config/database.php";
require_once "../lib/auth.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $stmt = $pdo->query("SELECT * FROM rifas");
    $rifas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rifas);
} elseif ($method === 'POST') {
    requireLogin();

    $data = json_decode(file_get_contents("php://input"), true);
    $nome = $data['nome'] ?? '';
    $descricao = $data['descricao'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO rifas (nome, descricao) VALUES (?, ?)");
    if ($stmt->execute([$nome, $descricao])) {
        echo json_encode(["message" => "Rifa criada com sucesso"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Erro ao criar rifa"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido"]);
}
?>
