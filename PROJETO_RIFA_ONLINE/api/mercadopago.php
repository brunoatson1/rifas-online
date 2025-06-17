<?php
header("Content-Type: application/json");
require_once "../lib/mercadopago.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $valor = $data['valor'] ?? 0;
    $descricao = $data['descricao'] ?? '';
    $email = $data['email'] ?? '';

    $payment = criarPagamento($valor, $descricao, $email);

    if ($payment->status === 'pending') {
        echo json_encode([
            "message" => "Pagamento criado com sucesso",
            "status" => $payment->status,
            "qr_code" => $payment->point_of_interaction->transaction_data->qr_code_base64,
            "pix_key" => $payment->point_of_interaction->transaction_data->qr_code
        ]);
    } else {
        echo json_encode([
            "error" => "Pagamento não criado",
            "status" => $payment->status
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido"]);
}
?>


