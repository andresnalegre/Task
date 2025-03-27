<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getTimezoneInfo($lat, $lng) {
    $url = "http://api.geonames.org/timezoneJSON?lat=$lat&lng=$lng&username=andresn";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
}

if (isset($_GET['lat']) && isset($_GET['lng'])) {
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    $data = getTimezoneInfo($lat, $lng);

    if (isset($data['timezoneId'])) {
        echo json_encode(['status' => 'ok', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Latitude and longitude parameters are missing']);
}
?>