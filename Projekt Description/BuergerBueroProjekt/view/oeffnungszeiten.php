<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/oeffnungszeiten.css">
    <link rel="stylesheet" href="./style/burgerMenü.css">
    <link rel="stylesheet" href="./style/navigation.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/footer.css">
    <link rel="stylesheet" href="./style/main.css">
    <title>Öffnungszeiten</title>
</head>
<header>
    <h1>Öffnungszeiten</h1>
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
            <h2>Unsere Öffnungszeiten</h2>
            <table>
                <thead>
                    <tr>
                        <th>Tag</th>
                        <th>Öffnungszeiten</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Montag</td>
                        <td>09:00 - 17:00 Uhr</td>
                    </tr>
                    <tr>
                        <td>Dienstag</td>
                        <td>09:00 - 17:00 Uhr</td>
                    </tr>
                    <tr>
                        <td>Mittwoch</td>
                        <td>09:00 - 17:00 Uhr</td>
                    </tr>
                    <tr>
                        <td>Donnerstag</td>
                        <td>09:00 - 19:00 Uhr</td>
                    </tr>
                    <tr>
                        <td>Freitag</td>
                        <td>09:00 - 17:00 Uhr</td>
                    </tr>
                    <tr>
                        <td>Samstag</td>
                        <td>Geschlossen</td>
                    </tr>
                    <tr>
                        <td>Sonntag</td>
                        <td>Geschlossen</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <?php
    require "footer.php";
    ?>

</body>

</html>