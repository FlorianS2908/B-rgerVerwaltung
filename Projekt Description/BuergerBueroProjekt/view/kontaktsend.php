<?php
// Verbindung zur Datenbank herstellen
$servername = "localhost"; // oder Ihre Datenbankadresse
$username = "root"; // Ihr Datenbankbenutzername
$password = ""; // Ihr Datenbankpasswort
$dbname = "burgeramt"; // Ihr Datenbankname
 
// Verbindung herstellen
$conn = new mysqli($servername, $username, $password, $dbname);
 
// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
 
// Formulardaten abrufen
$name = $_POST['name'];
$vorname = $_POST['vorname'];
$betreff = $_POST['betreff'];
$email = $_POST['email'];
$nachricht = $_POST['nachricht'];
 
// SQL-Befehl zum Einfügen der Daten
$sql = "INSERT INTO kontaktformular (name, vorname, betreff, email, nachricht) 
        VALUES ('$name', '$vorname', '$betreff', '$email', '$nachricht')";
 
// Überprüfen, ob das Einfügen erfolgreich war
if ($conn->query($sql) === TRUE) {
    echo "Eintrag erfolgreich erstellt";
} else {
    echo "Fehler beim Erstellen des Eintrags: " . $conn->error;
}
 
// Verbindung schließen
$conn->close();
?>