  $call_backURL = $call_back_url_client."/sms-chatting-module/sms-chatting-app.php";

                $chatting_sms = sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$final_send_reply,$call_backURL);
............................................................


function sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$final_send_reply,$call_backURL="test-bandwidth-call-back.php")
{
    $postUrl = "https://api.catapult.inetwork.com/v1/users/".$userId."/messages";
    $message = array(
            "from" => $chatting_from,
            "to" => $chatting_to,
            "text" => $final_send_reply,
            "callbackUrl"=>$call_backURL,
            "callbackHttpMethod"=>"GET",
            "callbackTimeout"=>"10000"
          );
    // $postData = array("messages" => array($message));

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
