<?php

require_once __DIR__ . '/config.php';

class API {
    function Select(){
      
        $slackName = isset($_GET['slack_name']) ? $_GET['slack_name'] : null;
        $track = isset($_GET['track']) ? $_GET['track'] : null;

        $db = new Connect;

        // Modify the SQL query to format utc_time
        $sql = 'SELECT slack_name, DAYNAME(current_day) AS day_name, CONCAT(current_day, " ", utc_time) AS datetime, track, github_file_url, github_repo_url, status_code FROM users WHERE 1=1';

        if ($slackName !== null) {
            $sql .= " AND slack_name = :slackName";
        }

        if ($track !== null) {
            $sql .= " AND track = :track";
        }

        $sql .= ' ORDER BY slack_name';

        $data = $db->prepare($sql);

        if ($slackName !== null) {
            $data->bindParam(':slackName', $slackName);
        }

        if ($track !== null) {
            $data->bindParam(':track', $track);
        }

        $data->execute();

        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            // Create an associative array with the desired order
            $outputDataFormatted = array(
                'slack_name' => $OutputData['slack_name'],
                'day_name' => $OutputData['day_name'],
                'utc_time' => $OutputData['datetime'] . "Z",
                'track' => $OutputData['track'],
                'github_file_url' => $OutputData['github_file_url'],
                'github_repo_url' => $OutputData['github_repo_url'],
                'status_code' => $OutputData['status_code']   
            );

            echo json_encode($outputDataFormatted, JSON_PRETTY_PRINT) . PHP_EOL;
        }
    }
}

$API = new API;
header('Content-type: application/json');
$API->Select();
?>