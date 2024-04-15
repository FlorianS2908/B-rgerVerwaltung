<!DOCTYPE html>
<html>
<?php

require "../controller/db_dataLoad.php";
//createDatapool();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // query mittels Username + Password => daraus die Pers_ID aus deer DB
        // in die Session die Daten der Person die eingeloggt hat speichern
        if (isUserInDbRegist($_POST["username"], $_POST["password"])) {
            // Setzen der Session-Variablen
            session_start();
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
        } else {
?>
            <script>
                var error_message =
                    "Leider ist ein Fehler Aufgetreten. Die Kombination von Benutzername/Email und Passwort stimmen nicht";
                alert(error_message);
            </script>
<?php
        }
        header("Location: index.php");
        exit();
    }
    if (
        isset($_POST["nachname"]) && isset($_POST["vorname"]) && isset($_POST["geburtsort"])
        && isset($_POST["hausnummer"]) && isset($_POST["plz"]) && isset($_POST["ort"])
        && isset($_POST["geburtsdatum"]) && isset($_POST["straße"])
    ) {
        registPerson();
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/style/main.css">
    <link rel="stylesheet" href="../view/style/burgerMenü.css">
    <link rel="stylesheet" href="../view/style/navigation.css">
    <link rel="stylesheet" href="../view/style/header.css">
    <link rel="stylesheet" href="../view/style/footer.css">
    <title>Bürger Verwaltung</title>
</head>
<header>
    <h1>Willkommen im Bürgerbüro</h1>
</header>
<?php
require "navi.php";
?>


<body>
    <?php
    require "burgerMenü.php";
    ?>
    <?php
    if (isset($_SESSION['pers_ID'])) {
        include "main.php";
        // generateLoginJson();
    } else {
        // => wenn nicht eingelogged dann gewisse Funktion in der API sperren
        include "loginPage.php";
    }
    ?>
    <?php
    require "footer.php";
    ?>

</body>

</html>