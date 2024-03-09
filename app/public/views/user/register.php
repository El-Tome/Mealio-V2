<?php
require_once __DIR__ . '/class/register.php';

if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['password_confirm'])) {
    $user = new registerUser($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['password_confirm']);
    
    $valid = $user->checkData();
    if ($valid === true and $user->checkEmailExist($user->getEmail()) === false)
    {
        $user->register();
        echo 'Inscription réussie';
    }
    else
    {
        echo 'Erreur lors de l\'inscription';
        if ($valid === true)
        {
            echo ' : ' . $valid;
        }
        else
        {
            echo ' : l\'adresse email est déjà utilisée';
        }
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>S'inscrire</title>
</head>
<body>
    <h1>S'inscrire</h1>
    <form action="register.php" method="post">
        <div>
            <label for="firstName">Prénom</label>
            <input type="text" id="firstName" name="firstName">
        </div>
        <div>
            <label for="lastName">Nom</label>
            <input type="text" id="lastName" name="lastName">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <label for="password_confirm">Confirmer le mot de passe</label>
            <input type="password" id="password_confirm" name="password_confirm">
        </div>
        <button type="submit">S'inscrire</button>
</body>
</html>