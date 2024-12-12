<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8080/pdf',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
    'file'=> new CURLFILE("C:\Users\dk972\Downloads\PDFs\PDFs\a.pdf"),
    'knowledge_id' => 23 // Pass knowledge_id to the endpoint
  ),  
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


//  if (curl_errno($curl)) {
//       echo $issue_json;
//   } else {
//       echo "<script>console.log('Debug Objects: " . $response . "' );</script>";
//   }

// curl_close($curl);
// echo $response;
 ?>