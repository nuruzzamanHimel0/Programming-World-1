public function sent_message_with_pic_for_keyword_first_time($call_back_url,$outgoing_img_loc,$userId,$username,$password,$chatting_from,$chatting_to,$message_responce)
	{

          $call_backURL = $call_back_url."/sms-chatting-module/sms-chatting-app.php";
          $media = $call_back_url.substr($outgoing_img_loc,2);

          $chatting_sms = sendSMSandMMS_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$message_responce,$media,$call_backURL);
	}

....................................\
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
