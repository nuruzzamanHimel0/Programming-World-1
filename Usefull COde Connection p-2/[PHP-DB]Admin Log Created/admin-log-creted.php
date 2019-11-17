<?php
require 'initapp.php';
require 'class/Project.php';
$pro = new Project();

$self='client-manage.php';
$cmd=_get('_id');

if ($xstage=='Demo'){
     conf("client-manage.php?_clid=$cmd",'e','Editing Profile is disabled in the demo mode');
}

if (isset($_POST['update']))
{

    $fname=_post('fname');
    $lname=_post('lname');
    $company=_post('company');
    $address1=_post('address');
    $address2=_post('address2');
    $website=_post('website');
    $city=_post('city');
    $zip=_post('zipcode');
    $phone=_post('phone');
    $email=_post('email');
    $country=_post('country');
    $emailcheck=ORM::for_table('accounts')->find_one($cmd);
    $cemail=$emailcheck['email'];
    $initpassword=_post('password');
    $rpassword=_post('rpassword');
    $email_access=_post('email_access');
    $sms_access=_post('sms_access');
    $client_status=_post('client_status');
    $client_owner_new_id=_post('client_owner');
    $client_owner_old_id=_post('client_owner_old');
      $emailnotify= "Yes";

    //     echo "fname = ".$fname."<br>";
    // echo "lname = ".$lname."<br>";
    // echo "company = ".$company."<br>";
    // echo "website = ".$website."<br>";
    // echo "address1 = ".$address1."<br>";
    // echo "address2 = ".$address2."<br>";
    // echo "city = ".$city."<br>";
    // // echo "state = ".$state."<br>";
    // echo "zip = ".$zip."<br>";
    // echo "country = ".$country."<br>";
    // echo "phone = ".$phone."<br>";
    // echo "email = ".$email."<br>";
   
    // echo "initpassword = ".$initpassword."<br>";
    // echo "res_owner = ".$client_owner_new_id."<br>";
    // echo "emailnotify = ".$emailnotify."<br>";
  
    // echo "email_access = ".$email_access."<br>";
    // echo "sms_access = ".$sms_access."<br>";

    if ($initpassword=='') 
    {
      $password=$emailcheck['password'];
    }elseif($initpassword!='' AND $initpassword!=$rpassword ){
        conf($self.'?_clid='.$cmd,'e',"Both Password Doesn't Match");
    }
    else{
          $password = md5($secret . $initpassword);
    }

  echo "password = ".$password."<br>";

    //check if a client already exist with the same email id
    if ($email!='' AND $email!=$cemail)
    {
     $cnt = ORM::for_table('accounts')->where('email', $email)->count('id');
     if ($cnt!='0'){
        conf($self.'?_clid='.$cmd,'e',"This Email id already registered with a Client");
      }
    }

  // $pathname='../assets/profile/profile.jpg';
  $date= date('Y-m-d');

// Store Old Database information............................................................................
      $check_Old_data = $pro->checkOwnerAndEmailSmsParm($cmd);

      if($check_Old_data['client_owner'] != '0')  // WHEN client_owner are reseller
      {
        $old_db_result = $pro->selectOldDbInfoByid($cmd);

        $old_db_result = $pro->change_reseller_eml_sms_param($old_db_result);
      }
       else if($check_Old_data['client_owner'] == '0') // when client_ownder are BOT
      {
        $old_db_result = $pro->selectOldDbInfoByidClint_owner_zero($cmd);

        $old_db_result = $pro->change_default_eml_sms_param($old_db_result);
      }
      // echo "OLD DB FETCH RESTUL: <pre>";
      // print_r($old_db_result);
      // echo "</pre>";
      
      if($old_db_result)
      {

          // $varify_code = substr(md5(time()),0,6);
          $upt_account_info = $pro->update_account_table_by_id($fname,$lname,$company,$website,$client_owner_new_id,$email,$address1,$address2,$city,$zip,$country,$phone,$password,$date,$email_access,$sms_access,$client_status,"0",$cmd);

          if($upt_account_info != FALSE)
          {  //66666666

             $check_update = $pro->checkOwnerAndEmailSmsParm($cmd);

            if($check_update['client_owner'] != '0')
            {
                $new_db_result = $pro->selectNewDbInfoByid($cmd);

                $new_db_result = $pro->change_reseller_eml_sms_param($new_db_result);

            }
            else if($check_update['client_owner'] == '0')
            {
                  $new_db_result = $pro->selectNewDbInfoByidClint_owner_zero($cmd);

                $new_db_result = $pro->change_default_eml_sms_param($new_db_result);

            }
             // echo "UPDATEE FETCH RESULT: <pre>";
             //    print_r($new_db_result);

            // DATA CHECK AND LOG STORE.................. there have old and  new log.....
              $change_log_store_value = array();
              $old_log_store_value = array();

              foreach ($old_db_result as $key => $value) 
              {
                if($old_db_result[$key] != $new_db_result[$key])
                {
                  $old_log_store_value[$key] = $old_db_result[$key];
                  $change_log_store_value[$key] = $new_db_result[$key];
                  
                }
              }

              // echo "<br> old log <pre> ";
              // print_r($old_log_store_value);

              // echo "<br> change log <pre> ";
              // print_r($change_log_store_value);
              // 
               // create a string TEMPLATE..............................................................................................................................................................
              $result = " ";
              $result .= "Client Modified. ";
              $result .= "Information Updated where ";
             
              foreach ($old_log_store_value as $key => $value) {
                    $result .= "{{".$key."}} : '".$old_log_store_value[$key]."' To '".$change_log_store_value[$key]."', ";
              }
              // remove last ',' form string template 
              $string_length = strlen($result);
              $template = substr($result,0,$string_length-2);

              $template = $template." Client id : <a href = '".$sysUrl."/admin/client-manage.php?_clid=".$cmd."  '> ".trim($cmd)."</a>";

              // echo $template."<br>";

              ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
              //............................. String template End...................................................................................................................... //
              //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
              

              $data = array(
                "name" => "First Name",
                "lname" => "Last Nmae",
                "company" => "Company",
                "website" => "Website",
                "email" => "Email",
                "address1" => "Address One",
                "address2" => "Address Two",
                "postcode" => "Postcode",
                "city" => "City",
                "country" => "Country",
                "phone" => "Phone",
                 "client_owner" => "Client Owner",
                "email_perm" => "Email Permission",
                "sms_perm" => "SMS Permission",
                "status" => "Status",
                "parent" => "Parent"

              );
              // replace 'kwyword' form template string
              $action = _render($template,$data);
              // echo $action;   


             // LOG CREATED...........................................................
                 $admin_ip = $_SERVER['REMOTE_ADDR'];
                $log_created = $pro->admin_log_created($date,$action,$aid,$admin_ip);
            // LOG CREATED END ............................................................


            // Mail sent.....................................

                if($old_log_store_value['email'] !=  $change_log_store_value['email'] AND $old_log_store_value['client_owner'] ==  $change_log_store_value['client_owner'])
                {

                    //N>B: IF Email change then Update Email and Password will be changed. This Message send to update Email.
                                    
                      $initpassword =substr(md5(time()),0,10);
                       $password = md5($secret . $initpassword);

                       // password Update into the client DB....
                       $password_udt = $pro->only_password_update_client_id($password,$cmd);

                     if ($emailnotify=='Yes')
                      {
                          $sysEmail=appconfig('Email');
                          $sysCompany=appconfig('CompanyName');

                          $companyName = substr($sysCompany,0,strrpos($sysCompany, ' '));

                          $sysUrl= appconfig('sysUrl');
                          $d= ORM::for_table('email_templates')->where('tplname', 'Email And Password Modified')->find_one();

                          $template = $d['message'];
                          $subject = $d['subject'];
                          $send = $d['send'];
                          $data = array('name' => $new_db_result['name']." ".$new_db_result['lname'],
                              'logo'=> ' src="'.$sysUrl.'/assets/uploads/logo.png"',
                              'business_name'=> $sysCompany,
                               'email'=> $email,
                               'password'=> $initpassword,
                               'sys_url' => $sysUrl,
                                "client_designation" => 'Client',
                                 'client_path' => 'client'
                          );

                          $message = _render($template,$data);

                          $mail_subject = _render($subject,$data);

                          $body = $message;

                                  if ($send=='1')
                                  {
                                       require ('../lib/pnp/email/class.phpmailer.php') ;
                                       $mail = new PHPMailer();
                                      $mail->SetFrom($sysEmail, $sysCompany);
                                      $mail->AddReplyTo($sysEmail, $sysCompany);
                                      $mail->AddAddress($email, $new_db_result['name']);
                                      $mail->Subject= $mail_subject;
                                      $mail->MsgHTML($body);
                                      $mail->Send();
                                  }

                    }

                     conf("client-manage.php?_clid=$cmd",'s','Client Modified Successfully.');
// client_owner
                }
                else if($old_log_store_value['client_owner'] !=  $change_log_store_value['client_owner'] AND $old_log_store_value['email'] ==  $change_log_store_value['email'])
                {
                  //N.B: IF only cilent_owner change then Client_owner must be updated and Email must be send to the loosing client_owner Email.
                  
                  echo "<br>Old owner id=".$check_Old_data['client_owner'];

                  if($check_Old_data['client_owner'] == 0)
                  {
                      $admin_info = $pro->get_admin_all_info_byId($aid);

                      $reseller_name =$admin_info['fname']." ".$admin_info['lname'];
                      $email = $admin_info['email'];
                      $client_name = $new_db_result['name']." ".$new_db_result['lname'];
                      $old_reseller = $old_log_store_value['client_owner'];
                      $new_reseller = $change_log_store_value['client_owner'];

                      if ($emailnotify=='Yes')
                      {
                          $sysEmail=appconfig('Email');
                          $sysCompany=appconfig('CompanyName');

                          $companyName = substr($sysCompany,0,strrpos($sysCompany, ' '));

                          $sysUrl= appconfig('sysUrl');
                          $d= ORM::for_table('email_templates')->where('tplname', 'Reseller Change')->find_one();

                          $template = $d['message'];
                          $subject = $d['subject'];
                          $send = $d['send'];
                          $data = array('name' => $reseller_name,
                              'logo'=> ' src="'.$sysUrl.'/assets/uploads/logo.png"',
                              'business_name'=> $sysCompany,
                              'client_name' => $client_name,
                               'old_reseller'=> $old_reseller,
                               'new_reseller'=> $new_reseller,
                               'sys_url' => $sysUrl
                          );

                          $message = _render($template,$data);

                          $mail_subject = _render($subject,$data);

                          $body = $message;

                                  if ($send=='1')
                                  {
                                       require ('../lib/pnp/email/class.phpmailer.php') ;
                                       $mail = new PHPMailer();
                                      $mail->SetFrom($sysEmail, $sysCompany);
                                      $mail->AddReplyTo($sysEmail, $sysCompany);
                                      $mail->AddAddress($email, $new_db_result['name']);
                                      $mail->Subject= $mail_subject;
                                      $mail->MsgHTML($body);
                                      $mail->Send();
                                  }

                    }

                     conf("client-manage.php?_clid=$cmd",'s','Client Modified Successfully.');


                  }
                  else if($check_Old_data['client_owner'] > 0)
                  {
                    // check reseller.......................
                     $reseller_info = $pro->get_reseller_all_info_byId($check_Old_data['client_owner']);

                      $reseller_name =$reseller_info['res_name']." ".$reseller_info['res_lname'];
                      $email = $reseller_info['res_email'];
                      $client_name = $new_db_result['name']." ".$new_db_result['lname'];
                      $old_reseller = $old_log_store_value['client_owner'];
                      $new_reseller = $change_log_store_value['client_owner'];

                      if ($emailnotify=='Yes')
                      {
                          $sysEmail=appconfig('Email');
                          $sysCompany=appconfig('CompanyName');

                          $companyName = substr($sysCompany,0,strrpos($sysCompany, ' '));

                          $sysUrl= appconfig('sysUrl');
                          $d= ORM::for_table('email_templates')->where('tplname', 'Reseller Change')->find_one();

                          $template = $d['message'];
                          $subject = $d['subject'];
                          $send = $d['send'];
                          $data = array('name' => $reseller_name,
                              'logo'=> ' src="'.$sysUrl.'/assets/uploads/logo.png"',
                              'business_name'=> $sysCompany,
                              'client_name' => $client_name,
                               'old_reseller'=> $old_reseller,
                               'new_reseller'=> $new_reseller,
                               'sys_url' => $sysUrl
                          );

                          $message = _render($template,$data);

                          $mail_subject = _render($subject,$data);

                          $body = $message;

                                  if ($send=='1')
                                  {
                                       require ('../lib/pnp/email/class.phpmailer.php') ;
                                       $mail = new PHPMailer();
                                      $mail->SetFrom($sysEmail, $sysCompany);
                                      $mail->AddReplyTo($sysEmail, $sysCompany);
                                      $mail->AddAddress($email, $new_db_result['name']);
                                      $mail->Subject= $mail_subject;
                                      $mail->MsgHTML($body);
                                      $mail->Send();
                                  }

                    }

                     conf("client-manage.php?_clid=$cmd",'s','Client Modified Successfully.');
                  }


                }
                else if($old_log_store_value['client_owner'] !=  $change_log_store_value['client_owner'] AND $old_log_store_value['email'] !=  $change_log_store_value['email'])
                 {  // 963258
                   // if client and email both are changed............................

                  // First: EMail change...................................
                        $initpassword =substr(md5(time()),0,10);
                       $password = md5($secret . $initpassword);

                       // password Update into the client DB....
                       $password_udt = $pro->only_password_update_by_id($password,$cmd);

                     if ($emailnotify=='Yes')
                      {
                          $sysEmail=appconfig('Email');
                          $sysCompany=appconfig('CompanyName');

                          $companyName = substr($sysCompany,0,strrpos($sysCompany, ' '));

                          $sysUrl= appconfig('sysUrl');
                          $d= ORM::for_table('email_templates')->where('tplname', 'Email And Password Modified')->find_one();

                          $template = $d['message'];
                          $subject = $d['subject'];
                          $send = $d['send'];
                          $data = array('name' => $new_db_result['name']." ".$new_db_result['lname'],
                              'logo'=> ' src="'.$sysUrl.'/assets/uploads/logo.png"',
                              'business_name'=> $sysCompany,
                               'email'=> $email,
                               'password'=> $initpassword,
                               'sys_url' => $sysUrl
                          );

                          $message = _render($template,$data);

                          $mail_subject = _render($subject,$data);

                          $body = $message;

                                  if ($send=='1')
                                  {
                                       require ('../lib/pnp/email/class.phpmailer.php') ;
                                       $mail = new PHPMailer();
                                      $mail->SetFrom($sysEmail, $sysCompany);
                                      $mail->AddReplyTo($sysEmail, $sysCompany);
                                      $mail->AddAddress($email, $new_db_result['name']);
                                      $mail->Subject= $mail_subject;
                                      $mail->MsgHTML($body);
                                      $mail->Send();
                                  }

                    }

                    
                     conf("client-manage.php?_clid=$cmd",'s','Client Modified Successfully.');

                 }  //963258
                 else{
                   // echo "Normal data Updated";
                  conf("client-manage.php?_clid=$cmd",'s','Client Modified Successfully.');
                 }


          }  //66666666

      }



}
else{
     conf("client-manage.php?_clid=$cmd",'e','Please Submit your Information Again');
}

?>

