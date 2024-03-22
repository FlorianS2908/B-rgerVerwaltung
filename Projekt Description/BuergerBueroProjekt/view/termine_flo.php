<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/burgerMenü.css">
    <link rel="stylesheet" href="./style/navigation.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/footer.css">
    <link rel="stylesheet" href="./style/kalender_style.css">
    <title>Bürger Verwaltung Termin Kalender</title>
</head>
<header>
    <h1>Buchen Sie einen Termin</h1>
</header>
<?php
require "navi.php";
?>

<body>




    <?php
    require "burgerMenü.php";
    ?>


    <main>
        <?php

        $daten = file_get_contents("../model/TerminMockup.json");

        $data = json_decode($daten, true);
        ?>
        <div id="abteilungen">
            <select id="dep_select">


                <?php
                $bereitsAngezeigt = array();


                foreach ($data as $sliceOfArray) :
                    $abteilung = $sliceOfArray["Gruppe"];
                    if (!in_array($abteilung, $bereitsAngezeigt)) :
                        $bereitsAngezeigt[] = $abteilung;
                ?>

                <option <?php
                                if (isset($_GET['dep']) && $abteilung == $_GET['dep'])
                                    echo "selected";
                                ?>>
                    <?php echo $abteilung; ?>
                </option>


                <?php
                    endif;
                endforeach;
                ?>
            </select>
        </div>

        <div id="calender_wrapper">
            <div id="calendar">
                <div id="calendar-holidays">
                    <?php
                    $holidays = array();
                    foreach ($data as $elem) {
                        $date = $elem['FeiertagsDatum'];
                        $date = DateTime::createFromFormat('d.m.Y', $date);
                        $holidays[] = $date->format('Y.m.d');
                    }
                    $holidays = array_values(array_unique($holidays));

                    echo json_encode($holidays);
                    ?>
                </div>
                <div id="calendar-header">
                </div>
                <div id="calendar-body">
                </div>
            </div>
        </div>



        <div id="freie_zeiten">
            <label>Verfügbare Termine:
                <?php
                $day = isset($_GET['day']) ? (int)$_GET['day'] : 0;
                $month = isset($_GET['month']) ? (int)$_GET['month'] : 0;
                $year = isset($_GET['year']) ? (int)$_GET['year'] : 0;
                $apps = array();
                $dates_for_dep = array();
                // Stelle sicher, dass das Datum im richtigen Format für den Vergleich vorliegt
                $dateToCompare = DateTime::createFromFormat('d.m.Y', $day . '.' . $month . '.' . $year);
                $dateToCompare = $dateToCompare->format('d.m.Y');
                $dep = isset($_GET['dep']) ? $_GET['dep'] : "Sales";
                foreach ($data as $sliceOfArray) {
                    if ($dep == $sliceOfArray['Gruppe']) {
                        $dates_for_dep[$sliceOfArray['Termin']] = true;
                        // Prüfe, ob der Termin mit dem gewünschten Datum übereinstimmt
                        if ($sliceOfArray['Termin'] == $dateToCompare) {
                            // Konvertiere die Startzeit in das 24-Stunden-Format
                            $starttime = strtotime($sliceOfArray['Startzeitpunkt']);
                            // Hole die Dauer in Minuten
                            $appointime = $sliceOfArray['Dauer'];
                            // Füge die Dauer zur Startzeit hinzu und konvertiere zurück in das "H:i"-Format
                            $endtime = date("H:i", strtotime("+$appointime minutes", $starttime));
                            // Korrigiere die Ausgabe der Startzeit (vorher: nur Minuten im falschen Format)
                            $starttime = date("H:i", $starttime);
                            $apps[$starttime] = $endtime;
                        }
                    }
                }
                ksort($apps);
                ?>

                <select name="zeit" id="zeit_select">
                    <?php foreach ($apps as $start => $end) : ?>
                    <option value="<?php echo $start . '-' . $end ?>">
                        <?php echo $start . "-" . $end ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>

        <button name="buchen">Termin buchen</button>

        <div id="dates">
            <?php
            $formatted_dates = array();
            foreach (array_keys($dates_for_dep) as $date) {
                $dt = DateTime::createFromFormat('d.m.Y', $date);
                $formatted_dates[] = $dt->format('Y-m-d');
            }
            echo json_encode($formatted_dates, true);
            ?>
        </div>


        <script>
        const month_names = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli',
            'August', 'September', 'Oktober', 'November', 'Dezember'
        ];

        function setTimeToZero(date) {
            date.setMilliseconds(0);
            date.setSeconds(0);
            date.setMinutes(0);
            date.setHours(0);
            return date;
        }

        const now = new Date();
        setTimeToZero(now);

        let url = new URL(window.location.href);

        function Calendar(headerId, bodyId, date = now) {
            this.date = date;
            this.oldDate = new Date(date);
            this.header = document.getElementById(headerId);
            this.body = document.getElementById(bodyId);

            let holiday_div = document.getElementById('calendar-holidays');
            let holidays = JSON.parse(holiday_div.textContent).map((d) => new Date(d));
            holidays = holidays.map(setTimeToZero).map((d) => d.toString());
            this.holidays = new Set(holidays);
            holiday_div.textContent = '';

            let dates_div = document.getElementById('dates');
            let dates = JSON.parse(dates_div.textContent).map((d) => new Date(d));
            dates = dates.map(setTimeToZero).map((d) => d.toString());
            dates_div.textContent = '';
            this.dates = new Set(dates);

            this.refreshHeader();
            this.refreshBody();
        }

        Calendar.prototype.incMonth = function() {
            this.date.setMonth(this.date.getMonth() + 1);
            this.refreshHeader();
            this.refreshBody();
        }

        Calendar.prototype.decMonth = function() {
            this.date.setMonth(this.date.getMonth() - 1);
            this.refreshHeader();
            this.refreshBody();
        }


        Calendar.prototype.refreshBody = function() {
            // build the body of the calendar. That is, between 28 and 31 Entries representing the days
            const days_in_month =
                new Date(this.date.getFullYear(), this.date.getMonth() + 1, 0).getDate();

            this.body.textContent = '';

            for (const name of ['Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So']) {
                let day = document.createElement('div');
                day.classList.add('calendar-weekday');
                day.append(name);
                this.body.append(day);
            }


            let offset = new Date(this.date.getFullYear(), this.date.getMonth(), 1).getDay();
            offset = offset - 1;
            let prev_start_date = new Date(this.date.getFullYear(), this.date.getMonth(), 0)
            let prev_start = prev_start_date.getDate();
            for (let i = prev_start - offset; i <= prev_start; i++) {
                const empty = document.createElement('div');
                empty.classList.add('calendar-empty');
                empty.classList.add('calendar-day');
                empty.append(i.toString());
                this.body.append(empty);
            }

            for (let i = 1; i <= days_in_month; i++) {
                const day = document.createElement('a');
                day.classList.add('calendar-day');
                thisDay = new Date(this.date.getFullYear(), this.date.getMonth(), i);
                setTimeToZero(thisDay);

                if (thisDay - this.oldDate == 0) {
                    day.classList.add('calendar-today');
                } else if (thisDay - now < 0 ||
                    this.holidays.has(thisDay.toString()) ||
                    !this.dates.has(thisDay.toString())) {
                    day.classList.add('calendar-blocked');
                }

                url.searchParams.set('day', i.toString());
                url.searchParams.set('month', this.date.getMonth() + 1);
                url.searchParams.set('year', this.date.getFullYear());
                day.href = url.href;
                day.append(i.toString());
                this.body.append(day);
            }
        }

        Calendar.prototype.refreshHeader = function() {
            this.header.textContent = '';

            const year = document.createElement('h5');
            year.append(this.date.getFullYear().toString());
            const button_div = document.createElement('div');
            button_div.classList.add('calendar-buttons');
            const button_before = document.createElement('button');
            button_before.classList.add('calendar-button');
            button_before.append('\u2039');
            button_before.addEventListener("click", (e) => this.decMonth());
            const month = document.createElement('h6');
            month.append(month_names[this.date.getMonth()]);
            const button_after = document.createElement('button');
            button_after.classList.add('calendar-button');
            button_after.append('\u203A');
            button_after.addEventListener("click", (e) => this.incMonth());
            button_div.append(button_before, button_after);
            this.header.append(year, month, button_div);
        }


        let date = now;
        if (url.searchParams.get('year')) {
            date = new Date(url.searchParams.get('year'), url.searchParams.get('month') - 1,
                url.searchParams.get('day'));
        }
        calendar = new Calendar('calendar-header', 'calendar-body', date);

        // abteilungen
        const select = document.getElementById('dep_select');
        select.addEventListener("change", (e) => {
            url.searchParams.set('dep', e.target.value);
            window.location = url.href;
        });
        </script>
    </main>



    <footer>
        <p>&copy; 2024 Bürgerbüro. Alle Rechte vorbehalten.</p>
    </footer>

</body>