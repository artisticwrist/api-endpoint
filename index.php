<?php

$slackName = isset($_GET['slack_name']) ? $_GET['slack_name'] : "Joseph George";
$currentDay = date('l');
$utcTime = gmdate('Y-m-d\TH:i:s\Z');
$track = isset($_GET['track']) ? $_GET['track'] : "backend";
$githubFileUrl = isset($_GET['github_file_url']) ? $_GET['github_file_url'] : "https://github.com/artisticwrist/api-endpoint/blob/main/index.php";
$githubRepoUrl = isset($_GET['github_repo_url']) ? $_GET['github_repo_url'] : "https://github.com/artisticwrist/api-endpoint";
$statusCode = 200;


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
   'current_day' => $currentDay,
   'utc_time' => $utcTime,
   'track' => $track,
   'github_file_url' => $githubFileUrl,
   'github_repo_url' => $githubRepoUrl,
   'status_code' => $statusCode
];

header('Content-Type: application/json');
echo json_encode($response);

?>