<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nachrichtenformular</title>
    <link rel="stylesheet" href="../view/style/artikel.css">
    <link rel="stylesheet" href="../view/style/burgerMenü.css">
    <link rel="stylesheet" href="../view/style/navigation.css">
    <link rel="stylesheet" href="../view/style/header.css">
    <link rel="stylesheet" href="../view/style/footer.css">
    <style>
        /* Stil für das Popup-Fenster */
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Hintergrund halbtransparent */
            z-index: 9999;
            /* Z-Index über allem anderen Inhalt */
            overflow: auto;
            /* Scrollen ermöglichen, wenn der Inhalt zu groß ist */
        }

        .popup-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <h1>Nachrichtenformular</h1>
    </header>

    <?php require "navi.php"; ?>

    <?php require_once ("burgerMenü.php"); ?>

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
        $data = json_decode($json_data, true);

        // Filterung der Artikel basierend auf dem POST-Parameter
        if (isset ($_POST['filter'])) {
            $filter = $_POST['filter'];
            $filtered_art = array();

            if ($filter === 'week') {
                // Filter für Artikel der letzten Woche
                foreach ($data as $art) {
                    if (strtotime($art['Datum']) >= strtotime('-1 week')) {
                        $filtered_art[] = $art;
                    }
                }
            } elseif ($filter === 'month') {
                // Filter für Artikel des letzten Monats
                foreach ($data as $art) {
                    if (strtotime($art['Datum']) >= strtotime('-1 month')) {
                        $filtered_art[] = $art;
                    }
                }
            } else {
                // Kein Filter angewendet
                $filtered_art = $data;
            }

            // Verwende die gefilterten Artikel für die Anzeige
            $data = $filtered_art;
        }

        foreach ($data as $art) {
            // Wenn Daten vorhanden sind
            if (!empty ($data)) {
                // Das erste Bild auswählen
                $datum = $art['Datum'];
                $titel = $art['Titel'];
                $imageData = $art['Bild'];
                $imageDescription = $art['ArtikelText'];
                $artText = $art['ArtikelText'];

                // Artikelcontainer mit Link
                echo "<div class='article'>";
                // Artikelinhalt
                echo "<div class='article-details'>";
                echo "<p class='article-date'>$datum</p>";
                echo "<h2>$titel</h2>";
                echo "<div class='article-thumbnail'>";
                echo "<img src='data:image/jpeg;base64,{$imageData}' alt='{$imageDescription}'>";
                echo "</div>";
                echo "<p>$artText</p>";
                echo "<button onclick='openPopup(\"$titel\", \"$datum\", \"$artText\", \"$imageData\", \"$imageDescription\")'>Weiterlesen</button>"; // Button zum Öffnen des Artikels im Popup
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
    </section>

    <!-- Popup-Fenster -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2 id="popup-title"></h2>
            <p id="popup-date"></p>
            <div id="popup-image"></div>
            <p id="popup-text"></p>
        </div>
    </div>

    <script>
        // JavaScript-Funktion zum Öffnen des Popup-Fensters mit Artikelinhalt
        function openPopup(title, date, text, imageData, imageDescription) {
            var popup = document.getElementById("popup");
            var titleElement = document.getElementById("popup-title");
            var dateElement = document.getElementById("popup-date");
            var textElement = document.getElementById("popup-text");
            var imageElement = document.getElementById("popup-image");

            titleElement.textContent = title;
            dateElement.textContent = date;
            textElement.textContent = text;

            // Bild einfügen
            var img = new Image();
            img.src = 'data:image/jpeg;base64,' + imageData;
            img.alt = imageDescription;
            imageElement.innerHTML = '';
            imageElement.appendChild(img);

            popup.style.display = "block"; // Popup-Fenster anzeigen
        }

        // JavaScript-Funktion zum Schließen des Popup-Fensters
        function closePopup() {
            var popup = document.getElementById("popup");
            popup.style.display = "none"; // Popup-Fenster ausblenden
        }
    </script>

    <?php require_once 'footer.php'; ?>
</body>

</html>