<!DOCTYPE html>
<html>
<?php
//require "../controller/db_dataLoad.php";
//createDatapool();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/style/anträgemain.css">
    <link rel="stylesheet" href="../view/style/burgerMenü.css">
    <link rel="stylesheet" href="../view/style/navigation.css">
    <link rel="stylesheet" href="../view/style/header.css">
    <link rel="stylesheet" href="../view/style/footer.css">
    <title>Bürger Verwaltung</title>
    <script src="./scripte/antrag.js"></script>
</head>
<header>
    <h1>Anträge</h1>
</header>
<?php
require "navi.php";
?>


<body>
    <?php
    require "burgerMenü.php";
    ?>
    <?php
    require "mainantrag.php"
    ?>

    <?php
    require "footer.php";
    ?>

</body>

</html>