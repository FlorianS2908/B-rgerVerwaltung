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
        $json_file_path = '../model/ArtikelMockup.json';

        // JSON-Datei lesen
        $json_data = file_get_contents($json_file_path);

        // JSON-Daten dekodieren
        $data_array = json_decode($json_data, true); // Das zweite Argument "true" gibt an, dass ein assoziatives Array verwendet werden soll
        
        // Filterung der Artikel basierend auf dem POST-Parameter
        if (isset ($_POST['filter'])) {
            $filter = $_POST['filter'];
            $filtered_articles = array();

            if ($filter === 'week') {
                // Filter für Artikel der letzten Woche
                foreach ($data_array as $article) {
                    if (strtotime($article['Datum']) >= strtotime('-1 week')) {
                        $filtered_articles[] = $article;
                    }
                }
            } elseif ($filter === 'month') {
                // Filter für Artikel des letzten Monats
                foreach ($data_array as $article) {
                    if (strtotime($article['Datum']) >= strtotime('-1 month')) {
                        $filtered_articles[] = $article;
                    }
                }
            } else {
                // Kein Filter angewendet
                $filtered_articles = $data_array;
            }

            // Verwende die gefilterten Artikel für die Anzeige
            $data_array = $filtered_articles;
        }

        foreach ($data_array as $article) {
            echo '<article>';
            echo '<div class="article-details">';
            echo '<p class="article-date">' . $article['Datum'] . '</p>'; // Datum hier einfügen
            echo '<h2>' . $article['Titel'] . '</h2>';
            echo '<div class="article-thumbnail">';
            echo '<img src="' . $article['Bild'] . '" alt="Bild">';
            echo '</div>';
            echo '<p>' . $article['ArtikelText'] . '</p>';
            echo '</div>';
            echo '</article>';
        }
        ?>
    </section>
</body>

<?php
require_once 'footer.php';
?>

</html>