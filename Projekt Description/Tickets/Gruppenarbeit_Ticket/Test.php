<?php 
$json_file_path = 'query_result_Antag.json';
 
// JSON-Datei lesen
$json_data = file_get_contents($json_file_path);
 
// JSON-Daten dekodieren
$data_array = json_decode($json_data, true); // Das zweite Argument "true" gibt an, dass ein assoziatives Array verwendet werden soll

var_dump($data_array);