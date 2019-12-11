<?php 

function getExistingApplicationAllAPINumber($api_userid,$api_token,$api_secrete,$api_app_id)
{
// 	 $url = "https://api.catapult.inetwork.com/v1/users/".$api_userid."/phoneNumbers";
$url = "https://api.catapult.inetwork.com/v1/users/".$api_userid."/phoneNumbers?applicationId=".$api_app_id."&size=1000&numberState=enabled";
                    //Your username.
                        $username = $api_token;
                         
                        //Your password.
                        $password = $api_secrete;
                         
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

                        $api_number = array();

//   
                       foreach ($decode as $value ) 
                       {
                        if($value['numberState']== 'enabled' AND $value['applicationId']== $api_app_id )
                          {
                            array_push($api_number,$value['number']);
                          }
   
                        }

                        // $arrayToStr = implode(",",$api_number);
                        return $api_number;
}

function url_shotner($long_url,$apikey)
{
 
 
  $domain_data["fullName"] = "rebrand.ly";
  $post_data["destination"] = $long_url;
  $post_data["domain"] = $domain_data;
//$post_data["slashtag"] = "A_NEW_SLASHTAG";
//$post_data["title"] = "Rebrandly YouTube channel";
  $ch = curl_init("https://api.rebrandly.com/v1/links");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "apikey: ".$apikey." ",
      "Content-Type: application/json"
  ));
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
  $result = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($result, true);
  // print "Short URL is: " . $response["shortUrl"];
  return $response["shortUrl"];
}


function message_responce_push_time($message_responce,$responce_push_time)
{
  $stringLength = strlen($message_responce);
  $secound = ($stringLength*$responce_push_time);
  sleep($secound);

}

function  unicode_swap_filter_bypass($message_responce)
{
  $latin_upper_accent = array(
    'A' => 'Á',
    'B' => 'B́',
    'C' => 'Ć',
    'D' => 'D́',
    'E' => 'Ế',
    'G' => 'Ǵ',
    'H' => 'H́',
    'K' => 'Ḱ',
    'N' => 'Ń',
    'U' => 'Ứ',
    'X' => 'X́',
    'Y' => 'Ý',
    'Z' => 'Ź',
    'I' => 'Ī́'

  );

  $latin_lower_accent = array(
    'a' => 'á ',
    'B' => 'b́',
    'c' => 'ć',
    'd' => 'd́',
    'e' => 'é',
    'g' => 'ǵ',
    'h' => 'h́',
    'k' => 'ḱ',
    'n' => 'ń',
    'u' => 'ǘ',
    'x' => 'x́',
    'y' => 'ȳ́',
    'z' => 'ź'
  );

  $message_responce = rander_responce($latin_upper_accent,$message_responce);
  $message_responce = rander_responce($latin_lower_accent,$message_responce);
  return $message_responce;
}

function rander_responce($latin_accent,$message_responce)
{
  foreach ($latin_accent as $key => $value) {
    $message_responce = str_replace($key,$value,$message_responce);
  }
  return $message_responce;
}



function smsReplyResponceManage($key_response)
{
    if(preg_match_all("/{(.*)}/U", $key_response, $matches))
      {

         preg_match_all("/{(.*)}/U", $key_response, $RESLT); 
   
    // COunt multi dimention array
        $typeTotals = array_map("count", $RESLT);
        $totalTickets = array_sum($typeTotals);

        // echo "<br> Count:".$totalTickets."<br>";
        $loop = $totalTickets/2;
        // echo "Multi Dimention loop count: ".$loop."<br>";

        for ($i=0; $i < $loop ; $i++) { 
          // get multidimention array
          $curly_bracket_value = $RESLT[1][$i];
         
          $underScoreReplace = str_replace(" ",'^',$curly_bracket_value);
        
          $key_response = str_replace($curly_bracket_value,$underScoreReplace,$key_response);
          // echo $underScoreReplace."<br>";
        }

        // 5)Then String to arry convert using explode(' ',$responce) function
        $strToarray = explode(' ',$key_response);
        // echo "<pre>";
        // print_r($strToarray);
        // echo "<br>";

        foreach ($strToarray as $key => $value) 
        {
          if(preg_match_all("/{(.*)}/U", $value, $matches))
          {
            // echo "Bracket exist <br>";
            preg_match_all("/{(.*)}/U", $value, $matches);
            // echo $strToarray1 = $matches[1][0];
            // 6)Then create loop and if find [] then take value form [ braket] and explode("|",$array) and insert this arry in to same keyword
            $strToarray1 = explode('|',$matches[1][0]);
            $strToarray[$key] = $strToarray1;

          }
        }

        
        $final_send_reply = " ";

        foreach ($strToarray as  $value) {
            
            if(is_array($value))
            {
              $rand = array_rand($value);
              $word = str_replace("^"," ",$value[$rand]);
              $final_send_reply .= $word." ";
            }
            else{
              $final_send_reply .= $value." ";
            }
        }

        return $final_send_reply;


      }
      else{
        return $key_response;
      }

}

