<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktformular</title>
    <link rel="stylesheet" href="./style/kontaktformular.css">
    <link rel="stylesheet" href="../view/style/burgerMenü.css">
    <link rel="stylesheet" href="../view/style/navigation.css">
    <link rel="stylesheet" href="../view/style/header.css">
    <link rel="stylesheet" href="../view/style/footer.css">
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

    <div class="container">
        <h2>Kontaktformular</h2>
        <form action="index.php" method="post" class="contact-form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="vorname">Vorname:</label>
                <input type="text" id="vorname" name="vorname" required>
            </div>
            <div class="form-group">
                <label for="betreff">Betreff:</label>
                <input type="text" id="betreff" name="betreff" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="nachricht">Nachricht:</label>
                <textarea id="nachricht" name="nachricht" rows="4" cols="50" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Anfragesenden">
            </div>
        </form>
    </div>
    <?php
    require "footer.php";
    ?>
</body>

</html>