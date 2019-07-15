
<!doctype html>

 
<h1> https://www.allphptricks.com/create-and-consume-simple-rest-api-in-php/ </h1>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My PHP Website</title>
</head>

<body>
  <h1>My PHP Website</h1>
  <p>Here is some static content.</p>
  
  
   <form action="index.php">
            <input type="text" name="sentiment" />
            <input type="submit" name="insert" value="insert" onclick="insert()" />
            <input type="submit" name="select" value="select" onclick="select()" />
        </form>

        <?php
            function select(){
               echo "The select function is called.";
            }
            function insert(){
               echo "The insert function is called.";
            }
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

