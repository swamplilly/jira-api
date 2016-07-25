<?php

if (count($argv) != 3) {
    exit("ERROR: Please input issue ID or key, followed by update json file.\n");
}

// put together api url
$jira_base_url = 'https://jira.library.ucla.edu';
$issue_url = '/rest/api/2/issue';
$issue_num = $argv[1];
$post_url = $jira_base_url . $issue_url . $issue_num;

// auth info
$username = 'lli';
$password = 'Tomato923!!1';

// get post info into $post_obj
$post = $argv[2];
$post_fd = fopen($post, 'r');
$post_content = file_get_contents($post);
$post_obj = json_decode($post_content, true);

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
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_obj));

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
