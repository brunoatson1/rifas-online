<?php
// Configura conexão MySQL
$host = "localhost";
$db_name = "SEU_BANCO";
$username = "SEU_USUARIO";
$password = "SUA_SENHA";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
