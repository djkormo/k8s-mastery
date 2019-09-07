<?php
###

# force displaying errors
error_reporting(E_ALL);

ini_set("display_errors", 1);


$url = 'http://ip172-18-0-8-blq190ad7o0g00edt8d0-8080.direct.labs.play-with-docker.com/sentiment/';

//create a new cURL resource
$ch = curl_init($url);

//setup request to send json via POST
$data = array(
    'username' => 'codexworld',
    'password' => '123456'
);
$payload = json_encode(array("user" => $data));

//attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

//set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

//return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute the POST request
$result = curl_exec($ch);

//close cURL resource
curl_close($ch);

?>