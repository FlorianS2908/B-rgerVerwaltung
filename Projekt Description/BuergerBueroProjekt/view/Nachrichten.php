<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nachrichtenformular</title>
    <link rel="stylesheet" href="style/artikel.css">
</head>

<body>
    <?php
    require_once ("burgerMenü.php");
    ?>
    <header>
        <h1>Nachrichtenformular</h1>
    </header>

    <section class="filter-bar">
        <form method="post">
            <button type="submit" name="filter" value="week">Last Week</button>
            <button type="submit" name="filter" value="month">Last Month</button>
            <button type="submit" name="filter" value="all">All</button>
        </form>
    </section>

    <section class="articles">
        <?php
        $json_file_path = '../controller/query_result_Artikel.json';

        // JSON-Datei lesen
        $json_data = file_get_contents($json_file_path);

        // JSON-Daten dekodieren
        $data = json_decode($json_data, true); // Das zweite Argument "true" gibt an, dass ein assoziatives Array verwendet werden soll
        
        // Filterung der Artikel basierend auf dem POST-Parameter
        if (isset ($_POST['filter'])) {
            $filter = $_POST['filter'];
            $filtered_articles = array();

            if ($filter === 'week') {
                // Filter für Artikel der letzten Woche
                foreach ($data as $article) {
                    if (strtotime($article['Datum']) >= strtotime('-1 week')) {
                        $filtered_articles[] = $article;
                    }
                }
            } elseif ($filter === 'month') {
                // Filter für Artikel des letzten Monats
                foreach ($data as $article) {
                    if (strtotime($article['Datum']) >= strtotime('-1 month')) {
                        $filtered_articles[] = $article;
                    }
                }
            } else {
                // Kein Filter angewendet
                $filtered_articles = $data;
            }

            // Verwende die gefilterten Artikel für die Anzeige
            $data = $filtered_articles;
        }

        foreach ($data as $art) {
            //var_dump($art);
            // Wenn Daten vorhanden sind
            if (!empty ($data)) {
                // Das erste Bild auswählen
                $datum = $art['Datum'];
                $titel = $art['Titel'];
                $imageData = $art['Bild'];
                $imageDescription = $art['ArtikelText'];
                $artText = $art['ArtikelText'];


                // Das Bild als Base64-codierte Zeichenfolge in das img-Tag einfügen
                //echo $titel;
                //echo $datum;
                //echo $artText;
                //echo "<img src='data:image/jpeg;base64,{$imageData}' alt='{$imageDescription}'>";

                // Artikelcontainer
                //
                echo "<div class='article'>";
                // Artikelinhalt
                echo "<div class='article-details'>";
                echo "<p class='article-date'>$datum</p>";
                echo "<h2>$titel</h2>";
                echo "<div class='article-thumbnail'>";
                echo "<img src='data:image/jpeg;base64,{$imageData}' alt='{$imageDescription}'>";
                echo "</div>";
                echo "<p>$artText</p>";
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
    </section>
</body>

<?php
require_once 'footer.php';
?>

</html>