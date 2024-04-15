<?php

// Anlegen der Daten für die UI
function createDatapool()
{
    $conn = getDBConnection();
    require_once 'dbConnection.php';
    getPersonenDaten($conn);
    getArtikel($conn);
    getAntag_Gruppe($conn);

    $conn->close();
}

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
    $query = "SELECT ArtikelTitel As 'Titel', ArtikelDatum As 'Datum', ArtikelBild As 'Bild', ArtikelText As 'ArtikelText' From Artikel;";
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

// Eintragen der Daten bei neue Registrierung 
function registPerson()
{
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

    //Statement zum prüfen ob ein User => Vor- Nachname, Email schon in der DB vorhanden ist
    $pers_ID = getPersId($vorname, $nachname, $email);
    var_dump($pers_ID);
    // wenn ja darf er sich damit nicht mehr registrieren
    if (!empty($pers_ID)) {
?>
<script>
var error_message = "Leider ist ein Fehler Aufgetreten. Ihr Benutzername oder Email wird schon verwendet";
alert(error_message);
</script>
<?php
        return;
    } else {
        //Statement zum auslesen der Geburtsorts ID
        $gebOrt_ID = getGebOrtId($geburtsort);
        var_dump($gebOrt_ID);
        //Statement zum auslesen der Strassen ID
        $strasse_Id = getStrassenID($straße);
        var_dump($strasse_Id);
        //Statement zum auslesen der Orts ID
        $orts_Id = getOrtID($ort, $plz);
        var_dump($orts_Id);
        //Statement zum prüfen ob es diese Adresse Kombi schon gibt
        $adres_ID = getAdressId($hausnummer, $strasse_Id, $orts_Id);
        var_dump($adres_ID);
        //Statement zum einfügen der neuen Person
        $isPersonRegistered = insertPerson(
            $nachname,
            $vorname,
            $email,
            $geburtsdatum,
            $gebOrt_ID,
            $adres_ID,
            $passwort,
        );
        var_dump($isPersonRegistered);
    }
}

function getAdressId($hausnummer, $strasse_Id, $orts_Id)
{
    $query = "SELECT adressen.Adresse_ID FROM adressen WHERE adressen.Adresse_Hausnummer = ? AND 
                            adressen.Strasse_ID =  ? 
                            AND adressen.Ort_ID = ? LIMIT 1;";
    $values = array(
        $hausnummer, $strasse_Id, $orts_Id
    );
    $datatyp = 'sss';
    $adres_ID = getID_FromStatementQuery($query, $values, $datatyp, "select");
    if (empty($adres_ID)) {
        //sollte kein Datensatz gefundnen werden exsiiert die Adresse noch nicht und muss erst noch erstellt werden
        $query = "INSERT INTO adressen (Strasse_ID, Adresse_Hausnummer, Ort_ID) VALUES (?,?,?);";
        $values = array(
            $strasse_Id, $hausnummer, $orts_Id
        );
        $datatyp = 'sss';
        getID_FromStatementQuery($query, $values,  $datatyp, "insert");
        $adres_ID = getAdressId($hausnummer, $strasse_Id, $orts_Id);
    }
    return $adres_ID;
}

function getPersId($vorname, $nachname, $email)
{
    $query = "SELECT Pers_ID AS id FROM personen WHERE Pers_Name = ? AND Pers_Vorname = ? AND Pers_Email = ?;";
    $values = array(
        $vorname, $nachname, $email
    );
    $datatyp = 'sss';
    $pers_ID = getID_FromStatementQuery($query, $values, $datatyp, "select");
    return $pers_ID;
}

function getStrassenID($straße)
{
    $query = "SELECT Strasse_ID AS id FROM strassen WHERE Strasse = ? LIMIT 1;";
    $datatyp = 's';
    $values = array(
        $straße
    );
    $strasse_Id = getID_FromStatementQuery($query, $values,  $datatyp, "select");
    if (empty($strasse_Id)) {
        $query = 'INSERT INTO strassen (Strasse) VALUES (?);';
        $datatyp = 's';
        getID_FromStatementQuery($query, $values,  $datatyp, "insert");
        $strasse_Id = getStrassenID($straße);
    }
    return $strasse_Id;
}

function getOrtID($ort, $plz)
{
    $query = "SELECT Ort_ID AS id FROM orte WHERE Ort = ? AND PLZ = ?  LIMIT 1;";
    $datatyp = 'ss';
    $values = array(
        $ort, $plz
    );
    $ort_ID = getID_FromStatementQuery($query, $values,  $datatyp, "select");
    if (empty($ort_ID)) {
        $query = "INSERT INTO orte (Ort, PLZ) VALUES (? , ?);";
        getID_FromStatementQuery($query, $values,  $datatyp, "insert");
        $ort_ID = getOrtID($ort, $plz); //nach dem eintragen des neuen Ort =>ID auslesen und zurück geben
    }
    return $ort_ID;
}

