<?php
require_once __DIR__ . '/class/userData.php';

$info = new users($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['passwordConfirm']);
