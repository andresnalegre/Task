<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getEarthquakeInfo($north, $south, $east, $west) {
    $url = "http://api.geonames.org/earthquakesJSON?north=$north&south=$south&east=$east&west=$west&username=andresn";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
}

if (isset($_GET['north'], $_GET['south'], $_GET['east'], $_GET['west'])) {
    $data = getEarthquakeInfo($_GET['north'], $_GET['south'], $_GET['east'], $_GET['west']);

    if (isset($data['earthquakes']) && count($data['earthquakes']) > 0) {
        echo json_encode(['status' => 'ok', 'data' => $data['earthquakes']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No earthquake data found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Bounding box parameters are missing']);
}
?>