<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registrierung</title>
    <link rel="stylesheet" href="./style/login.css">
    <link rel="stylesheet" href="./style/burgerMenü.css">
    <link rel="stylesheet" href="./style/navigation.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/footer.css">
    <link rel="stylesheet" href="./style/header.css">
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
        <h1>Login</h1>
        <form action="index.php" method="post">
            <label for="username">Benutzername oder E-Mail-Adresse:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Passwort:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Anmelden</button>
            <a href="forgotPaswword.php">Passwort vergessen?</a>
            <a href="registPage.php">Registrieren</a>
        </form>
    </div>
    <?php
    require "footer.php";
    ?>
</body>

</html>