function numberVerify_response($access_key,$to_number)
{
  // return  $final_send_reply." ---- ".$access_key." ------ ".$to_number;

  // Initialize CURL:
$ch = curl_init('http://apilayer.net/api/validate?access_key='.$access_key.'&number='.$to_number.'');  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
return $json;

}


// that is a GET method
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

// POST method will be converted to a get method
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

function sendOnlyMMS_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$media,$call_backURL)
{
  // $abc = "http://inventionbots.com/admin/views/besma/assets/images/campaign_image/cd6f31248.jpg";
    $postUrl = "https://api.catapult.inetwork.com/v1/users/".$userId."/messages";

     $message = array(
            "from" => $chatting_from,
            "to" => $chatting_to,
            "media" => $media,
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
$saveto = '../views/besma/assets/images/sms-chatting-app/'.$basename_of_mms;

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


function timeDifference($current_time,$chatting_datetime)
{
   $secondTime = strtotime($current_time);
      $firstTime = strtotime($chatting_datetime);
      // $lastSendSmsTime = $sltSentSms['chatting_datetime'];
      $differenceInSeconds = $secondTime - $firstTime;
      return $differenceInSeconds;
}


function createLinkFileFUnction($filePath,$campaign_links_txt)
{
  $fileCreate = fopen($filePath,'w');
      fwrite($fileCreate,$campaign_links_txt);
      fclose($fileCreate);
}

function createSecLinkFileFUnction($fileSLinkPath,$campaign_Secondary_Links_txt)
{
  $fileCreate = fopen($fileSLinkPath,'w');
      fwrite($fileCreate,$campaign_Secondary_Links_txt);
      fclose($fileCreate);
}

function currentTime()
{
    date_default_timezone_set('Asia/Dhaka');
  $current_time = date('Y-m-d H:i:s');
  return  $current_time;
}

function formatDate($date)
{
  return date('F j, Y, g:i a',strtotime($date));
  //June 21, 2018, 11:53 am
}

function conversation_number_hide($number_type,$number)
{
  if(trim($number_type) == 'recipiet')
  {
     if(strpos($number,'+1') !== FALSE AND strpos($number,'+1') == '0') // us and canada
     { 
       $number_prefix = "+1";
        $number_area_code = substr($number,2,3);
       
        return $hidden_num = $number_prefix." (".$number_area_code.") xxx-xxxx";
       
     }
      else if(strpos($number,'+44') !== FALSE AND strpos($number,'+44') == '0') // united kingdom
      {
         $number_prefix = "+44";
        $number_area_code = substr($number,3,3);
       
        return $hidden_num = $number_prefix." (".$number_area_code.") xxx-xxxx";
      }
      else if(strpos($number,'+64') !== FALSE AND strpos($number,'+64') == '0')  // new zealand
      {
         $number_prefix = "+64";
        $number_area_code = substr($number,3,3);
       
        return $hidden_num = $number_prefix." (".$number_area_code.") xxx-xxxx";
      }
      else if(strpos($number,'+61') !== FALSE AND strpos($number,'+61') == '0')  // new zealand
      {
         $number_prefix = "+61";
        $number_area_code = substr($number,3,3);
       
        return $hidden_num = $number_prefix." (".$number_area_code.") xxx-xxxx";
      }
      else{
          return $hidden_num = 'Anonymous';
      }

  }
  else if(trim($number_type) == 'bot_number')
  {

     if(strpos($number,'+1') !== FALSE AND strpos($number,'+1') == '0') // us and canada
     { 
        $number_prefix = "+1"; 

        return modify_bot_number($number_prefix,$number);
        
     
        // return $hidden_num = $number_prefix." (".$number_area_code.") xxx-xxxx";
       
     }
      else if(strpos($number,'+44') !== FALSE AND strpos($number,'+44') == '0') // united kingdom
      {
         $number_prefix = "+44"; 

         return modify_bot_number($number_prefix,$number); 
      }
      else if(strpos($number,'+64') !== FALSE AND strpos($number,'+64') == '0')  // new zealand
      {
          $number_prefix = "+64"; 

         return modify_bot_number($number_prefix,$number); 
      }
      else if(strpos($number,'+61') !== FALSE AND strpos($number,'+61') == '0')  // new zealand
      {
         $number_prefix = "+61"; 

         return modify_bot_number($number_prefix,$number); 
      }


  }


}

function modify_bot_number($number_prefix,$number)
{

  if(strpos($number,$number_prefix) !== FALSE AND strpos($number,$number_prefix) == '0') // us and canada
     { 
        $number_area_code = substr($number,2,3);

        $last_part_num = substr($number,5);
        $ln_one = substr($last_part_num,0,3);
        $ln_two = substr($last_part_num,3);
        return $number = $number_prefix." (".$number_area_code.") ".$ln_one."-".$ln_two;
     }
     else if(strpos($number,$number_prefix) !== FALSE AND strpos($number,$number_prefix) == '0') // us and canada
     { 
        $number_area_code = substr($number,3,3);

        $last_part_num = substr($number,6);
        $ln_one = substr($last_part_num,0,3);
        $ln_two = substr($last_part_num,3);
        return $number = $number_prefix." (".$number_area_code.") ".$ln_one."-".$ln_two;
     }
     else if(strpos($number,$number_prefix) !== FALSE AND strpos($number,$number_prefix) == '0') // us and canada
     { 
        $number_area_code = substr($number,3,3);

        $last_part_num = substr($number,6);
        $ln_one = substr($last_part_num,0,3);
        $ln_two = substr($last_part_num,3);
        return $number = $number_prefix." (".$number_area_code.") ".$ln_one."-".$ln_two;
     }
     else if(strpos($number,$number_prefix) !== FALSE AND strpos($number,$number_prefix) == '0') // us and canada
     { 
        $number_area_code = substr($number,3,3);

        $last_part_num = substr($number,6);
        $ln_one = substr($last_part_num,0,3);
        $ln_two = substr($last_part_num,3);
        return $number = $number_prefix." (".$number_area_code.") ".$ln_one."-".$ln_two;
     }

    
}


function get_time_difference($chatting_datetime)
{
  date_default_timezone_set('Asia/Dhaka');

    $current_datetime = date("Y-m-d H:i:s"); 

     $start_date = new DateTime($chatting_datetime);
    $since_start = $start_date->diff(new DateTime($current_datetime));

    return $since_start->h."h ".$since_start->i."m ".$since_start->s."s ";
}


function play_audio_in_active_call_for_DB_first_insert_bandwidth($callId,$userId,$username,$password)
{

  
   $postUrl = "https://api.catapult.inetwork.com/v1/users/".$userId."/calls/".$callId."/audio";
      
       $message = array(
              "fileUrl" => "http://inventionbots.com/client/Audio/female-speech.mp3",
              "volume" => 4
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


function play_audio_in_active_call_bandwidth_DB_file_exist($callId,$userId,$username,$password,$fetch_play_call_2)
{

  
   $postUrl = "https://api.catapult.inetwork.com/v1/users/".$userId."/calls/".$callId."/audio";

    if($fetch_play_call_2['play_audio_call_state'] == 'fileUri')
    {
      $fileUri_volume = $fetch_play_call_2['fileUri_volume'];
      $fileUri = $fetch_play_call_2['fileUri'];

       $message = array(
              "fileUrl" => $fileUri,
              "volume" => $fileUri_volume
            ); 
    }
    else if( $fetch_play_call_2['play_audio_call_state'] == 'sentence' )
    {

        $sentence_txt = $fetch_play_call_2['sentence_txt'];
        $sentence_gender = $fetch_play_call_2['sentence_gender'];
        $sentence_locale = $fetch_play_call_2['sentence_locale'];
        $sentence_voice = $fetch_play_call_2['sentence_voice'];
        $sentence_loop = $fetch_play_call_2['sentence_loop'];
        $sentence_volume = $fetch_play_call_2['sentence_volume']; 


        $message = array(
              "sentence" => $sentence_txt,
              "gender" => $sentence_gender,
              "locale" => $sentence_locale,
              "voice" => $sentence_voice,
              "loopEnabled" => $sentence_loop,
              "volume" => $sentence_volume
            ); 


    }
      
      
    
         

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

function callStatusCompleteAfterVoicePlay($call_back_url_client,$callId,$userId,$username,$password)
{
       $call_backURL = "".$call_back_url_client."/client/sms-chatting-module/call-chatting-app.php";

        $postUrll = "https://api.catapult.inetwork.com/v1/users/".$userId."/calls/".$callId."";

        // $createFile = fopen("sms-callState-done.txt",'w');
        // fwrite($createFile,$callId."\n");
        // fwrite($createFile,$call_backURL."\n");
        // fwrite($createFile,$postUrll."\n");
        // fwrite($createFile,$username."----".$password."\n");
      
        // fclose($createFile);

     $message = array(
              "state" => "completed",
              "callbackUrl"=>$call_backURL
            );
      
      // encoding object
      $postDataJson = json_encode($message);

         $ch = curl_init();
        $header = array("Content-Type:application/json", "Accept:application/json");

        curl_setopt($ch, CURLOPT_URL, $postUrll);
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






?>