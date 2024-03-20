<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/burgerMenü.css">
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/navigation.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/main.css">


    <title>Registrierung</title>

</head>
<header>
    <h1>Registrierung</h1>
</header>
<?php
require "navi.php";
?>

<body>
    <?php
    require "burgerMenü.php";
    ?>
    <div class="container">
        <h2 style="text-align:center">Registrierung</h2>
        <form action="/registrieren" method="post">
            <label for="anrede">Anrede:</label>
            <select id="anrede" name="anrede">
                <option value="herr">Herr</option>
                <option value="frau">Frau</option>
                <option value="divers">Divers</option>
            </select>
            <br>
            <label for="vorname">Vorname:</label>
            <input type="text" id="vorname" name="vorname" required>
            <br>
            <label for="nachname">Nachname:</label>
            <input type="text" id="nachname" name="nachname" required>
            <br>
            <label for="email">E-Mail-Adresse:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="passwort">Passwort:</label>
            <input type="password" id="passwort" name="passwort" required>
            <br>
            <label for="geburtsdatum">Geburtsdatum:</label>
            <input type="date" id="geburtsdatum" name="geburtsdatum" required>
            <br>
            <br>
            <input type="submit" value="Registrieren">
        </form>
    </div>
    <?php
    require "footer.php";
    ?>
</body>

</html>