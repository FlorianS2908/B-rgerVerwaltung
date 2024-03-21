<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminvereinbarung</title>
    <link rel="stylesheet" href="./style/termine.css">
    <link rel="stylesheet" href="./style/navigation.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/footer.css">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="../view/style/burgerMenü.css">
    
</head>
<header>
    <h1>Terminvereinbahrung</h1>
</header>
<body>
        </div>
        <?php
        require "navi.php";
        ?>
        <div class="main">
            <?php
            $json_file_path = '../model/TerminMockup.json';

            // JSON-Datei lesen
            $json_data = file_get_contents($json_file_path);

            // JSON-Daten dekodieren
            $data_array = json_decode($json_data, true); // Das zweite Argument "true" gibt an, dass ein assoziatives Array verwendet werden soll
            $group = array();
            foreach ($data_array as $elm) {
                array_push($group, $elm["Gruppe"]);
            }
            $group = array_unique($group, SORT_STRING);
            ?>
            <form>
                <label for="dienstleistung">Dienstleistung:</label>
                <select id="dienstleistung">
                    <?php
                    foreach ($group as $elm) {
                        echo "<option value=\$elm\"> $elm</option>";
                    }
                    ?>

                </select>
                <br>
                <br>
                
            <div class="wochentage">
                <label>Wochentage:</label>
                <br>
                <div class="checkbox-container">
                <input type="checkbox" id="montag" name="wochentage" value="montag">
                <label for="montag">Montag</label>
                <input type="checkbox" id="dienstag" name="wochentage" value="dienstag">
                <label for="dienstag">Dienstag</label>
                <input type="checkbox" id="mittwoch" name="wochentage" value="mittwoch">
                <label for="mittwoch">Mittwoch</label>
                <input type="checkbox" id="donnerstag" name="wochentage" value="donnerstag">
                <label for="donnerstag">Donnerstag</label>
                <input type="checkbox" id="freitag" name="wochentage" value="freitag">
                <label for="freitag">Freitag</label>
                <br>
                <br>
                </div>
            </div>

            <div class="zeitfenster">
                <label>Zeitfenster:</label>
                <br>
                <div class="checkbox-container">
                <input type="checkbox" id="vormittags" name="zeitfenster" value="vormittags">
                <label for="vormittags">Vormittags</label>
                <input type="checkbox" id="nachmittags" name="zeitfenster" value="nachmittags">
                <label for="nachmittags">Nachmittags</label>
                <br>
                <br>
                </div>
            </div>

                <input type="submit" value="Termin suchen">
            </form>
            <br>

            <h2>Datum</h2>
            <?php 
            require "kalender.php"; 
            ?>
            </div>
            </div>
        <?php
        require "footer.php";
        ?>
</body>

</html>