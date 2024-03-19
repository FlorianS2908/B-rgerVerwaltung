<!DOCTYPE html>
<html>
<?php
require "../controller/db_dataLoad.php";
createDatapool();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/burgerMenü.css">
    <link rel="stylesheet" href="../style/navigation.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
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
    <main>
        <section>
            <h2>Über uns</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, odio a tincidunt malesuada, nisl
                nunc feugiat nunc, sit amet convallis libero arcu non sem. Integer tincidunt est eget magna facilisis,
                sit amet pharetra justo dignissim.</p>
            <img src="https://via.placeholder.com/400" alt="Bürgerbüro">
        </section>

        <section>
            <h2>Unsere Dienstleistungen</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, odio a tincidunt malesuada, nisl
                nunc feugiat nunc, sit amet convallis libero arcu non sem. Integer tincidunt est eget magna facilisis,
                sit amet pharetra justo dignissim.</p>
            <img src="https://via.placeholder.com/400" alt="Dienstleistungen">
        </section>

        <section>
            <h2>Öffnungszeiten</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, odio a tincidunt malesuada, nisl
                nunc feugiat nunc, sit amet convallis libero arcu non sem. Integer tincidunt est eget magna facilisis,
                sit amet pharetra justo dignissim.</p>
            <img src="https://via.placeholder.com/400" alt="Öffnungszeiten">
        </section>

        <section>
            <h2>Kontakt</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, odio a tincidunt malesuada, nisl
                nunc feugiat nunc, sit amet convallis libero arcu non sem. Integer tincidunt est eget magna facilisis,
                sit amet pharetra justo dignissim.</p>
            <img src="https://via.placeholder.com/400" alt="Kontakt">
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Bürgerbüro. Alle Rechte vorbehalten.</p>
    </footer>

</body>

</html>