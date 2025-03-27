<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getCountryInfo($country) {
    $url = "http://api.geonames.org/countryInfoJSON?formatted=true&country=$country&username=andresn";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
}

if (isset($_GET['country'])) {
    $country = $_GET['country'];
    $data = getCountryInfo($country);

    if (isset($data['geonames']) && count($data['geonames']) > 0) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'data' => $data['geonames'][0]]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Country parameter is missing']);
}
?>