function getGebOrtId($geburtsort)
{
    $query = 'SELECT Ort_ID FROM orte WHERE Ort = ? LIMIT 1;';
    $values = array($geburtsort);
    $datatyp = 's';
    $gebOrt_ID = getID_FromStatementQuery($query, $values,  $datatyp, "select");
    if (empty($gebOrt_ID)) {
        $query = 'INSERT INTO orte (Ort, PLZ) VALUES (? , ?);';
        $values = array($geburtsort, "11111");
        // Dummy Value für PLZ => normalerweise => 
        /*
    API-Schlüssel erhalten: Zuerst musst du sicherstellen, dass du über einen API-Schlüssel für die Google Maps Geocoding API 
    verfügst. Dafür musst du dich bei der Google Cloud Platform anmelden und die entsprechende API aktivieren.

    API-Anfrage senden: Mit PHP kannst du eine HTTP-Anfrage an die Geocoding-API senden und den Ort als Parameter übergeben. 
    Die API antwortet dann mit den entsprechenden Geodaten, einschließlich der Postleitzahl.

    So könnte das aussehen: 

            // Google Maps Geocoding API URL
            $api_url = "https://maps.googleapis.com/maps/api/geocode/json";

            // Ort, für den du die Postleitzahl finden möchtest
            $ort = "Berlin, Deutschland";

            // API-Schlüssel
            $api_key = "DEIN_API_SCHLUESSEL";

            // Die Anfrage zusammenstellen
            $request_url = $api_url . "?address=" . urlencode($ort) . "&key=" . $api_key;

            // Die API-Anfrage durchführen
            $response = file_get_contents($request_url);

            // Die Antwort als JSON parsen
            $data = json_decode($response);

            // Überprüfen, ob die Anfrage erfolgreich war
            if ($data->status == "OK") {
                // Die Postleitzahl extrahieren
                $plz = "";
                foreach ($data->results[0]->address_components as $component) {
                    if (in_array("postal_code", $component->types)) {
                        $plz = $component->long_name;
                        break;
                    }
                }

                if (!empty($plz)) {
                    echo "Die Postleitzahl für $ort ist: $plz";
                } else {
                    echo "Keine Postleitzahl für $ort gefunden.";
                }
            } else {
                echo "Fehler bei der API-Anfrage: " . $data->status;
            }
            */
        $datatyp = 'ss';
        $gebOrt_ID = getID_FromStatementQuery($query, $values,  $datatyp, "insert");
        $gebOrt_ID = getGebOrtId($geburtsort); //nach dem eintragen des neuen Ort =>ID auslesen und zurück geben
    }
    return $gebOrt_ID;
}

