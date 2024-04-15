<?php
function test()
{
    require_once 'dbConnection.php';

    var_dump($_POST);
    $vorname = $_POST["vorname"];
    $nachname = $_POST["nachname"];
    $geburtsdatum = $_POST["geburtsdatum"];
    $geburtsort = $_POST["geburtsort"];
    $straße = $_POST["straße"];
    $hausnummer = $_POST["hausnummer"];
    $plz = $_POST["plz"];
    $ort = $_POST["ort"];
    $email = $_POST["email"];
    $passwort = $_POST['password'];

    //Statement zum auslesen der GeburtsortsID
    $query = 'SELECT Ort_ID FROM orte WHERE Ort = ? LIMIT 1;';
    $values = array($geburtsort);
    $datatyp = 's';

    $stat = $conn->prepare($query);
    $stat->bind_param("s", ...$values);

    $conn->begin_transaction();
    if ($stat->execute()) {
        // Hole das Ergebnis der Abfrage
        $result = $stat->get_result();

        // Überprüfe, ob ein Ergebnis vorhanden ist
        if ($result->num_rows > 0) {
            // Verarbeite das Ergebnis
            $row = $result->fetch_assoc();
            $ort_id = $row['Ort_ID'];

            // Commit der Transaktion
            $conn->commit();
        } else {
            // Kein Ergebnis gefunden
            // Rollback der Transaktion
            $conn->rollback();
        }
    } else {
        // Fehler beim Ausführen der Abfrage
        // Rollback der Transaktion
        $conn->rollback();
    }
}
