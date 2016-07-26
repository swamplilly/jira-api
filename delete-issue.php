<?php

if (count($argv) != 2) {
    exit("ERROR: Please input issue ID or key.\n");
}

// put together api url
$jira_base_url = 'https://jira.library.ucla.edu';
$issue_url = '/rest/api/2/issue';
$issue_num = "/" . $argv[1];
$delete_subtasks_url = "?deleteSubtasks='true'";
$post_url = $jira_base_url . $issue_url . $issue_num . $watchers_url . $delete_subtasks_url;

// auth info
$username = '*';
$password = '*';

// headers for curl
$headers = array(

    'Accept: application/json',

    'Content-Type: application/json'

);

// set curl options
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_VERBOSE, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
curl_setopt($curl, CURLOPT_URL, $post_url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

// execute curl, get response
$response = curl_exec($curl);
$curl_error = curl_error($curl);

// print response or errors
if ($curl_error) {
    echo "cURL Error: $curl_error";
} else {
    echo $response;
}

// finish
curl_close($curl);

?>
