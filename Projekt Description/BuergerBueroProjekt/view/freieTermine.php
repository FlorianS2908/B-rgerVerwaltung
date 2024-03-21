<?php
//$datum = '';
$datum = date('2024-03-23');
// Check if the newDate parameter is received
//if (isset($_POST['newDate'])) {
// Retrieve the new date from the POST data
//    $datum = date($_POST['newDate']);
//    echo 'Vorhanden';
//} else {
//    echo 'nicht vorhanden';
//}

//var_dump($datum);

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

// Funktion zum Ermitteln der freien Termine für ein bestimmtes Datum
function findeFreieTermine($datum, $terminData)
{
    // Funktion zum Sammeln aller vergebenen Zeitslots für das Datum
    function sammleVergebeneZeitslots($datum, $terminData)
    {
        $vergebeneZeitslots = array();
        foreach ($terminData as $termin) {
            if ($datum == date('Y-m-d', strtotime($termin['Termin']))) {
                $vergebeneZeitslots[] = date('H:i', strtotime($termin['Startzeitpunkt']));
            }
        }
        return $vergebeneZeitslots;
    }

    // Alle vergebenen Zeitslots für das Datum sammeln
    $vergebeneTermine = sammleVergebeneZeitslots($datum, $terminData);

    //verfügbare Zeitslots
    $verfuegbareZeitslots = array('8:00', '8:30', '9:00', '9:30', '10:00', '10:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30');

    // Entferne vergebene Zeitslots aus den verfügbaren Zeitslots
    $freieTermine = array_diff($verfuegbareZeitslots, $vergebeneTermine);

    return $freieTermine;
}

// Laden der Daten aus der JSON-Datei
$terminData = json_decode(file_get_contents("../model/TerminMockup.json"), true);

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