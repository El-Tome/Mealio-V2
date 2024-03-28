<?php
use class\Users;

require_once __DIR__ . '/../class/Users.php';

$info = new Users("", "", "", "", "");


header('Content-Type: application/json');

echo json_encode($info->getUserInfo());




