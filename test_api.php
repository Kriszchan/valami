<?php

$url = "http://localhost:8000/api/teams";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

if ($response) {
    $data = json_decode($response, true);
    echo "API Response:\n";
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "\n\nTotal teams: " . count($data) . "\n";
} else {
    echo "API request failed";
}
