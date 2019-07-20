<?php 
ini_set('display_errors','1');
error_reporting(E_ALL);

// include("class/ChattingAppClass.php");

// $cc = new ChattingAppClass();


$response_receive = $_GET;

$createFile = fopen("sms-get_responce",'w');
 
   foreach ($response_receive as $key => $value) 
  {
  fwrite($createFile,"Key[".$key."] =>"."Value[".$value."]"."\n");
  }
  fclose($createFile);


// date_default_timezone_set('Asia/Dhaka');
// $current_time = date('Y-m-d H:i:s');


if(empty($response_receive))
{

         $createFile = fopen("sms-not-responce",'w');

            fwrite($createFile," responce not happend");
            fclose($createFile);



    // $sms_chatting_existence = $cc->sms_chatting_exist_or_not();


    // if($sms_chatting_existence != FALSE)
    // { // 10.10
     
    //       $sltSentSms = $cc->selectExistingChatFollowSomeConditon("sent",'0');

    //       $differenceInSeconds = timeDifference($current_time,$sltSentSms['chatting_datetime']);

           

    //       if($differenceInSeconds > KEEP_ALIVE_TIME_DIFF)
    //       { // 11.13
    //         // CON: If time difference grater then fixed time then Keep alive message send

    //         $chatting_id = $sltSentSms['sltSentSms'];
    //         $campaign_id = $sltSentSms['campaign_id'];
    //         $chatting_from  = $sltSentSms['chatting_from'];
    //         $chatting_to   = $sltSentSms['chatting_to'];
    //         $keep_alive_counter   = $sltSentSms['keep_alive_counter'];
    //         $chatting_block   = $sltSentSms['chatting_block'];

    //         // cullect rand() keep alive message from DB........

    //           $alive_responce = $cc->keepAliveRandResponseMessageFromDB($campaign_id);

    //           $final_send_reply = smsReplyResponceManage($alive_responce);

    //          $stringLength = strlen($final_send_reply);
    //          $secound = ($stringLength*0.5);
    //         // sleep($secound);




    //          $createFile = fopen("sms-keep_alive-responce.txt",'w');
    //         fwrite($createFile,'final_send_reply='.$final_send_reply."\n");
    //         fwrite($createFile,"grater then 5 min");
    //         fclose($createFile);
    //       } // 11.13
    //       else
    //       { // 11.14
             
    //          // Con: if time difference is less then fixed time the no keep alive message sent to user..............
    //         // no task happend
    //       } // 11.14

      

    // } //10.10
    // else
    // { // 11.11


    // } //1 11.11


}
else
{ // 11.16

// message sent and get responce.................................

             $createFile = fopen("sms-responce",'w');

            fwrite($createFile," responce happend");
            fclose($createFile);


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
