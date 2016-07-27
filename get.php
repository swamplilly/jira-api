<?php

/***************************************
 *
 * Set up url
 *
 **************************************/

$jira_base_url = 'https://jira-test.library.ucla.edu';
$issue_url = '/rest/api/2/issue';
$issue_num = $argv[1];
$post_url = $jira_base_url . $issue_url . $issue_num;

/***************************************
 *
 * Auth info
 *
 **************************************/

$username = $argv[2];
$password = $argv[3];

/***************************************
 *
 * Curl options
 *
 **************************************/

$curl = curl_init();
curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
curl_setopt($curl, CURLOPT_URL, $post_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

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
    echo "cURL Error: $curl_error";
} else {
    var_dump($response);
}

/***************************************
 *
 * Clean up
 *
 **************************************/

curl_close($curl);

?>
