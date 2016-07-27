<?php

/***************************************
 *
 * Set up url
 *
 **************************************/

$jira_base_url = 'https://jira-test.library.ucla.edu';
$issue_url = '/rest/api/2/issue';
$post_url = $jira_base_url . $issue_url;

/***************************************
 *
 * Auth info
 *
 **************************************/

$username = $argv[2];
$password = $argv[3];

/***************************************
 *
 * Get .json contents
 *
 **************************************/

$post = $argv[1];
$post_fd = fopen($post, 'r');
$post_content = file_get_contents($post);
$post_obj = json_decode($post_content, true);

/***************************************
 *
 * Curl headers
 *
 **************************************/

$headers = array(

    'Accept: application/json',

    'Content-Type: application/json'

);

/***************************************
 *
 * Curl options
 *
 **************************************/

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

/***************************************
 *
 * Execute
 *
 **************************************/

$response = curl_exec($curl);
$curl_error = curl_error($curl);

/***************************************
 *
 * Print response
 *
 **************************************/

if ($curl_error) {
    echo "ERROR:\n$curl_error";
} else {
    echo "SUCCESS\nCheck below for post details:\n$response";
}

/***************************************
 *
 * Clean up
 *
 **************************************/

curl_close($curl);

?>
