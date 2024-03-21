<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/kalender.css" />

    <?php
    $termine = file_get_contents("../model/TerminMockup.json");

    $feiertage = json_decode($termine, true);
    $feiertageArray = array();

    foreach ($feiertage as $holiday) {
        if (isset($holiday['FeiertagsDatum'])) {
            $feiertageArray[] = $holiday['FeiertagsDatum'];
        }
    }
    ?>

</head>

<body>
    <?php
    require_once ("burgerMenü.php");
    ?>
    <div id="cal">
        <div class="header">
            <span class="left button" id="prev"> &lang; </span>
            <span class="month-year" id="label"> </span>
            <span class="right button" id="next"> &rang; </span>
        </div>
        <table id="days">
            <tr>
                <td>So</td>
                <td>Mo</td>
                <td>Di</td>
                <td>Mi</td>
                <td>Do</td>
                <td>Fr</td>
                <td>Sa</td>

            </tr>
        </table>
        <div id="cal-frame">
            <!-- Calendar will be dynamically generated here -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripte/kalender.js"></script>
    <script>
    $(document).ready(function() {
        //var feiertageDates = <?php echo json_encode($feiertageArray); ?>;
        var cal = CALENDAR();
        //var_dump($feiertageArray)
        cal.init("#cal");
    });
    </script>
    
    <style>
     #datum {
        display: block;
        text-align: center;
    } 
    </style> 

    <Label for='datum', style="font-weight: bold;">Ausgewähltes Datum:</Label>

    <br> <br>

    <div id="freie-termine-container">
        <!-- Freie Termine content goes here -->
        <?php require 'freieTermine.php'; ?>
    </div>
    </div>
</body>

</html>