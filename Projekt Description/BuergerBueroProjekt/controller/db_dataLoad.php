<?php

function getDataFromDB($query, $filename, $isBlob, $conn)
{
    $result = $conn->query($query);
    if ($isBlob) {
        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $imageJson = json_encode(['image_data' => base64_encode($row['Bild'])]);
                var_dump($imageJson);
                $json_data = array(
                    "Titel" => htmlspecialchars_decode($row['Titel']),
                    "Datum" => htmlspecialchars_decode($row['Datum']),
                    "Bild" => json_encode(base64_encode($row['Bild'])),
                    "ArtikelText" => htmlspecialchars_decode($row['ArtikelText'])
                );
                array_push($rows, $json_data);
            }
            $jsonData = json_encode($rows, true);
            file_put_contents($filename, $jsonData);
        }
    } else {
        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $json_data = json_encode($rows, JSON_PRETTY_PRINT);
            file_put_contents($filename, $json_data);
        }
    }
}


function getAntag_Gruppe($conn)
{
    $query = "SELECT Gruppe As 'Gruppe', AntragsLink As 'Link' FROM anträge, gruppen WHERE anträge.Gruppe_ID = gruppen.Gruppen_ID;";
    $file_name = '../controller/query_result_Antag.json';
    getDataFromDB($query, $file_name, false, $conn);
}

function getArtikel($conn)
{
    $query = "SELECT ArtikelTitel As 'Titel', ArtikelDatum As 'Datum', ArtikelBild As 'Bild', ArtikelText As 'ArtikelText' FRom Artikel;";
    $file_name = '../controller/query_result_Artikel.json';
    getDataFromDB($query, $file_name, true, $conn);
}

function getPersonenDaten($conn)
{
    $query = "SELECT p.Pers_Name As 'Name', p.Pers_Vorname As 'Vorname',  p.Pers_Geb_Datum As 'Geb. Datum', o.Ort  As 'Geb. Ort', a.Adresse_Hausnummer As 'Hausnummer', s.Strasse As 'Strasse', o.Ort As 'Ort', o.PLZ As 'PLZ'
    From personen p
    JOIN adressen a
    ON p.Pers_Adress_ID = a.Adresse_ID
    JOIN orte o
    ON a.Ort_ID = o.Ort_ID
    JOIN personen
    ON personen.Pers_Geb_Ort_ID = o.Ort_ID
    JOIN strassen s
    ON a.Strasse_ID = s.Strasse_ID;";
    $file_name = "../controller/query_result_PersonenDaten.json";
    getDataFromDB($query, $file_name, false, $conn);
}

function isUserOnDB()
{
    var_dump($_SESSION);
    return true;
}


function createDatapool()
{
    require_once 'dbConnection.php';
    getPersonenDaten($conn);
    getArtikel($conn);
    getAntag_Gruppe($conn);

    $conn->close();
}
function registPerson()
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
    $passwort = $_POST['passwort'];

    $salz = random_bytes(16); // 16 Byte Salz
    $salz_hex = bin2hex($salz); // Salz in hexadezimaler Darstellung konvertieren


    // Das Passwort mit dem Salz hashen
    $hash = password_hash($passwort . $salz_hex, PASSWORD_DEFAULT);

    // Das verschlüsselte Passwort und das Salz in die Datenbank schreiben
    // Beispiel: Annahme, dass eine Verbindung zur Datenbank bereits hergestellt wurde

}

function generateLoginJson()
{
}
