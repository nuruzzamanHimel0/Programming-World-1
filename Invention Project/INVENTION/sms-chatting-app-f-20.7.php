<?php 
ini_set('display_errors','1');
error_reporting(E_ALL);
// get receive message Response
$response_receive = $_GET;
// DBATABASE CONFIG AND CREATE.................
require '../AppConfig.php';
require '../AllFuncion.php';
try {
    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}


// FIRST. responce check............
if(isset($response_receive) AND !empty($response_receive))
{

  date_default_timezone_set('Asia/Dhaka');
  $current_time = date('Y-m-d H:i:s');

  $userId = API_USERID;
  $username = API_TOKEN;
  $api_id =API_APP_ID;
  $password = API_SECRETE;
// file create and show for test.............................
 $createFile = fopen("sms-conversation.txt",'w');
  foreach ($response_receive as $key => $value) 
  {
  fwrite($createFile,"Key[".$key."] =>"."Value[".$value."]"."\n");
  }
  fclose($createFile);

   
    $from_num = $response_receive['from'] ;
      $to_num = $response_receive['to'];
      $messageId  = $response_receive['messageId'];
      $state  = $response_receive['state']; // sent, receive
      $eventType  = $response_receive['eventType']; // SMS

    if(isset($response_receive['text']) AND !empty($response_receive['text']) AND strtolower($response_receive['eventType']) == "sms" )
    {
      
       $text_body  = strtolower($response_receive['text']);
    }
    else if( strtolower($response_receive['eventType']) == "mms" )
    {
      $text_body  = strtolower($response_receive['text']);
      $fullurl = $response_receive['media'];
      $basename_of_mms = basename($fullurl);
      $basename_of_mms = str_replace("]", " ", $basename_of_mms);
      $basename_of_mms = trim($basename_of_mms);
    }
  


//  WORK ALL RECEIVE MESSAGE.............................
if(isset($state) AND $state == "received" )
{


        $sql = "SELECT * FROM sms_chatting_app WHERE chatting_from = :to_num AND chatting_to = :from_num ORDER BY id DESC LIMIT 1 " ;
        $stmt =$dbh->prepare($sql);
        $stmt->execute(array(":to_num"=>$to_num,":from_num"=> $from_num));

        $numberExistOrNot_fetch = $stmt->fetch();

// *** FIRST TIME MESSAGE COME AND ALSO CHECK FROM AND TO NUMBER ( EXIST OR NOT)...........................
       // 5. numberExistOrNot start..............................
       if($stmt->rowCount() <= 0)
       { // 12.22

            // ****[GET] generate chatting_id.................
         $chatting_id = substr(md5(time()),0,6);
           // get campaign_id using FROM_NUMBER...............................
         $query = "SELECT * FROM sms_campaign ";
         $sltSCstmt = $dbh->prepare($query);
         $sltSCstmt->execute();
         if($sltSCstmt->rowCount() > 0)
         {
    // FIND PHONE NUMBER FROM "SMS_CAMPAIGN" TABLE FOR GET campaign_id....................................
            while ($value = $sltSCstmt->fetch()) 
            {
              // $CNstrTOarry = array();
              $CNstrTOarry = explode(",",$value['campaign_numbeers'] );

              if(in_array($to_num, $CNstrTOarry))
              {
                // *****[GET] find campaign id.................................
                $campaign_id = $value['id'];
                break;
              }

            }
         }

    // GET RESIEVE MESSAGE AND STORE DB. THIS TIME TO REPLY MESSAGE.....................
           
         $query = "INSERT INTO sms_chatting(chatting_id) VALUES(?) ";
         $schStmt = $dbh->prepare($query);
         $schStmt->execute(array($chatting_id));
         $lastInsertId = $dbh->lastInsertId();
         $fetch_sms_cht = $schStmt->fetch();
     
         $from_num = $response_receive['from'] ;
      $to_num = $response_receive['to'];
      $messageId  = $response_receive['messageId'];
      $state  = $response_receive['state'];
      $eventType  = $response_receive['eventType'];

         //4. FIRST INSERT INTO sms_chatting  Start.....................
         if($schStmt->rowCount() > 0)
         {

            $sql = "INSERT INTO sms_chatting_app(chatting_id,messageId,campaign_id ,chatting_from,chatting_to,chatting_text,chatting_state,chatting_datetime) VALUES(?,?,?,?,?,?,?,?)";
            $stmt_finsert = $dbh->prepare($sql);
            $stmt_finsert->bindParam("1",$lastInsertId);
            $stmt_finsert->bindParam("2",$messageId);
       
            $stmt_finsert->bindParam("3",$campaign_id);
            $stmt_finsert->bindParam("4",$to_num);
            $stmt_finsert->bindParam("5",$from_num);
            $stmt_finsert->bindParam("6",$text_body);
            $stmt_finsert->bindParam("7",$state);
            $stmt_finsert->bindParam("8",$current_time);

            $stmt_exe = $stmt_finsert->execute();
            $lstId_sms_chating = $dbh->lastInsertId();
            // 3. get lastInsertId() ito sms chatting_app start.............
            if($stmt_exe)
            { // 12.20

    // MESSAGE REPLAY PROCESS Start. After Insert data into sms-chatting-app get DB, select all data using lastInsertInd() function...................................................

  //.................................. FOR FIRST TIME IF ANY NUMBER NOT EXIST INTO THE DB ................................................................................................................................................................................................................
            $query = "SELECT * FROM sms_chatting_app WHERE id = :id ";
             $slt_stmt = $dbh->prepare($query);
             $slt_stmt->execute(array(":id"=>$lstId_sms_chating));

             $slt_chatting_app_fetch = $slt_stmt->fetch();

             // sms_chatting and sms_chatting_app update and get value form sms_chatting_app for responce message......................

               if($slt_chatting_app_fetch)
               { // 12.15
                 $campaign_id = $slt_chatting_app_fetch['campaign_id'];
                 $search_name = strtolower($slt_chatting_app_fetch['chatting_text']);
                 $chatting_from = $slt_chatting_app_fetch['chatting_from'];
                 $chatting_to = $slt_chatting_app_fetch['chatting_to'];


                // FIRST:1. first keyword check using |keyword| (KEYWORD SEARCH START)...............................

                if(strtolower($response_receive['eventType']) == "sms")
                 { //11.14

                       $query = "SELECT * FROM sms_keywords WHERE campaign_id LIKE ? AND key_keyword LIKE ?";
                $keyword_stmt = $dbh->prepare($query);
                $keyword_stmt->execute(array("%$campaign_id%", "%$search_name%"));

                // FIRST-KEYWORD-check (START): IF KEYWORD FOUND ..................................
                if($keyword_stmt->rowCount() > 0)
                { // 12.2
                    $sms_keywords_fetch = $keyword_stmt->fetch();
                    $key_response = $sms_keywords_fetch['key_response'];
                    // Keyword responce ready string to array then array to string convert for reply
                    $final_send_reply = smsReplyResponceManage($key_response);

                 
                    // check %city% exist or not in the string..... if find city into the string then using api to find city name
                  if (preg_match('/\bcity\b/', $final_send_reply)) 
                  {
                        $final_send_reply = replaceCity_nameUsingAPIFuncton($final_send_reply,$userId,$username,$password,$api_id,$chatting_from);    

                  }
                  // send message......................................................
                  // Program hole few secound accourding to reply message(par word count 0.5 s)for send sms..................
                  $stringLength = strlen($final_send_reply);
                  $secound = ($stringLength*0.5);
                  // sleep($secound);

                  $call_backURL = "http://inventionbots.com/admin/sms-chatting-app.php";
                  $chatting_sms = sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$final_send_reply,$call_backURL);

                  }  // 12.2
                  else
                  { // 12.3

                                        // SECOND-SCRIPT-CHECK  (START)

                     $query = "SELECT * FROM sms_script WHERE campaign_id = :campaign_id ORDER BY RAND() LIMIT 1";
                     $script_stmt = $dbh->prepare($query);
                     $script_stmt->execute(array(":campaign_id"=>$campaign_id));
                     if($script_stmt->rowCount() > 0)
                     {

                      $sms_script_fetch = $script_stmt->fetch();
                      $script_response = $sms_script_fetch['script_name'];
                  
                     // Keyword responce ready string to array then array to string convert for reply
                      $final_send_reply = smsReplyResponceManage($script_response);

                        $createScriptFile = fopen("test-script-check.txt",'w');
                      // foreach ($response_receive as $key => $value) 
                      // {
                      // fwrite($createScriptFile,"Key[".$key."] =>"."Value[".$value."]"."\n");
                      // }
                      fwrite($createScriptFile,"Reply = ".$final_send_reply);
                      fwrite($createScriptFile,"Campaign id = ".$campaign_id);

                      fclose($createScriptFile);
                   
                
                      // Program hole few secound accourding to reply message(par word count 0.5 s)for send sms..................
                      $stringLength = strlen($final_send_reply);
                      $secound = ($stringLength*0.5);
                      // sleep($secound);

                       $udtQuery = "UPDATE sms_chatting_app SET script_counter = ? WHERE id =? ";
                      $udtSC_stmt = $dbh->prepare($udtQuery);
                      $udtSC_stmt->execute(array("1",$lstId_sms_chating));

                      $call_backURL = "http://inventionbots.com/admin/sms-chatting-app.php";
                      $chatting_sms = sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$final_send_reply,$call_backURL);

                     


                     }

                  } //12.3


                 } // 11.14

                 elseif(strtolower($response_receive['eventType']) == "mms")
                 { // 11.41

            $saveto = saveImageFromURLWithCURL($userId,$basename_of_mms,$username,$password);

            $udtQuery = "UPDATE sms_chatting_app SET chatting_text = ? WHERE id =? ";
                        $udt_stmt = $dbh->prepare($udtQuery);
                        $udt_img_name = $udt_stmt->execute(array($saveto,$lstId_sms_chating));

                         if($udt_img_name)
                         { //11.3

                $query = "SELECT * FROM sms_incmig_pic WHERE campaign_id = :campaign_id ORDER BY RAND() LIMIT 1";
                 $img_stmt = $dbh->prepare($query);
                 $img_stmt->execute(array(":campaign_id"=>$campaign_id));
                 if($img_stmt->rowCount() > 0)
                 { // 11.2


                  $sms_img_fetch = $img_stmt->fetch();
                  $img_response = $sms_img_fetch['imp_msg'];


                   // Keyword responce ready string to array then array to string convert for reply
                  $final_send_reply = smsReplyResponceManage($img_response);

                   
              
                  // Program hole few secound accourding to reply message(par word count 0.5 s)for send sms..................
                  $stringLength = strlen($final_send_reply);
                  $secound = ($stringLength*0.5);
                  // sleep($secound);

                  $call_backURL = "http://inventionbots.com/admin/sms-chatting-app.php";
                  $chatting_sms = sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$final_send_reply,$call_backURL);

                  } //11.2


                         } // 11.3





                 } // 11.41
          
               }  // 12.15
         
              } // 12.20
        // 3. get lastInsertId() ito sms chatting_app Close.............


           }    //4. FIRST INSERT INTO sms_chatting  Close.....................
        
       }  // 12.22 
      
       else
       { 
       
        // Receive Message Block or not check.................................
        // not-block-check (start)...............
        if($stmt->rowCount()>0 AND $numberExistOrNot_fetch['chatting_block'] <= 0)
        {
           // Cullect Previous DB value for next work
          $chatting_id = $numberExistOrNot_fetch['chatting_id'];
          $campaign_id = $numberExistOrNot_fetch['campaign_id'];
          $chatting_msg_id = $response_receive['messageId'];
          $chatting_from = $response_receive['to'];
          $chatting_to =$response_receive['from'];

          $chatting_state = $response_receive['state'];
      
          $keep_alive_counter = $numberExistOrNot_fetch['keep_alive_counter'];
          $script_counter = $numberExistOrNot_fetch['script_counter'];
          $chatting_block = $numberExistOrNot_fetch['chatting_block'];

          if(isset($response_receive['text']) AND !empty($response_receive['text']) AND strtolower($response_receive['eventType']) == "sms" )
          {
             $chatting_text  = strtolower($response_receive['text']);
          }
          else if( strtolower($response_receive['eventType']) == "mms" )
          {
            $chatting_text  = strtolower($response_receive['text']);
            $fullurl = $response_receive['media'];
            $basename_of_mms = basename($fullurl);
            $basename_of_mms = str_replace("]", " ", $basename_of_mms);
            $basename_of_mms = trim($basename_of_mms);
          }


           $sql = "INSERT INTO sms_chatting_app(chatting_id,messageId,campaign_id ,chatting_from,chatting_to,chatting_text,chatting_state,keep_alive_counter,script_counter,chatting_block,chatting_datetime) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
            $stmt_int_reciv = $dbh->prepare($sql);
            $stmt_int_reciv->bindParam("1",$chatting_id);
            $stmt_int_reciv->bindParam("2",$chatting_msg_id);
            $stmt_int_reciv->bindParam("3",$campaign_id);
            $stmt_int_reciv->bindParam("4",$chatting_from);
            $stmt_int_reciv->bindParam("5",$chatting_to);
            $stmt_int_reciv->bindParam("6",$chatting_text);
            $stmt_int_reciv->bindParam("7",$chatting_state);
            $stmt_int_reciv->bindParam("8",$keep_alive_counter);
            $stmt_int_reciv->bindParam("9",$script_counter);
            $stmt_int_reciv->bindParam("10",$chatting_block);
            $stmt_int_reciv->bindParam("11",$current_time);

            $stmt_exe_reeiv = $stmt_int_reciv->execute();
            $lstId_sms_chating_app = $dbh->lastInsertId();

            if($stmt_exe_reeiv)
            { // 7.1 


               // MESSAGE REPLAY PROCESS Start. After Insert data into sms-chatting-app get DB, select all data using lastInsertInd() function...................................................
              $query = "SELECT * FROM sms_chatting_app WHERE id = :id ";
               $slt_stmt = $dbh->prepare($query);
               $slt_stmt->execute(array(":id"=>$lstId_sms_chating_app));

               $slt_chatting_app_fetch_byId = $slt_stmt->fetch();
         
         // IF from and to number exist into the DB then SMS reply happend from this place........................................................................................................................................................................................................................................................................

               if($slt_chatting_app_fetch_byId)
               { // 7.2 

                $id = $slt_chatting_app_fetch_byId['id'];
                $campaign_id = $slt_chatting_app_fetch_byId['campaign_id'];
                   $search_name = strtolower($slt_chatting_app_fetch_byId['chatting_text']);
                   $chatting_from = $slt_chatting_app_fetch_byId['chatting_from'];
                   $chatting_to = $slt_chatting_app_fetch_byId['chatting_to'];
                   $script_counter_increment = $slt_chatting_app_fetch_byId['script_counter'];
                   $keep_alive_counter_increment = $slt_chatting_app_fetch_byId['keep_alive_counter'];

                   // If this conditon can true then reveive sms will reply other wise this conversation can be block
                   if($script_counter_increment <= '3' AND $keep_alive_counter_increment <= '6')
                   { // 7.6


                if(strtolower($response_receive['eventType']) == "sms")
                { //11.9

                  // FIRST:1. first keyword check using |keyword| (KEYWORD SEARCH START)...............................

                $query = "SELECT * FROM sms_keywords WHERE campaign_id LIKE ? AND key_keyword LIKE ?";
                $keywordStmt = $dbh->prepare($query);
                $keywordStmt->execute(array("%$campaign_id%", "%$search_name%"));

                 // FIRST-KEYWORD-check (START): IF KEYWORD FOUND ..................................
                if($keywordStmt->rowCount() > 0)
                { // 7.3
              //..........................TEST............................
               $createFile = fopen("test-else-keyword.txt",'w');

  fwrite($createFile,"test-else-keyword.txt");
  
  fclose($createFile);

                  $sms_keywords_fetch = $keywordStmt->fetch();
                  $key_response = $sms_keywords_fetch['key_response'];
                  // Keyword responce ready string to array then array to string convert for reply
                  $final_send_reply = smsReplyResponceManage($key_response);

                 
                  // check %city% exist or not in the string..... if find city into the string then using api to find city name
                if (preg_match('/\bcity\b/', $final_send_reply)) 
                {
                    $final_send_reply = replaceCity_nameUsingAPIFuncton($final_send_reply,$userId,$username,$password,$api_id,$chatting_from);    

                }
                // send message......................................................
                // Program hole few secound accourding to reply message(par word count 0.5 s)for send sms..................
                $stringLength = strlen($final_send_reply);
                $secound = ($stringLength*0.5);
                // sleep($secound);

                $call_backURL = "http://inventionbots.com/admin/sms-chatting-app.php";
                $chatting_sms = sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$final_send_reply,$call_backURL);

                } //7.3
                else
                { //7.4
        
           $createFile = fopen("test-else-else-script.txt",'w');

  fwrite($createFile,"test-else-else-script.txt");
  
  fclose($createFile);
  
                  // SECOND-SCRIPT-CHECK  (START)
                   $query = "SELECT * FROM sms_script WHERE campaign_id = :campaign_id ORDER BY RAND() LIMIT 1";
                   $scriptStmt = $dbh->prepare($query);
                   $scriptStmt->execute(array(":campaign_id"=>$campaign_id));

                   if($scriptStmt->rowCount()>0)
                   { // 7.5

                  $sms_script_fetch = $scriptStmt->fetch();
                  $script_response = $sms_script_fetch['script_name'];

                   // Keyword responce ready string to array then array to string convert for reply
                  $final_send_reply = smsReplyResponceManage($script_response);
                

                  // Program hole few secound accourding to reply message(par word count 0.5 s)for send sms..................
                  $stringLength = strlen($final_send_reply);
                  $secound = ($stringLength*0.5);
                  // sleep($secound);

                  // if send response from script then script_counter can be increase into current insert reveive sms in Database
                   $udtQuery = "UPDATE sms_chatting_app SET script_counter = ? WHERE id =? ";
                  $udtSC_stmt = $dbh->prepare($udtQuery);
                  $script_counter_increment = $script_counter_increment+1;
                  $udtSC_stmt->execute(array($script_counter_increment,$id));

                  $call_backURL = "http://inventionbots.com/admin/sms-chatting-app.php";
                  $chatting_sms = sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$final_send_reply,$call_backURL);

                   

                   } //7.5



                  }//7.4


                } //11.9
                         elseif(strtolower($response_receive['eventType']) == "mms")
                        { // 11.10

                          $saveto = saveImageFromURLWithCURL($userId,$basename_of_mms,$username,$password);

                        $udtQuery = "UPDATE sms_chatting_app SET chatting_text = ? WHERE id =? ";
                        $udtStmt = $dbh->prepare($udtQuery);
                        $udtImgName = $udtStmt->execute(array($saveto,$id));

                        if($udtImgName)
                        {// 11.11

                           $query = "SELECT * FROM sms_incmig_pic WHERE campaign_id = :campaign_id ORDER BY RAND() LIMIT 1";
                           $img_stmt = $dbh->prepare($query);
                           $img_stmt->execute(array(":campaign_id"=>$campaign_id));
                           if($img_stmt->rowCount() > 0)
                           { // 11.13


                                $sms_img_fetch = $img_stmt->fetch();
                                $img_response = $sms_img_fetch['imp_msg'];

                              


                               // Keyword responce ready string to array then array to string convert for reply
                                $final_send_reply = smsReplyResponceManage($img_response);

                                 
                             
                                // if (preg_match('/\bcity\b/', $final_send_reply)) 
                                // {
                                //       $final_send_reply = replaceCity_nameUsingAPIFuncton($final_send_reply,$userId,$username,$password,$api_id,$chatting_from);    

                                // }

                                // Program hole few secound accourding to reply message(par word count 0.5 s)for send sms..................
                                $stringLength = strlen($final_send_reply);
                                $secound = ($stringLength*0.5);
                                // sleep($secound);

                                $call_backURL = "http://inventionbots.com/admin/sms-chatting-app.php";
                                $chatting_sms = sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$final_send_reply,$call_backURL);




                            } //11.13

                          }

                        } // 11.10



                   } //7.6
                   else
                   { // 7.7 blcok this conversation

                    // get block message

                    $udtQuery = "UPDATE sms_chatting_app SET chatting_block = ? WHERE id =? ";
                            $block_stmt = $dbh->prepare($udtQuery);
                            $block_stmt->execute(array('1',$id));

                            $call_backURL = "http://inventionbots.com/admin/sms-chatting-app.php";
                            $final_send_reply = "Sorry, You are block for this campaign.";
                            $chatting_sms = sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$final_send_reply,$call_backURL);

                   }



               } // 7.2

            } // 7.1 (close)




        }  // not-block-check (End)...............


       } /// 6. Existing-FROM AND TO NUMBEWR (END)


} //receive first close tag......................................


