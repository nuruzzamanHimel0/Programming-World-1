$saveto = saveImageFromURLWithCURL($userId,$basename_of_mms,$username,$password);

........................

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
