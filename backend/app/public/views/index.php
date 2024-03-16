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

<?php
// Chemin du dossier à explorer
$dossier = "./"; // Mettez le chemin approprié

// Fonction récursive pour explorer les dossiers et fichiers
function explorerDossier($dossier){
    echo "<ul>";

    // Liste des fichiers dans le dossier
    $elements = scandir($dossier);

    foreach ($elements as $element) {
        if ($element != "." && $element != "..") {
            $chemin = $dossier . '/' . $element;

            echo "<li>";

            if (is_dir($chemin)) {
                // Si c'est un dossier, explorer récursivement
                echo "<strong>$element</strong>";
                explorerDossier($chemin);
            } else {
                // Si c'est un fichier, afficher le lien
                echo "<a href=\"$chemin\">$element</a>";
            }

            echo "</li>";
        }
    }

    echo "</ul>";
}

// Appel initial pour démarrer l'exploration
explorerDossier($dossier);
?>

<?php
const DB_HOST = 'mysql';
const DB_NAME = 'mealiodb';
const DB_USER = 'admin';
const DB_PASSWORD = 'admin2024';
    try
    {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
            die("Erreur lors de la connection à la base de données . " . $e->getMessage());
    }
?>


</body>
</html>