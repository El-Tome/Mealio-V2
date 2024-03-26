<?php
require_once __DIR__ . '/userData.php';
session_start();

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

$firstName = $data['firstName'];
$lastName = $data['lastName'];
$email = $data['email'];
$password = $data['password'];
$passwordConfirm = $data['passwordConfirm'];

$info = new users($firstName, $lastName, $email, $password, $passwordConfirm);

$validInfo = $info->checkDataUpdate();

if ($validInfo['success']) {
    $info->updateData();
}

// indiquer au client que la réponse contient des données JSON
header('Content-Type: application/json');

echo json_encode($validInfo);