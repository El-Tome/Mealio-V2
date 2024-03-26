<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="javaScript/inscription.js"></script>
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form action="" method="post" id="inscription-form">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="firstName">Prénom</label>
            <input type="text" id="firstName" name="firstName">
        </div>
        <div>
            <label for="lastName">Nom</label>
            <input type="text" id="lastName" name="lastName">
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
            <input type="submit" value="S'inscrire">
        </div>

        <p id="error_message-inscript"></p>
    </form>
    <a href="formConnection.php">Déjà inscrit ? Connectez-vous</a>
</body>
</html>