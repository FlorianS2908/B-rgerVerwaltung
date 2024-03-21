<!DOCTYPE html>
<html lang="en">
<?php
// Datenbankverbindung herstellen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "burgeramt";

$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen der Verbindung
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL-Abfrage zum Abrufen des Bildes und anderer relevanter Daten
$query = "SELECT ArtikelTitel As 'Titel', ArtikelDatum As 'Datum', ArtikelBild As 'Bild', ArtikelText As 'ArtikelText' FRom Artikel;";
$result = $conn->query($query);

$data = array();

if ($result->num_rows > 0) {
    // Bild in Base64 codieren und Daten in ein Array einfügen
    while ($row = $result->fetch_assoc()) {
        $imageData = base64_encode($row['Bild']); // Bild in Base64 codieren
        unset($row['Bild']); // Entfernen der Bildspalte aus dem Array
        $row['Bild'] = $imageData; // Hinzufügen der Base64-codierten Bilddaten zum Array
        $data[] = $row;
    }
    // JSON aus dem Array erzeugen
    $json_data = json_encode($data);

    // JSON in eine Datei schreiben
    file_put_contents('query_result_Artikel.json', $json_data);
} else {
    echo "0 results";
}
$conn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Display</title>
</head>

<body>
    <h1>Image Display</h1>
    <div id="imageContainer">
        <!-- Das Bild wird hier angezeigt -->
    </div>

    <?php
    // JSON-Datei einlesen
    $jsonData = file_get_contents('query_result_Artikel.json');
    // JSON in ein PHP-Array umwandeln
    $data = json_decode($jsonData, true);

    // Wenn Daten vorhanden sind
    if (!empty($data)) {
        // Das erste Bild auswählen
        $imageData = $data[0]['Bild'];
        $imageDescription = $data[0]['ArtikelText'];

        // Das Bild als Base64-codierte Zeichenfolge in das img-Tag einfügen
        echo "<img src='data:image/jpeg;base64,{$imageData}' alt='{$imageDescription}'>";
    }
    ?>

</body>

</html>