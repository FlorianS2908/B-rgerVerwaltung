<!DOCTYPE html>
<html lang="en">
<script src="script.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information Form</title>
    <link rel="stylesheet" href="style/personalpage.css">
</head>

<body>
    <div class="container">
        <br>
        <h1>Persönliche Daten</h1>
        <p class="subtext">Hier finden Sie Ihre persönlichen Daten</p>

        <div class="fixed-fields">
            <div class="box">
                <div class="umrandung">
                    <label class="titel" for="state">Nachname:</label>
                    <!-- Hier wird der Input für den Namen als readonly definiert -->
                    <p class="text">Mustermann</p>
                </div>
                <div class="umrandung">
                    <label class="titel" for="state">Geburtsdatum:</label>
                    <!-- Hier wird der Input für den Namen als readonly definiert -->
                    <p class="text">1990-01-01</p>
                </div>
            </div>
            <div class="box">
                <div class="umrandung">
                    <label class="titel" for="state">Vorname:</label>
                    <!-- Hier wird der Input für den Namen als readonly definiert -->
                    <p class="text">Erika</p>
                </div>
                <div class="umrandung">
                    <label class="titel" for="state">Geburtsort:</label>
                    <!-- Hier wird der Input für den Namen als readonly definiert -->
                    <p class="text">Berlin</p>
                </div>
            </div>
        </div>


        <h1>Adresse</h1>
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
    <script src="script.js"></script>
</body>

</html>