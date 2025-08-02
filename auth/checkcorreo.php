<?php
include($_SERVER['DOCUMENT_ROOT'] . '/cass/configs/connectDB.php');
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$usuario = trim($input['usuario']);

$stmt = $conn->prepare("SELECT mail FROM usuarios WHERE mail = :mail");
$stmt->bindParam(':mail', $usuario, PDO::PARAM_STR);
$stmt->execute();

$response = ['exists' => $stmt->rowCount() > 0];

echo json_encode($response);
?>
