 $str_array['message_responce'] = replaceBotCity_nameUsingAPIFuncton($str_array['message_responce'],$userId,$username,$password,$api_id,$chatting_from);
.................................

function replaceBotCity_nameUsingAPIFuncton($final_send_reply,$userId,$username,$password,$api_id,$chatting_from)
{
      $url = "https://api.catapult.inetwork.com/v1/users/".$userId."/phoneNumbers";
                   
      //Initiate cURL.
      $ch = curl_init($url);
       
      //Specify the username and password using the CURLOPT_USERPWD option.
      curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);  
       
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       
      //Execute the cURL request.
      $response = curl_exec($ch);
      //Check for errors.
      if(curl_errno($ch))
      {
          throw new Exception(curl_error($ch));
      }

      $decode = json_decode($response, true);

      $api_number = array();
  
     foreach ($decode as $value ) 
     {
      if($value['numberState']== 'enabled' AND $value['applicationId']== $api_id AND $value['number'] == $chatting_from )
        {
         $city = $value['city'];
        }

      }

       $final_send_reply = str_replace("%botcity%",$city,$final_send_reply);
       return $final_send_reply;

}
