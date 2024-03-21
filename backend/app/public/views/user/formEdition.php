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
    <script src="javaScript/edition.js"></script>
    <title>Formulaire d'édition</title>
</head>
<body>
    <h1>Formulaire d'édition</h1>
    <form action="" method="post" id="edition-form">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="firstName">Prénom</label>
            <input type="text" id="firstName" name="firstName" >
        </div>
        <div>
            <label for="lastName">Nom</label>
            <input type="text" id="lastName" name="lastName" >
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <label for="passwordConfirm">Confirmer le mot de passe</label>
            <input type="password" id="passwordConfirm" name="passwordConfirm">
        </div>
        <div>
            <input type="submit" value="Modifier">
        </div>
    </form>
    <p id="error_message-edition"></p>
    <br>
    <a href="profile.php">Annuler</a>
</body>
</html>