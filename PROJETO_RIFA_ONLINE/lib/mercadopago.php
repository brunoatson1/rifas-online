<?php
require_once __DIR__ . '/../vendor/autoload.php';

MercadoPago\SDK::setAccessToken('SEU_ACCESS_TOKEN');

function criarPagamento($valor, $descricao, $email) {
    $payment = new MercadoPago\Payment();
    $payment->transaction_amount = $valor;
    $payment->description = $descricao;
    $payment->payment_method_id = "pix";
    $payment->payer = array(
        "email" => $email
    );

    $payment->save();

    return $payment;
}
?>

