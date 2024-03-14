<?php
require_once __DIR__ . '/userData.php';

$info = new users("", "", $_POST['email'], $_POST['password'], "");
$validInfo = $info->checkDataConnection();

if ($validInfo['success']) {
    $info->setSession();
}
// indiquer au client que la réponse contient des données JSON
header('Content-Type: application/json');

echo json_encode($validInfo);
