<?php

require_once __DIR__ . '/config.php';

class API {
    function Select(){
        $db = new Connect;
        $users = array();
        $data = $db->prepare('SELECT slack_name, DAYNAME(current_day) AS day_name, utc_time, track, github_file_url, github_repo_url, status_code FROM users ORDER BY slack_name');
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $users[$OutputData['slack_name']] = array(
                'slack_name' => $OutputData['slack_name'],
                'current_day' => $OutputData['day_name'], // Use the day_name column from the query
                'utc_time' => $OutputData['utc_time'],
                'track' => $OutputData['track'],
                'github_file_url' => $OutputData['github_file_url'],
                'github_repo_url' => $OutputData['github_repo_url'],
                'status_code' => $OutputData['status_code']   
            );
        }
        return json_encode($users);
    }
}

$API = new API;
header('Content-type: application/json');
echo $API->Select();

?>