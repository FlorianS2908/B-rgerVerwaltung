<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminvereinbarung</title>
    <link rel="stylesheet" href="../style/termine.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Terminvereinbarung</h1>
        </div>
        <div class="main">
            <?php
            $json_file_path = '../model/TerminMockup.json';

            // JSON-Datei lesen
            $json_data = file_get_contents($json_file_path);

            // JSON-Daten dekodieren
            $data_array = json_decode($json_data, true); // Das zweite Argument "true" gibt an, dass ein assoziatives Array verwendet werden soll
            $group = array();
            foreach ($data_array as $elm) {
                array_push($group, $elm["Gruppe"]);
            }
            $group = array_unique($group, SORT_STRING);
            ?>
            <form>
                <label for="dienstleistung">Dienstleistung:</label>
                <select id="dienstleistung">
                    <?php
                    foreach ($group as $elm) {
                        echo "<option value=\$elm\"> $elm</option>";
                    }
                    ?>

                </select>
                <br>
                <br>

                <label>Wochentage:</label>
                <br>
                <input type="checkbox" id="montag" name="wochentage" value="montag">
                <label for="montag">Montag</label>
                <input type="checkbox" id="dienstag" name="wochentage" value="dienstag">
                <label for="dienstag">Dienstag</label>
                <input type="checkbox" id="mittwoch" name="wochentage" value="mittwoch">
                <label for="mittwoch">Mittwoch</label>
                <input type="checkbox" id="donnerstag" name="wochentage" value="donnerstag">
                <label for="donnerstag">Donnerstag</label>
                <input type="checkbox" id="freitag" name="wochentage" value="freitag">
                <label for="freitag">Freitag</label>
                <br>
                <br>

                <label>Zeitfenster:</label>
                <br>
                <input type="checkbox" id="vormittags" name="zeitfenster" value="vormittags">
                <label for="vormittags">Vormittags</label>
                <input type="checkbox" id="nachmittags" name="zeitfenster" value="nachmittags">
                <label for="nachmittags">Nachmittags</label>
                <br>
                <br>

                <input type="submit" value="Termin suchen">
            </form>
            <br>

            <h2>Datum</h2>
            <!-- Hier wird der Kalender eingefügt -->
            <br>
            <br> <br>

            <?php
            // Datum überprüfen
            function istVergeben($datum, $terminData)
            {
                foreach ($terminData as $termin) {
                    if (
                        $datum == date('Y-m-d', strtotime($termin['Termin'])) ||
                        $datum == date('Y-m-d', strtotime($termin['FeiertagsDatum'])) ||
                        $datum == date('Y-m-d', strtotime($termin['Urlaub']))
                    ) {
                        return true;
                    }
                }
                return false;
            }

            // Ermittlung freier Termine
            function findeFreieTermine($datum, $terminData)
            {
                $freieTermine = array();

                // Tage für ein Jahr überprüfen
                for ($i = 0; $i < 365; $i++) {
                    $currentDate = date('Y-m-d', strtotime($datum . " +$i day"));
                    if (!istVergeben($currentDate, $terminData)) {
                        $freieTermine[] = $currentDate;
                    }
                }
                return $freieTermine;
            }

            // Laden der Daten aus der JSON-Datei
            $terminData = json_decode(file_get_contents("../model/TerminMockup.json"), true);
            // Datumeingabe --> Aus dem Kalender
            // $datum = input???;
            $datum = readline("Geben Sie das Datum ein (YYYY-MM-DD): ");

            // Ermittlung freier Termine für das eingegebene Datum
            $freieTermine = findeFreieTermine($datum, $terminData);
            ?>

            <!-- Dropdown-Menü für die freien Termine -->
            <label for="freie-termine">Freie Termine:</label>
            <select id="freie-termine">
                <?php
                // Ausgabe der freien Termine als Dropdown-Optionen
                foreach ($freieTermine as $index => $freierTermin) {
                    echo "<option value=\"termin$index\">Termin " . ($index + 1) . ": $freierTermin</option>";
                }
                ?>
            </select>
            <br><br>

            <input type="button" value="Termin buchen">
        </div>
        <div class="footer">
            <br>
            <p>Kontaktinformationen</p>
        </div>
</body>

</html>