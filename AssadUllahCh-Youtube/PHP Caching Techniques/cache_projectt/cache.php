<?php 
	  include('../manager/init.php');  // WHMCS Encripted File
    include('../lib/functions.php');

     use WHMCS\Database\Capsule;


     $start = microtime(true);
     $cache_dir = "cache/file.cache.php";
     $data = "";


    if(isset($_GET['action']) AND $_GET['action'] == 'delete')
    {
    	unlink($cache_dir);
    	header("Location: cache.php");
    	exit();
    }

     if(file_exists($cache_dir))
     {
     	echo "File Cachedddddd"."<br>";
     	include($cache_dir);
     ?>
     	<a href="?action=delete" style="background: #ddd;padding: 14px;text-decoration: none;font-size: 20px;position: absolute;top: 3px;right: 6px;border-radius: 6px;">DELETE</a>
     <?php	
     }else{
     	echo "File not Cachedddddd"."<br>"; 

     	// $user_count = Capsule::table('tblclients')->select('firstname','lastname')->count(); 
     	// echo $user_count;

     	$users = Capsule::table('tblclients')->get();

     	foreach ($users as $user ) {
     		$data .= $user->firstname." -- ".$user->lastname." ".$user->companyname." ".$user->email." ".$user->address2 ." ".$user->address2."<br>";
     	}

     	$createCreate = fopen($cache_dir,'w');
     	fwrite($createCreate,$data);
     	fclose($createCreate);

     
     	
     }

    	 $end = microtime(true);

     $time_diff = round(($end - $start),5);


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cache Project</title>
	<style type="text/css">
		#time{
			position: fixed;
			top: 50%;
			width: 100%;
			background: black;
			color: #fff;
			padding: 15px;
		}
	</style>
</head>
<body>
	
	<div><?php if(isset($data)){echo $data;} ?></div>
	<div id="time"><?php echo $time_diff; ?></div>
</body>
</html>