  youtube link: https://www.youtube.com/watch?v=kZNP5NEF4FA
  
  <?php 

        if(isset($_GET['d_file']))
        {
            $filename = basename($_GET['d_file']);
        
            $filepath = "Files/".$filename;
            //     echo $filepath;
            // exit();
            if(!file_exists($filepath)) 
            {
                conf("add-campaigns.php",'e','File not exist for download!!');
            }
            else if(!empty($filename) AND file_exists($filepath))
            {
                //Default headers...........
              // Send file headers
   header("Cache-Control: public");
     header("Content-Description: File Transfer");
     header("Content-Disposition: attachment;filename=$filename");
    header("Content-type: application/octet-stream");
    header('Expires: 0');
   
    header("Content-Transfer-Encoding: binary"); 

    readfile($filepath);
    exit();

            }
        }


        ?>
		
		index.php page is here:
<a href="?d_file=<?php echo $value['campaign_name']; ?>.txt" class="btn btn-primary" style="color:white; text-decoration: none;font-size:16px; border-radius: 5px;">Download</a>





OR, Full Code Get FROM Existing Project That's why there have many Database and Unused code for download file................................




<?php ob_clean();

$ical = "BEGIN:VCALENDAR
         VERSION:2.0"; ?>
<?php 
 // DOwnload File .........................................

        if(isset($_GET['camp_name']) AND isset($_GET['camp_id']))
        {
            $camp_name = basename($_GET['camp_name']);
            $camp_id = basename($_GET['camp_id']);
             

            //     echo $camp_name."-".$camp_id;
            // exit();

             $query = "SELECT * FROM sms_campaign WHERE id = :id ";
            $sltstmt = $dbh->prepare($query);
            $executeQuery = $sltstmt->execute(array(":id"=>$camp_id));

            if($executeQuery)
            {
                $fetchStmt = $sltstmt->fetch();
                $numStA = explode(',',$fetchStmt['campaign_numbeers']);
                $countNum = count($numStA);
                // echo $countNum;

                $filepath = "Files/add-campaign/".$camp_name."_num.txt";

                $createFile = fopen($filepath,'w');

                for ($i=0; $i <$countNum ; $i++) 
                { 
                   fwrite($createFile,$numStA[$i]."\n");
                }
                fclose($createFile);
              
                 $filename = $camp_name."_num.txt";

                  $basename = basename($filename);
                   $filedata = file_get_contents($filepath, FILE_BINARY);
                    if ($filedata)
                       {
                          header("Content-Type: application-x/force-download");
                          header("Content-Disposition: attachment; filename=\"$basename\"");
                          header("Content-length: ".(string)(strlen($filedata)));
                          header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"), date("s"), date("m"), date("d"), date("Y")))." GMT");
                          header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");

                          if (FALSE === strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE '))
                          {
                             header("Cache-Control: no-cache, must-revalidate");
                          }

                          header("Pragma: no-cache");

                          flush();

                          ob_start();
                          echo $filedata;
                          exit();
                       }

               

             }
 
            }
        


        ?>

	index.php page is here:
<a href="?d_file=<?php echo $value['campaign_name']; ?>.txt" class="btn btn-primary" style="color:white; text-decoration: none;font-size:16px; border-radius: 5px;">Download</a>
