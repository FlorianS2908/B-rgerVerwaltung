<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Seite</title>
    <link rel="stylesheet" href="../view/style/artikel.css">
    <link rel="stylesheet" href="../view/style/burgerMenü.css">
    <link rel="stylesheet" href="../view/style/navigation.css">
    <link rel="stylesheet" href="../view/style/header.css">
    <link rel="stylesheet" href="../view/style/footer.css">
</head>

<body>
    <?php
    // Verwenden Sie den Titel des Artikels aus dem GET-Parameter, um den entsprechenden Artikel zu finden
    $requested_title = $_GET['Titel']; // Titel des angeforderten Artikels
    $json_file_path = '../model/ArtikelMockup.json';

    // JSON-Datei lesen
    $json_data = file_get_contents($json_file_path);

    // JSON-Daten dekodieren
    $data_array = json_decode($json_data, true); // Das zweite Argument "true" gibt an, dass ein assoziatives Array verwendet werden soll
    
    // Finden Sie den Artikel mit dem angeforderten Titel
    $requested_article = null;
    foreach ($data_array as $article) {
        if ($article['Titel'] === $requested_title) {
            $requested_article = $article;
            break; // Artikel gefunden, Schleife beenden
        }
    }

    // Überprüfen, ob der Artikel gefunden wurde
    if ($requested_article) {
        // Artikel gefunden, anzeigen
        echo '<article>';
        echo '<div class="article-details">';
        echo '<p class="article-date">' . $requested_article['Datum'] . '</p>';
        echo '<h2>' . $requested_article['Titel'] . '</h2>';
        echo '<div class="article-thumbnail">';
        echo '<img src="' . $requested_article['Bild'] . '" alt="Bild">';
        echo '</div>';
        echo '<p>' . $requested_article['ArtikelText'] . '</p>';
        echo '</div>';
        echo '</article>';
    } else {
        // Artikel nicht gefunden, Fehlermeldung anzeigen
        echo '<p>Artikel nicht gefunden.</p>';
    }
    ?>
</body>

</html>