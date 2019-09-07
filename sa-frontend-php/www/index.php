
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
<label>Enter Sentence::</label><br />
<input type="text" name="sentiment" placeholder="Enter  Sentence" required/>
<br /><br />
<button type="submit" name="submit">Submit</button>
</form>
  
 
<?php


error_reporting(E_ALL);

ini_set("display_errors", 1);


if (isset($_POST['sentiment']) && $_POST['sentiment']!="") {
	$sentiment = $_POST['sentiment'];
	$url = "http://localhost:8000/sentiment/".$sentiment;
	
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($client);
	
	$result = json_decode($response);
	
	print_r($result);
	
	echo "<table>";
	echo "<tr><td>Order ID:</td><td>$result->sentiment</td></tr>";
	echo "<tr><td>Amount:</td><td>$result->polarity</td></tr>";
	echo "</table>";
}


echo "<pre>";
    print_r($_POST);
echo "</pre>";

?>
 
  
  <?php
//API URL
$url = 'http://www.example.com/api';

//create a new cURL resource
$ch = curl_init($url);

//setup request to send json via POST
$data = array(
    'sentence' => 'sentence',
    'content' => 'I like my mother'
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

<h5> https://www.allphptricks.com/create-and-consume-simple-rest-api-in-php/ </h5>

</body>
</html>