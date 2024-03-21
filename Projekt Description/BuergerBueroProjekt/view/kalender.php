<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/kalender.css" />

    <?php
    $termine = file_get_contents("../model/TerminMockup.json");
    $test = json_decode($termine, true);
    ?>

</head>

<body>
    <div id="cal">
        <div class="header">
            <span class="left button" id="prev"> &lang; </span>
            <span class="month-year" id="label"> </span>
            <span class="right button" id="next"> &rang; </span>
        </div>
        <table id="days">
            <tr>
                <td>So</td>
                <td>Mo</td>
                <td>Di</td>
                <td>Mi</td>
                <td>Do</td>
                <td>Fr</td>
                <td>Sa</td>

            </tr>
        </table>
        <div id="cal-frame">
            <!-- Calendar will be dynamically generated here -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripte/kalender.js"></script>
    <script>
        $(document).ready(function() {
            var cal = CALENDAR();
            cal.init("#cal");
        });
    </script>
    <style>
        #datum {
            display: block;
            text-align: center;
        }
    </style>
    <Label id='datum'>Ausgewähltes Datum</Label>


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
        foreach ($terminData as $termin) {
            // Überprüfen, ob der Termin an diesem Datum vergeben ist
            if ($datum == date('Y-m-d', strtotime($termin['Termin']))) {
                // Wenn nicht, füge den Termin zur Liste der freien Termine hinzu
                $freieTermine[] = date('H:i', strtotime($termin['Termin']));
            }
        }

        return $freieTermine;
    }

    // Laden der Daten aus der JSON-Datei
    $terminData = json_decode(file_get_contents("../model/TerminMockup.json"), true);

    // Ausgewähltes Datum
    $datum = date('2024-03-23'); // Anpassen Eingabe durch Kalender

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