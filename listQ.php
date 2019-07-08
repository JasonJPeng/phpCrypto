<?php
// API call for all coin list
//   https://min-api.cryptocompare.com/data/all/coinlist
//   https://www.cryptocompare.com/media/19702/ezc.png

$fileName = "listQ.js";

$myfile = fopen($fileName, "w") or die("Unable to open file!");

fwrite($myfile, "listQ = [ \n");

// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, "https://min-api.cryptocompare.com/data/all/coinlist");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


// grab URL and pass it to the browser
$j = json_decode(curl_exec($ch));
$coinNames = get_object_vars($j->Data);

foreach ($coinNames as $key=>$value) {
    // echo $value->CoinName . "    " . $value->ImageUrl . "\n<br>";
    fwrite($myfile, '["' . $value->CoinName .   '",  ' . '"https://www.cryptocompare.com' . $value->ImageUrl . '"],' .PHP_EOL);
}

fwrite($myfile, "];");

// print_r($coinNames);
// var_dump($j);

fclose($myfile);
// close cURL resource, and free up system resources
curl_close($ch);

?>