<?php
require_once __DIR__ . '/userData.php';

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

$firstName = $data['firstName'];
$lastName = $data['lastName'];
$email = $data['email'];
$password = $data['password'];
$passwordConfirm = $data['passwordConfirm'];

$info = new users($firstName, $lastName, $email, $password, $passwordConfirm);
$validInfo = $info->checkDataInscript();

if ($validInfo['success']) {
    $info->insertData();
}

// indiquer au client que la réponse contient des données JSON
header('Content-Type: application/json');

echo json_encode($validInfo);