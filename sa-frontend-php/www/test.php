<?php
###

# force displaying errors
error_reporting(E_ALL);

ini_set("display_errors", 1);


$b = array(1, 1, 2, 3, 5, 8);

$arr = get_defined_vars();

// print $b
print_r($arr["b"]);

/* print path to the PHP interpreter (if used as a CGI)
 * e.g. /usr/local/bin/php */
echo $arr["_"];

// print the command-line parameters if any
print_r($arr["argv"]);

// print all the server vars
print_r($arr["_SERVER"]);

// print all the available keys for the arrays of variables
print_r(array_keys(get_defined_vars()));


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