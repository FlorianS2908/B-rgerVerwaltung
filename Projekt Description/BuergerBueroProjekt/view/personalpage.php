<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information Form</title>
    <link rel="stylesheet" href="style/personalpage.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/burgerMenü.css">
</head>

<body>
    <?php include 'burgerMenü.php'; ?>
    <div class="container">
        <br>
        <h1>Persönliche Daten</h1>
        <p class="subtext">Hier finden Sie Ihre persönlichen Daten</p>
        <?php
        session_start();
        
        ?>
        <div class="fixed-fields">
            <div class="box">
                <div class="umrandung">
                    <label class="titel" for="state">Nachname:</label>
                    <p class="text nachname" name="Nachname">Mustermann</p>
                </div>
                <div class="umrandung">
                    <label class="titel" for="state">Geburtsdatum:</label>
                    <p class="text geburtsdatum ">1990-01-01</p>
                </div>
            </div>
            <div class="box">
                <div class="umrandung">
                    <label class="titel" for="state">Vorname:</label>
                    <p class="text vorname">Erika</p>
                </div>
                <div class="umrandung">
                    <label class="titel" for="state">Geburtsort:</label>
                    <p class="text geburtsort">Berlin</p>
                </div>
            </div>
        </div>


        <h1 class="title2">Adresse</h1>
        <div class="editable-fields">
            <div class="box">
                <div class="adresse">
                    <label class="titel" for="state">Straße:</label>
                    <input type="text" id="Straße" name="Straße" required value="Ihre Straße" />
                    <label class="titel" for="address">Hausnummer:</label>
                    <input type="text" id="Hausnummer" name="Hausnummer" required value="Ihre Hausnummer" />
                    <label class="titel" for="zipCode">Postleitzahl:</label>
                    <input type="text" id="PLZ" name="PLZ" required value="Ihre Postleitzahl" />
                    <label class="titel" for="city">Stadt:</label>
                    <input type="text" id="Ort" name="Ort" required value="Ihre Stadt" />
                    <div class="btn-container">
                        <button class="btn" onclick="saveData()">Speichern</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="scripte/personalpage.js"></script>
</body>

</html>