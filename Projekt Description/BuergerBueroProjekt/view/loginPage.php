<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registrierung</title>
    <link rel="stylesheet" href="../view/style/login.css">
    <link rel="stylesheet" href="../view/style/burgerMenü.css">
    <link rel="stylesheet" href="../view/style/navigation.css">
    <link rel="stylesheet" href="../view/style/header.css">
    <link rel="stylesheet" href="../view/style/footer.css">
    <link rel="stylesheet" href="../view/style/header.css">
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
        <form action="/login" method="post">
            <label for="username">Benutzername oder E-Mail-Adresse:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Passwort:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Anmelden</button>
            <a href="/forgot-password">Passwort vergessen?</a>
        </form>
    </div>
    <?php
    require "footer.php";
    ?>
</body>

</html>