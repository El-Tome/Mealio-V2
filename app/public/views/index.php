<!DOCTYPE html>
<html>
<head>
    <title>Page aléatoire</title>
</head>
<body>
<h1>Nombre aléatoire</h1>
<p>
    <?php
    $randomNumber = rand(1, 100);
    echo "Votre nombre aléatoire est : " . $randomNumber;
    ?>
</p>
</body>
</html>