// GET SENT SMS RESPONSE..................................

      if(isset($state) AND $state == "sent")
      {

          $condQuery = "SELECT * FROM sms_chatting_app WHERE messageId = :messageId ";
          $cond_stmt = $dbh->prepare($condQuery);
          $cond_stmt->bindParam(":messageId",$messageId);
          $cond_stmt->execute();

        // messageId not found ito the DB the work this condition...............
          // 1st : cond start.....
          if($cond_stmt->rowCount() <= 0)
          {
             $sql = "SELECT * FROM sms_chatting_app WHERE chatting_from = :from_num AND chatting_to = :to_num ORDER BY id DESC LIMIT 1 " ;
              $stmt =$dbh->prepare($sql);
              $stmt->execute(array(":from_num"=> $from_num,":to_num"=>$to_num));

                $send_sms_fetch = $stmt->fetch();

                if($stmt->rowCount()>0 AND $send_sms_fetch['chatting_block'] <=0)
                {
                  

                  $chatting_id = $send_sms_fetch['chatting_id'];
                  $campaign_id = $send_sms_fetch['campaign_id'];
                  $keep_alive_counter = $send_sms_fetch['keep_alive_counter'];
                  $script_counter = $send_sms_fetch['script_counter'];
                  $chatting_block = $send_sms_fetch['chatting_block'];

                  $chatting_from = $from_num;
                  $chatting_to = $to_num;
                  $chatting_text = $text_body;
                  $chatting_state = $state;
                  $messageId = $messageId;

  // Message Repoly stroe into sms_chatting_app.php Database
                  $sql = "INSERT INTO sms_chatting_app(chatting_id,messageId,campaign_id ,chatting_from,chatting_to,chatting_text,chatting_state,keep_alive_counter,script_counter,chatting_block,chatting_datetime) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt_sms_app_snt = $dbh->prepare($sql);
                    $stmt_sms_app_snt->bindParam("1",$chatting_id);
                    $stmt_sms_app_snt->bindParam("2",$messageId);
                    $stmt_sms_app_snt->bindParam("3",$campaign_id);
                    $stmt_sms_app_snt->bindParam("4",$chatting_from);
                    $stmt_sms_app_snt->bindParam("5",$chatting_to);
                    $stmt_sms_app_snt->bindParam("6",$chatting_text);
                    $stmt_sms_app_snt->bindParam("7",$chatting_state);
                    $stmt_sms_app_snt->bindParam("8",$keep_alive_counter);
                    $stmt_sms_app_snt->bindParam("9",$script_counter);
                    $stmt_sms_app_snt->bindParam("10",$chatting_block);
                    $stmt_sms_app_snt->bindParam("11",$current_time);

                    $stmt_exe = $stmt_sms_app_snt->execute();


                }
            
              


          } // 1st : cond END.....


      } 
    

} // FIRST.responce_receive END close.........................................


$fileOpen = fopen('sms-conversation.txt','r');
while (!feof($fileOpen)) 
{
  echo fgets($fileOpen,filesize('sms-conversation.txt'))."<br>";
}
fclose($fileOpen);


?>




