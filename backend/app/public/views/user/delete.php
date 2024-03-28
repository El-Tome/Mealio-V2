<?php
use class\Users;

require_once __DIR__ . '/../class/Users.php';

$user = new Users("", "", "", "", "");
$user->deleteUser();

header('Content-Type: application/json');

echo json_encode(['success' => true]);


