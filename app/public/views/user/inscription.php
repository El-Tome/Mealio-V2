<?php
require_once __DIR__ . '/class/userData.php';

$info = new users($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['passwordConfirm']);
