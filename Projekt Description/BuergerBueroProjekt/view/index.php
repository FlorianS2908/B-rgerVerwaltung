<!DOCTYPE html>
<html>
<?php
//require "../controller/db_dataLoad.php";
//createDatapool();
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
    var_dump($_SESSION);
    if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
        include "main.php";
    } else {
        include "loginPage.php";
    }
    ?>
    <?php
    require "footer.php";
    ?>

</body>

</html>