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
    header("Content-type: application/zip");
   
    header("Content-Transfer-Encoding: binary"); 
    // header('Pragma: no-cache'); 
    // header('Expires: 0');

    readfile($filepath);
    exit();

            }
        }


        ?>
		
		index.php page is here:
<a href="?d_file=<?php echo $value['campaign_name']; ?>.txt" class="btn btn-primary" style="color:white; text-decoration: none;font-size:16px; border-radius: 5px;">Download</a>