function insertPerson(
    $nachname,
    $vorname,
    $email,
    $geburtsdatum,
    $gebOrt_ID,
    $adres_ID,
    $passwort
) {
    //wenn die Adresse aus der Regist schon in der Datenbank liegt kann die Person der DB hinzugefügt werden mittels der gefundnen Adress ID
    $salz = random_bytes(16); // 16 Byte Salz
    $salz_hex = bin2hex($salz); // Salz in hexadezimaler Darstellung konvertieren
    $hash = password_hash($passwort . $salz, PASSWORD_DEFAULT);
    $query = "INSERT INTO Personen (
        Pers_Name,
        Pers_Vorname,
        Pers_Email,
        Pers_Geb_Datum,
        Pers_Geb_Ort_ID,
        Pers_Adress_ID,
        Pers_Salt,
        Pers_Password
    ) VALUES(
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?
    );";
    $values = array(
        $nachname,
        $vorname,
        $email,
        transformStringtoDateForDB($geburtsdatum),
        $gebOrt_ID,
        $adres_ID,
        $salz_hex,
        $hash
    );
    $value = getID_FromStatementQuery($query, $values, "ssssiiss", "insert");
    return $value;
}
//Liefert Id's aus der Datenbank zurück => 1 ID
function getID_FromStatementQuery($query, $values, $datatyp, $queryORinsert)
{
    var_dump($query);
    var_dump($values);
    var_dump($datatyp);
    var_dump($queryORinsert);
    $conn = getDBConnection();
    $conn->begin_transaction();
    try {
        $stat = $conn->prepare($query);
        if ($stat === false) {
            die("Fehler beim Erstellen des Prepared Statements: " . $conn->error);
        } else {
            switch ($datatyp) {
                case "s":
                    $stat->bind_param("s", ...$values);
                    break;
                case "ss":
                    $stat->bind_param("ss", ...$values);
                    break;
                case "sss":
                    $stat->bind_param("sss", ...$values);
                    break;
                case "ssss":
                    $stat->bind_param("ssss", ...$values);
                    break;
                case "ssssiiss":
                    $stat->bind_param("ssssiiss", ...$values);
                    break;
            }
        }

        if ($stat === false) {
            throw new Exception("Fehler beim Erstellen des Prepared Statements: " . $conn->error);
        }
        // Das Prepared Statement ausführen
        $stat->execute();
        // Variablen für das Ergebnis binden => entweder nur die ID oder Passwort und Salt 
        switch ($queryORinsert) {
            case "select":
                $value = "";
                $stat->bind_result($value);
                // Ergebnisse verarbeiten (nur die erste Zeile)
                $stat->fetch();
                break;
            case "isPassAndSaltSelect":
                $salt = "";
                $password = "";
                $stat->bind_result($salt, $password);
                // Ergebnisse verarbeiten (nur die erste Zeile)
                $stat->fetch();
                $value = array($salt, $password);
                break;
            case "insert":
                $value = ""; // zur Warning vermeidung default setzen
                if ($stat->affected_rows > 0) {
                    echo "Datensatz erfolgreich eingefügt.";
                } else {
                    throw new Exception("Fehler beim Einfügen des Datensatzes: " . $stat->error);
                }
                break;
        }

        // Prepared Statement schließen
        $stat->close();
        // Transaktion abschließen
        $conn->commit();
    } catch (Exception $e) {
        // Bei einem Fehler Transaktion rückgängig machen
        $conn->rollback();
        echo "Transaktion fehlgeschlagen: " . $e->getMessage();
    }
    $conn->close();
    var_dump($value);
    return $value;
}

function transformStringtoDateForDB($date)
{
    $timestamp = strtotime($date);
    $date_for_db = date("Y-m-d", $timestamp); // Konvertiere das Datum in das Datenbankformat (Jahr-Monat-Tag)
    return $date_for_db;
}

//Prüfe anhand der Eingabe => Vor + Nachname oder Email und Passwort ob dieser Creds stimmen
function isUserInDbRegist($username, $password_UserInput)
{
    $conn = getDBConnection();
    $query = "";
    $datatyp = "";
    $values = array();
    // wenn username mit Leerzeichen dann ist der Username nicht die Email => sondern Vor-Nachname 
    if (preg_match('/\s/', $username)) {
        $vor_nachName_arr = explode(" ", $username);
        $values = array($vor_nachName_arr[0], $vor_nachName_arr[1], $vor_nachName_arr[1], $vor_nachName_arr[0]);
        $query = "SELECT Pers_Salt, Pers_Password FROM personen WHERE (Pers_Name = ? AND Pers_Vorname = ?) 
        OR (Pers_Name = ? AND Pers_Vorname = ?);";
        $datatyp = 'ssss';
    } else {
        $query = "SELECT Pers_Salt, Pers_Password FROM personen WHERE Pers_Email = ?;";
        $datatyp = 's';
        $values = array($username);
    }
    $value = getID_FromStatementQuery($query, $conn, $values,  $datatyp, "isPassAndSaltSelect");
    $salt = hex2bin($value[0]);
    if (password_verify($value[1] . $salt, $password_UserInput)) {
        return true;
    }
    $conn->close();
    return false;
}

function getDBConnection()
{
    $daten = file_get_contents("db_con.json", true);
    $data = json_decode($daten, true);
    $servername = $data[0]["db_kontext"]["servername"]; // Hostname (üblicherweise "localhost" auf demselben Server)
    $username = $data[0]["db_kontext"]["username"]; // Ihr MySQL-Benutzername
    $password = $data[0]["db_kontext"]["password"]; // Ihr MySQL-Passwort
    $database = $data[0]["db_kontext"]["database"]; // Der Name Ihrer MySQL-Datenbank
    // Verbindung zur MySQL-Datenbank herstellen
    $conn = new mysqli($servername, $username, $password, $database);

    // Überprüfen, ob die Verbindung erfolgreich war
    if ($conn->connect_error) {
        die("Verbindung zur MySQL-Datenbank fehlgeschlagen: " . $conn->connect_error);
    }

    // Optional: Zeichensatz für die Verbindung festlegen
    $conn->set_charset("utf8");
    return $conn;
}