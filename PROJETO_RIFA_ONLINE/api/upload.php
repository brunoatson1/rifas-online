<?php
header("Content-Type: application/json");
require_once "../lib/auth.php";
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['arquivo'])) {
        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uploadFile = $uploadDir . basename($_FILES['arquivo']['name']);

        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadFile)) {
            echo json_encode(["message" => "Arquivo enviado com sucesso", "filename" => basename($_FILES['arquivo']['name'])]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao enviar arquivo"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Nenhum arquivo enviado"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido"]);
}
?>

