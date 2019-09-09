
<!doctype html>


<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My sentiments</title>
</head>

<body>
  <h1>My sentiments</h1>
  <p>Enter the sentence.</p>
  
  
<form action="" method="POST">
<label>Enter Sentence (for example 'I like playing football'):</label><br />
<input type="text" name="sentence" placeholder="Enter  Sentence" required/>
<br /><br />
<button type="submit" name="submit">Submit</button>
</form>
  
 
<?php

# force displaying errors
error_reporting(E_ALL);

ini_set("display_errors", 1);


$url ="http://ip172-18-0-8-blq190ad7o0g00edt8d0-8080.direct.labs.play-with-docker.com/sentiment/";

$url = getenv('SA_WEBAPP_API_URL');
  
if((isset($_POST['sentence']) && $_POST['sentence']!="")
{
   
$data=array('sentence' => 'I like yogobella',
'sentence' => 'I hate cats'
);
$content = json_encode($data);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

$json_response = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);


if ( $status > 200 ) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}

curl_close($curl);

$response = json_decode($json_response, true);
echo "<pre>";
print_r($data);
print (CURLINFO_HTTP_CODE);

print_r($response);
echo "</pre>";

}

echo "<pre>";
    print_r($_POST);
echo "</pre>";

?>
 
  


</body>
</html>