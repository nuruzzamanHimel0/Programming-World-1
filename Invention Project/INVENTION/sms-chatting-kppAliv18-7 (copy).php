<?php 
ini_set('display_errors','1');
error_reporting(E_ALL);

include("class/ChattingAppClass.php");

$cc = new ChattingAppClass();


$response_receive = $_GET;

$createFile = fopen("sms-get_responce",'w');
 
   foreach ($response_receive as $key => $value) 
  {
  fwrite($createFile,"Key[".$key."] =>"."Value[".$value."]"."\n");
  }
  fclose($createFile);


date_default_timezone_set('Asia/Dhaka');
$current_time = date('Y-m-d H:i:s');

 $userId = API_USERID;
  $username = API_TOKEN;
  $api_id =API_APP_ID;
  $password = API_SECRETE;


if(!isset($response_receive['eventType']) AND $response_receive['state'] != 'sent')
{

         // $createFile = fopen("sms-responce",'w');
         //    fwrite($createFile," responce not happend");
         //    fclose($createFile);



    $sms_chatting_existence = $cc->sms_chatting_exist_or_not();


    if($sms_chatting_existence != FALSE)
    { // 10.10
     
        $sltSentSms = $cc->selectExistingChatFollowSomeConditon("sent",'0');
            // $app_id = $sltSentSms['id'];
            $chatting_id = $sltSentSms['chatting_id'];
            $campaign_id = $sltSentSms['campaign_id'];
            $chatting_from  = $sltSentSms['chatting_from'];
            $chatting_to   = $sltSentSms['chatting_to'];
            $chatting_text   = $sltSentSms['chatting_text'];
            $keep_alive_counter   = $sltSentSms['keep_alive_counter'];
            $script_counter   = $sltSentSms['script_counter'];
            $chatting_block   = $sltSentSms['chatting_block'];

        if(isset($sltSentSms) AND $sltSentSms['chatting_block'] <= '0')
        { //11.19

            if($keep_alive_counter <= '6')
            { // 13.10

     $differenceInSeconds = timeDifference($current_time,$sltSentSms['chatting_datetime']);
                if($differenceInSeconds > KEEP_ALIVE_TIME_DIFF)
                { // 11.13
                  // CON: If time difference grater then fixed time then Keep alive message send

                  // cullect rand() keep alive message from DB........

                  // if time difference is grater then keep alive then keep alive variable increment

                  $keep_alive_counter = $keep_alive_counter+1;

                    $alive_responce = $cc->keepAliveRandResponseMessageFromDB($campaign_id);

                    $final_send_reply = smsReplyResponceManage($alive_responce);

                   $stringLength = strlen($final_send_reply);
                   $secound = ($stringLength*0.5);
                  // sleep($secound);

 $createFile = fopen("sms-keep_alive-responce.txt",'w');
fwrite($createFile,'final_send_reply='.$final_send_reply."\n");
fwrite($createFile,"keep alive counter incremnt: ".$keep_alive_counter);
fclose($createFile);
            
            // DB INSERT.............................................
                    $udt_DB = $cc->keepAliveMesgSndAndDBInsertData($chatting_id,$campaign_id,$chatting_from,$chatting_to,$final_send_reply,$keep_alive_counter,$script_counter,$chatting_block,$current_time);

             // SMS SEND................................
                    $call_backURL = "http://inventionbots.com/admin/sms-chatting-app-keepAlive.php";
                  $chatting_sms = sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$final_send_reply,$call_backURL);




                } // 11.13
              

            } // 13.10 // keep-alive-counter less then 4
            else
            {

              // $cc->blockConversationKeepAliveCounterReash();


            } // block last camapign conversation

         

        } // 11.19 // block checking

    } //10.10
    else
    { // 11.11


    } //1 11.11


}
else
{ // 11.16

// message sent and get responce.................................

            

  $createFile = fopen("sms-sent-get-responce",'w');
 
   foreach ($response_receive as $key => $value) 
  {
  fwrite($createFile,"Key[".$key."] =>"."Value[".$value."]"."\n");
  }
  fclose($createFile);



            $msgIdCheck = $cc->checkResponceMsgIdExistOrNot($response_receive['messageId']);

            if($msgIdCheck != FALSE)
            {
             $lastRowFetch = $cc->lastRowOfChtAppWithFrmToNumber($response_receive['from'],$response_receive['to']);

                if($lastRowFetch)
                {

                       //  $createFile = fopen("sms-else-fetchLast-row.txt",'w');
                       // foreach ($lastRowFetch as $key => $value) 
                       //    {
                       //    fwrite($createFile,"Key[".$key."] =>"."Value[".$value."]"."\n");
                       //    }
                       //    fclose($createFile);

                          $id = $lastRowFetch['id'];
                          $messageId_responce = $response_receive['messageId'];
                          $chatting_state_responce = $response_receive['state'];

                          $udtChaAppUsingResponce = $cc->udtMsgIdAndCsIntoChtApp($id,$messageId_responce,$chatting_state_responce);


                }

                // $createFile = fopen("sms-responce.txt",'w');
                // fwrite($createFile," if condition");
                // fclose($createFile);

            }


} // 11.16


































// output checking from here........................


// $data = date('Y-m-d H:i:s');

//  $createFile = fopen("sms-chatting-app-keepAlive-outside.txt",'w');
 
//   fwrite($createFile,"Outside \n");
//   //  foreach ($sms_chatting_existence as $key => $value) 
//   // {
//   // fwrite($createFile,"Key[".$key."] =>"."Value[".$value."]"."\n");
//   // }
//   // fwrite($createFile,$data);
  
//   fclose($createFile);






?>
