<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/burgerMenü.css">
    <link rel="stylesheet" href="style/dienstleistung.css">
    <link rel="stylesheet" href="style/navigation.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/main.css">
    <title>Dienstleistungen</title>
</head>
<header>
    <h1>Unsere Dienstleistungen</h1>
</header>

<?php
require "navi.php";
?>

<body>
    <?php
    require "burgerMenü.php";
    ?>
    <main class="container">
        <section>
            <h2>Beantragung von Personalausweisen</h2>
            <p id="main">Wir bieten die Beantragung von Personalausweisen für Bürgerinnen und Bürger an.</p>
        </section>
        <section>
            <h2>Beantragung von Reisepässen</h2>
            <p id="main">Wir bieten die Beantragung von Reisepässen für Bürgerinnen und Bürger an.</p>
        </section>
        <section>
            <h2>Melderegisterauskünfte</h2>
            <p id="main">Wir bieten Melderegisterauskünfte für Behörden, Unternehmen und Privatpersonen an.</p>
        </section>
        <section>
            <h2>Ummeldungen</h2>
            <p id="main">Wir führen Ummeldungen von Einwohnern durch.</p>
        </section>
        <section>
            <h2>Abmeldung</h2>
            <p id="main">Wir nehmen Abmeldungen von Einwohnern entgegen.</p>
        </section>
    </main>

    <?php
    require "footer.php";
    ?>

</body>

</html>