<?php
require_once __DIR__ . '/userData.php';

$info = new users($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['passwordConfirm']);
$validInfo = $info->checkDataInscript();

if ($validInfo['success']) {
    $info->insertData();
}

// indiquer au client que la réponse contient des données JSON
header('Content-Type: application/json');

echo json_encode($validInfo);