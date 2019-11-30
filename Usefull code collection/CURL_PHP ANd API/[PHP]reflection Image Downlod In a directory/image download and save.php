<?php 

function sendSMSandMMS_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$message_responce,$media,$call_backURL)
{
  // $abc = "http://inventionbots.com/admin/views/besma/assets/images/campaign_image/cd6f31248.jpg";
    $postUrl = "https://api.catapult.inetwork.com/v1/users/".$userId."/messages";

   $message = array(
            "from" => $chatting_from,
            "to" => $chatting_to,
            "media" => $media,
            "text" => $message_responce,
            "callbackUrl"=>$call_backURL,
            "callbackHttpMethod"=>"GET",
            "callbackTimeout"=>"10000"
          );
    
    // encoding object
    $postDataJson = json_encode($message);

       $ch = curl_init();
      $header = array("Content-Type:application/json", "Accept:application/json");

      curl_setopt($ch, CURLOPT_URL, $postUrl);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJson);

      // response of the POST request
      $response = curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $responseBody = json_decode($response);
      curl_close($ch);
}

function saveImageFromURLWithCURL($userId,$basename_of_mms,$username,$password)
{


//  url get from Bandwidth Media download
 $url = "https://api.catapult.inetwork.com/v1/users/".$userId."/media/".$basename_of_mms;
 //image file directory.........
$saveto = 'views/besma/assets/images/sms-chatting-app/'.$basename_of_mms;

 // $createScriptFile = fopen("test-incoming_pic_responce-check.txt",'w');
 //                        fwrite($createScriptFile,"url = ".$url);
 //                        fwrite($createScriptFile,"saveto id = ".$saveto);

 //                        fclose($createScriptFile);

 $ch = curl_init ($url); // initiat CURL
  curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password); // Set Username ANd Password
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    $raw=curl_exec($ch);
    curl_close ($ch);

// if this file exist then delte this file from the directory
    if(file_exists($saveto)){
        unlink($saveto);
    }

    // Download And save image into the saveto directory................
    $fp = fopen($saveto,'x');
    fwrite($fp, $raw);
    fclose($fp);


    return $saveto;

}
