<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getNearbyWikipedia($lat, $lng) {
    $url = "http://api.geonames.org/findNearbyWikipediaJSON?lat=$lat&lng=$lng&username=andresn";

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
    $data = getNearbyWikipedia($lat, $lng);

    header('Content-Type: application/json');
    if (isset($data['geonames']) && count($data['geonames']) > 0) {
        echo json_encode(['status' => 'ok', 'data' => $data['geonames']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data found']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Latitude and longitude parameters are missing']);
}
?>