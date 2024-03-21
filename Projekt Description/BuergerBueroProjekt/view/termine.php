<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terminvereinbarung</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Terminvereinbarung</h1>
    </div>
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

        <label>Wochentage:</label>
        <br>
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

        <label>Zeitfenster:</label>
        <br>
        <input type="checkbox" id="vormittags" name="zeitfenster" value="vormittags">
        <label for="vormittags">Vormittags</label>
        <input type="checkbox" id="nachmittags" name="zeitfenster" value="nachmittags">
        <label for="nachmittags">Nachmittags</label>
        <br>
        <br>

        <input type="submit" value="Termin suchen">
      </form>
      <br>

      <h2>Datum</h2>
      <!-- Hier wird der Kalender eingefügt -->
      <br>

      <label for="freie-termine">Freie Termine:</label>
      <select id="freie-termine">
        <option value="termin1">Termin 1</option>
        <option value="termin2">Termin 2</option>
        <!-- Weitere freie Termine hier -->
      </select>
      <br>
      <br>

      <input type="button" value="Buchen">
    </div>
    <div class="footer">
      <p>Kontaktinformationen</p>
    </div>
  </div>
</body>

</html>