<?php

// MySQL-Verbindungsdaten

$daten = file_get_contents("db_con.json", true);
$data = json_decode($daten, true);
$servername = $data[0]["servername"]; // Hostname (üblicherweise "localhost" auf demselben Server)
$username = $data[0]["username"]; // Ihr MySQL-Benutzername
$password = $data[0]["password"]; // Ihr MySQL-Passwort
$database = $data[0]["database"]; // Der Name Ihrer MySQL-Datenbank
// Verbindung zur MySQL-Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $database);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung zur MySQL-Datenbank fehlgeschlagen: " . $conn->connect_error);
}

// Optional: Zeichensatz für die Verbindung festlegen
$conn->set_charset("utf8");
