<?php
date_default_timezone_set('UTC');


$slackName = isset($_GET['slack_name']) ? $_GET['slack_name'] : "Joseph George";
$track = isset($_GET['track']) ? $_GET['track'] : "backend";


$currentTime = strtotime(gmdate('Y-m-d H:i:s'));
$twoHoursAgo = strtotime('-2 hours');
$twoHoursFuture = strtotime('+2 hours');

if ($currentTime < $twoHoursAgo || $currentTime > $twoHoursFuture) {
   http_response_code(400);
   echo json_encode(['error' => 'UTC time is not within +/-2 hours']);
   exit;
}


$response = [
   'slack_name' => $slackName,
   'current_day' => date('l'),
   'utc_time' => gmdate('Y-m-d\TH:i:s\Z'),
   'track' => $track,
   'github_file_url' => "https://github.com/username/repo/blob/main/file_name.ext",
   'github_repo_url' => "https://github.com/username/repo",
   'status_code' => 200
];

header('Content-Type: application/json');


echo json_encode($response);

?><?php
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
    'github_file_url' => 'https://github.com/artisticwrist/api-endpoint/blob/main/api.php',
    'github_repo_url' => 'https://github.com/artisticwrist/api-endpoint/',
    'status_code' => 200
];

// Return the response
echo json_encode($response, JSON_UNESCAPED_SLASHES);