<?php
session_start();

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
</head>
<body>

    <h1>Profil</h1>
    <p>Bonjour <?= $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'] ?></p>
    <p>Votre email est <?= $_SESSION['user_email'] ?></p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>