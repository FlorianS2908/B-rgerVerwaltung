<?php
$datum = '';
// Check if the newDate parameter is received
if (isset($_POST['newDate'])) {
    // Retrieve the new date from the POST data
    $datum = date($_POST['newDate']);
    echo 'Vorhanden';
} else {
    echo 'nicht vorhanden';
}
$datum = date('2024-03-23');
var_dump($datum);

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
            $freieTermine[] = date('H:i', strtotime($termin['Startzeitpunkt']));
        }
    }
    // Sortieren der freien Termine nach Uhrzeit
    usort($freieTermine, function ($a, $b) {
        return strtotime($a) - strtotime($b);
    });
    return $freieTermine;
}

// Laden der Daten aus der JSON-Datei
$terminData = json_decode(file_get_contents("../model/TerminMockup.json"), true);

// Ausgewähltes Datum
//$datum = date('2024-03-23'); // Anpassen Eingabe durch Kalender

// Ermittlung freier Termine für das eingegebene Datum
$freieTermine = findeFreieTermine($datum, $terminData);
?>
<label for="freie-termine">Freie Termine:</label>
<select id="freie-termine">
    <?php
    // Output the freie Termine as Dropdown options
    foreach ($freieTermine as $index => $freierTermin) {
        echo "<option value=\"termin$index\">Termin " . ($index + 1) . ": $freierTermin</option>";
    }
    ?>
</select>
<br><br>
<input type="button" value="Termin buchen">