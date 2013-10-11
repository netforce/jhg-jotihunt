<?php
$address = 'de halmen 1a voorst';
$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
$response = json_decode($response);

$lat = $response->results[0]->geometry->location->lat;
$lng = $response->results[0]->geometry->location->lng;

echo $lat ." ". $lng ."<br />";
echo"<a href=\"https://maps.google.nl/maps?hl=nl&q=" .$lat. "+". $lng ."\">Maps</a>"
?>