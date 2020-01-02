<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PHP TWLP Fundamental</title>
<style>
	.phpcoding{ width: 900px; margin:0 auto; background:#ddd; padding:15px; }
	.headersection , .footersection{ background:#444; color:#fff; text-align:center; padding-top:15px; padding-bottom:15px; }
	.mainsection { min-height:450px; padding:20px;}
</style>
</head>

<body>
    <div class="phpcoding">
        <section class="headersection">
            <h2>PHP TWLP Fundamental </h2>
        </section>
        
        <section class="mainsection">
          


            <?php 

            //1. fread...................................................
            echo "Get full file :<br>";
               $filename = "text.txt";
                $handle = fopen($filename, "r") or die('filenot found');
              echo fread($handle, filesize($filename));
                fclose($handle);
                echo "<br><br><br>";
             // 2. fgets...........................................   
                echo "get one line in (fgets function): <br>";
                $ourfile = fopen("text.txt",'r') or die('filenot found');
                echo fgets($ourfile,filesize("text.txt"));
                fclose($ourfile);

                echo "<br> <br>";

                echo "get one first character(fgetc function): <br>";

                $ourfile = fopen('text.txt','r') or die('filenot found');
                echo fgetc($ourfile);
                fclose($ourfile);

                echo "<br><br>";

                echo "end of file(feof funcion): <br>";

                $ourfile = fopen('text.txt','r') or die('filenot found');
                while(!feof($ourfile))
                {
                    echo fgets($ourfile,filesize('text.txt'))."<br>";
                }
				
				// or this can be work perfectly i never try for CSV file value get
				
			while ($row = fgetcsv($file_data)) 
			{
				 $data = array(
				   'first_name' => $row[0],
				   'last_name' => $row[1]
				  );

				 $query = "INSERT INTO csv_table(firstname,lastname) VALUES('".$data['first_name']."','".$data['last_name']."')";
				$result = $this->db->insert($query);

				if($result != FALSE)
				{
					sleep(1);

					  if(ob_get_level() > 0)
					  {
					   ob_end_flush();
					  }
				}
				
			}



            ?>











        </section>
        
        <section class="footersection">
            <h2>Practice By Md. Nuruzzaman himel </h2>
        </section>
    </div>

</body>
</html>