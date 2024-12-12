<?php 
$ch = curl_init();

$url = "http://127.0.0.1:8080/get";

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if(curl_errno($ch))
{

  echo 'curl error: ' . curl_error($ch);

} 
else 
{

  // Process the response data (e.g., JSON decode)

  $data = json_decode($response, true);

  // Use the data here

  echo "<script>console.log('Debug Objects: " . $data['message'] . "' );</script>";

}

curl_close($ch);

 ?>