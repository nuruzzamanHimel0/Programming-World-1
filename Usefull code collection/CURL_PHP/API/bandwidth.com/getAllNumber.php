<?php 

	
//The URL of the resource that is protected by Basic HTTP Authentication.
$url = 'https://api.catapult.inetwork.com/v1/users/u-rybzztdtxvgzbymttfaq6na/phoneNumbers';
 
//Your username.
$username = 't-tadm45ceem42b5c44263ppq';
 
//Your password.
$password = 'fqpwaxgfdn6e5ydfwdf3z4x6l356vgfzq7mjf5i';
 
//Initiate cURL.
$ch = curl_init($url);
 
//Specify the username and password using the CURLOPT_USERPWD option.
curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);  
 
//Tell cURL to return the output as a string instead
//of dumping it to the browser.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
//Execute the cURL request.
$response = curl_exec($ch);
 
//Check for errors.
if(curl_errno($ch)){
    //If an error occured, throw an Exception.
    throw new Exception(curl_error($ch));
}
 

$decode = json_decode($response, true);
// print_r($decode);
$count = count($decode);
echo $count;


echo "<pre>";

foreach ( $decode as $var ) {
    echo "\n", $var['id'], "\t\t", $var['number']."<br>";
}


echo "<br> <br> <br> <br> <br>";

$array1 = Array ( 
       0 => Array ( "product_id" => 33 , "amount" => 1 ) ,
       1 => Array ( "product_id" => 34  , "amount" => 3 ) ,
        2 =>Array ( "product_id" => 10  , "amount" => 1 )
         );

echo "<pre>";

foreach ( $array1 as $var ) {
    echo "\n". $var['product_id']. "\t". $var['amount']."<br>";
}



?>
