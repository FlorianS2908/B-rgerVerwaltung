<!DOCTYPE html>
<html>
<?php
$salz = random_bytes(16); // 16 Byte Salz
$salz_hex = bin2hex($salz); // Salz in hexadezimaler Darstellung konvertieren
var_dump($salz_hex);
$hash = password_hash("Hallo" . $salz, PASSWORD_DEFAULT);
var_dump($hash);
require "../controller/db_dataLoad.php";
//createDatapool();
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Setzen der Session-Variablen
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
        // query mittels Username + Password => daraus die Pers_ID aus deer DB
        // in die Session die Daten der Person die eingeloggt hat speichern

        header("Location: index.php");
        exit();
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
    if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
        include "main.php";
        if (isUserOnDB()) {
            generateLoginJson();
        }
    } else {
        include "loginPage.php";
    }
    ?>
    <?php
    require "footer.php";
    ?>

</body>

</html>