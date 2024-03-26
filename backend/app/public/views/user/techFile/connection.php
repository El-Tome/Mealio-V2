<?php
require_once __DIR__ . '/userData.php';

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'];
$password = $data['password'];

$info = new users("", "", $email, $password, "");
$validInfo = $info->checkDataConnection();

if ($validInfo['success']) {
    $info->setSession();
    $info->updateDateConnection();
}
// indiquer au client que la réponse contient des données JSON
header('Content-Type: application/json');

echo json_encode($validInfo);
