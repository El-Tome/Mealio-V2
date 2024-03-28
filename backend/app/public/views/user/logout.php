<?php
use class\Users;

require_once __DIR__ . '/../class/Users.php';

$info = new Users("", "", "", "", "");
$info->unsetSession();
header('Content-Type: application/json');
echo json_encode(['success' => true]);