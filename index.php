<?php
header('Content-Type: application/json');

// Get parameters
$slack_name = $_GET['slack_name'];
$track = $_GET['track'];

// Calculate the current day of the week
$current_day = date('l');

// Calculate the current UTC time within +/-2 minutes
$current_utc_time = gmdate('Y-m-d\TH:i:s\Z', time());

// Return a JSON response
$response = [
    'slack_name' => $slack_name,
    'current_day' => $current_day,
    'utc_time' => $current_utc_time,
    'track' => $track,
    'github_file_url' => 'https://github.com/artisticwrist/api-endpoint/blob/main/index.php',
    'github_repo_url' => 'https://github.com/artisticwrist/api-endpoint/',
    'status_code' => 200
];

// Return the response
echo json_encode($response, JSON_UNESCAPED_SLASHES);