<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/kontakt.css">
    <link rel="stylesheet" href="./style/burgerMenü.css">
    <link rel="stylesheet" href="./style/navigation.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/footer.css">
    <link rel="stylesheet" href="./style/main.css">
    <title>Kontakt</title>
</head>
<header>
    <h1>Kontakt</h1>
</header>

<?php
require "navi.php";
?>

<body>

    <?php
    require "burgerMenü.php";
    ?>
    <main>
        <section>
            <h2>Kontaktinformationen</h2>
            <p>Hier sind unsere Kontaktdaten:</p>
            <address>
                Bürgerbüro Musterstadt<br>
                Musterstraße 123<br>
                12345 Musterstadt<br>
                Telefon: 01234 / 567890<br>
                E-Mail: info@musterstadt-buergerbuero.de
            </address>
        </section>

        <section>
            <h2>Kontaktformular</h2>
            <form action="#" method="post">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>
                <label for="email">E-Mail:</label><br>
                <input type="email" id="email" name="email" required><br><br>
                <label for="message">Nachricht:</label><br>
                <textarea id="message" name="message" rows="4" required></textarea><br><br>
                <input type="submit" value="Nachricht senden">
            </form>
        </section>
    </main>

    <?php
    require "footer.php";
    ?>

</body>

</html>