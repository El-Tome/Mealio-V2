<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="javaScript/connection.js"></script>
    <title>Connection</title>
</head>
<body>
<h1>Connection</h1>
<form action="" method="post" id="connection-form">
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <input type="submit" value="Se connecter">
    </div>
    <p id="error_message-connection"></p>
</form>
<a href="/inscription">Pas encore inscrit ? Inscrivez-vous</a>
</body>
</html>