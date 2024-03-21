<!DOCTYPE html>
<html>
<?php
//require "../controller/db_dataLoad.php";
//createDatapool();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/style/anträgemaindetails.css">
    <link rel="stylesheet" href="../view/style/burgerMenü.css">
    <link rel="stylesheet" href="../view/style/navigation.css">
    <link rel="stylesheet" href="../view/style/header.css">
    <link rel="stylesheet" href="../view/style/footer.css">
    <title>Bürger Verwaltung</title>
    <script src="./scripte/antragdetails.js"></script>
    <script src="https://unpkg.com/pdf-lib"></script>
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
    require "mainantragdetails.php"
    ?>

    <?php
    require "footer.php";
    ?>

</body>

<script>
createPdf();
async function createPdf() {
    const url = 'https://pdf-lib.js.org/assets/with_update_sections.pdf'
    const arrayBuffer = await fetch(url).then(res => res.arrayBuffer())
    const pdfDoc = await PDFLib.PDFDocument.load(arrayBuffer);
    //const page = pdfDoc.addPage([350, 400]);
    //page.moveTo(110, 200);
    //page.drawText('Hello World!');
    const pdfDataUri = await pdfDoc.saveAsBase64({
        dataUri: true
    });
    document.getElementById('pdf').src = pdfDataUri;
}
</script>

</html>