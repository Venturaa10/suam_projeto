<?php
$servername = "localhost";
$username = "root"; // ou seu nome de usuário
$password = "123456"; // ou sua senha

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
echo "Conectado com sucesso!";
?>
