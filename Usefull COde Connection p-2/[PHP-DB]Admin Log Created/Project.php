<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../../AppConfig.php');
include_once ($filepath.'/../../AllFuncion.php');

// date_default_timezone_set('Asia/Dhaka');
//   $current_time = date('Y-m-d H:i:s');

class Project
{
	

	public $dbh;
	public $db_host 	= DB_HOST ;
public $db_port 		= DB_PORT;
public $db_user 		= DB_USER;
public $db_password 	=  DB_PASS;
public $db_name 		= DB_NAME ;



	
	public function __construct()
	{
		try {
    		$this->dbh = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);
		}
		catch(PDOException $e)
		{
		    echo $e->getMessage();
		}
	}


public function getAppendMessage()
{

	$itemArray = array();

	$querySlt = "SELECT * FROM sms_chatting";
	$stmt_slt_all = $this->dbh->prepare($querySlt);
	$stmt_slt_all->execute();


	while($value_id = $stmt_slt_all->fetch())
	{
		$chatting_id = $value_id['id'];
		// $itemArray[] = $chatting_id;


		// get one row from DB using (chatting_id)..........................
		$queryL1 = "SELECT * FROM sms_chatting_app_ajax_responce WHERE chatting_id = :chatting_id ORDER BY id LIMIT 1  ";
		$stmtL1 = $this->dbh->prepare($queryL1);
		$stmtL1->execute(array(":chatting_id"=>$chatting_id));
		$fetchL1 = $stmtL1->fetch();

// get all row using (chatting id).............................
		$query = "SELECT * FROM sms_chatting_app_ajax_responce WHERE chatting_id = :chatting_id ORDER BY id ASC LIMIT 2  ";
		$stmt = $this->dbh->prepare($query);
		$stmt->execute(array(":chatting_id"=>$chatting_id));
		// $count_row = $stmt->rowCount();

		if($stmt->rowCount() == 2 AND $fetchL1['chatting_state'] == 'received')
		{

				while($value = $stmt->fetch())
				{
					$itemArray[] = $value;
				}
				
				// echo json_encode($itemArray);
		}
		else if($stmt->rowCount() == 2 AND $fetchL1['chatting_state'] == 'completed')
		{

				while($value = $stmt->fetch())
				{
					$itemArray[] = $value;
				}
				
				// echo json_encode($itemArray);
		}
		else if($stmt->rowCount() == 1 AND $fetchL1['chatting_state'] == 'sent')
		{
			while($value = $stmt->fetch())
				{
					$itemArray[] = $value;
				}
			// echo json_encode($itemArray);
		 }
		
	} // while loop end............
	// echo json_encode($itemArray);

	if(count($itemArray)>0)
	{
		echo json_encode($itemArray);
	}else{
			echo "error";
		}


	

}

public function getAllResponceInfoUsingChatting_id($id)
{
	$itemArrays = array();

$querySlt = "SELECT * FROM sms_chatting_app_ajax_responce WHERE chatting_id = :id ORDER BY id ASC LIMIT 1";
	$stmt_slt = $this->dbh->prepare($querySlt);
	$stmt_slt->execute(array(":id"=>$id));
	$fetch_slt = $stmt_slt->fetch();

	$query = "SELECT * FROM sms_chatting_app_ajax_responce WHERE chatting_id = :id";
	$stmt = $this->dbh->prepare($query);
	$stmt->execute(array(":id"=>$id));

	if($stmt->rowCount() == 2 AND $fetch_slt['chatting_state'] == 'received')
	{
		while($value = $stmt->fetch())
			{
				$itemArrays[] = $value;
			}
			
			echo json_encode($itemArrays);
	}
	else if($stmt->rowCount() == 2 AND $fetch_slt['chatting_state'] == 'completed')
	{
		while($value = $stmt->fetch())
			{
				$itemArrays[] = $value;
			}
			
			echo json_encode($itemArrays);
	}
	else if($stmt->rowCount() == 1 AND $fetch_slt['chatting_state'] == 'sent')
	{
		while($value = $stmt->fetch())
			{
				$itemArrays[] = $value;
			}
			
			echo json_encode($itemArrays);
	}
	else{
		echo "sms_chatting_app_ajax_responce_table_not_full_fil_cond";
	}

		
			// echo "Query done";

}

public function dropTmpSmsChtAndClearDataFrmSmsChtApAjx()
{
	
	$queryDrp = "DROP TABLE tmp_sms_chatting ";
	$stmt_drp = $this->dbh->prepare($queryDrp);
	 $stmt_drp->execute();

	
		$queryDlt = "DELETE FROM sms_chatting_app_ajax_responce";
		$stmt_dlt = $this->dbh->prepare($queryDlt);
		$stmt_dlt->execute();

		echo "DROP AND DELETE COMPLETE";
	

		// echo "DROP AND DELETE COMPLETE";

}

public function deleteDataFromDBTableUsingId($id)
{

		$queryDlt = "DELETE FROM sms_chatting_app_ajax_responce WHERE chatting_id = ?";
		$stmt_dlt = $this->dbh->prepare($queryDlt);
		$stmt_dlt->execute(array($id));

		$query = "DELETE FROM tmp_sms_chatting WHERE id = ?";
		$stmt_dl = $this->dbh->prepare($query);
		$stmt_dl->execute(array($id));

		echo "DELET DATA using id";

}

public function droptmp_sms_chatting()
{

		

		$query = "DROP TABLE tmp_sms_chatting";
		$stmt_drp = $this->dbh->prepare($query);
		$stmt_drp->execute();


}




public function getAllResValueBaseOfTmpSMSChting()
{

$itemArray = array();

// ............................. CHECK TABLE EXIST OR NOT........................................
	$query = "show tables";
	$stmt = $this->dbh->prepare($query);
	$stmt->execute();
	$tableFound = 0;
	$datas ="";

	while ($data = $stmt->fetch()) 
	{
		if(strtolower($data['Tables_in_invention_main']) == "tmp_sms_chatting")
		{
			$tableFound = 1;
		}
		
	}
// .......................... end ..................................................
	// echo $tableFound;

	if($tableFound == 1)
	{

		// $query = "SELECT sms_chatting_app.*,tmp_sms_chatting.chatting_id as chatting_id_code
		// FROM sms_chatting_app 
		// 	INNER JOIN tmp_sms_chatting
		// 	ON tmp_sms_chatting.id = sms_chatting_app.chatting_id";

		$query = "SELECT * FROM tmp_sms_chatting";
		$stmt = $this->dbh->prepare($query);
		$stmt->execute();

		while($value = $stmt->fetch())
			{
				$itemArray[] = $value;
			}
			
			echo json_encode($itemArray);

	}
	else{
		echo "tmp_sms_chtting_data_error";
	}

	

}

// public function deleteDatabaseFunction($id)
// {
// 	$sql = "DELETE FROM sms_chatting_app_ajax_responce WHERE id = ? ";
// 			$dlt_stmt = $this->dbh->prepare($sql);
// 			$dlt_execute = $dlt_stmt->execute(array($id));
			
// 				echo "delete DB_by_id";
			

// }

public function deleteDatabaseFunction()
{
	$sql = "DELETE FROM sms_chatting_app_ajax_responce ";
			$dlt_stmt = $this->dbh->prepare($sql);
			$dlt_execute = $dlt_stmt->execute();
			
				echo "delete DB";
			

}
	// ............................Alive................................

	public function keepAliveFunction($camp_id,$campaign_name,$alive_text_area)
	{
		// echo "c id=".$camp_id."&& c name=".$campaign_name." text =".$alive_text;
		// exit();

		if(!empty($alive_text_area))
		{
			
			// First File Create
			$filePath =  "../Files/campaigns/".$campaign_name."_keepAlive.txt";
			$fileCreate = fopen($filePath,'w');
			fwrite($fileCreate,$alive_text_area);
			fclose($fileCreate);

			$checkDbQuery = "SELECT * FROM sms_alive WHERE campaign_id = :campaign_id ";
			$checkStmt = $this->dbh->prepare($checkDbQuery);
			$checkStmt->execute(array(':campaign_id'=>$camp_id ));

			$count = $checkStmt->rowCount();

			// DB Exists..................................
			if($count > 0)
			{
				// DELETE OLD INFO FROM DB......
				$dltQuery = "DELETE FROM sms_alive WHERE campaign_id = :campaign_id ";
				$dltStmt = $this->dbh->prepare($dltQuery);
				$dltStmt->execute(array(':campaign_id'=> $camp_id));

				// insert script_name into db form file.txt
				$fileOpen = fopen($filePath,'r');

				while(!feof($fileOpen))
				{
					$line = fgets($fileOpen,filesize($filePath)+1);

					$insetQ = "INSERT INTO sms_alive(campaign_id,alive_name) VALUES(:campaign_id,:alive_name); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':alive_name',$line);

					$insertStmt->execute();

				}
				fclose($fileOpen);

				// unlink file...............
				unlink($filePath);


				echo "success";
			exit();


			} // DB not exist for first time...................
			else{
				
				$fileOpen = fopen($filePath,'r');

				while(!feof($fileOpen))
				{
					$line = fgets($fileOpen,filesize($filePath)+1);
					// echo filesize($filePath)."<br>";
					// echo $line;
					// exit();

					$insetQ = "INSERT INTO sms_alive(campaign_id,alive_name) VALUES(:campaign_id,:alive_name); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':alive_name',$line);

					$insertStmt->execute();

				}
				fclose($fileOpen);

				unlink($filePath);

				echo "success";
			exit();

			}



			
		}
		else if(empty($campaign_name) OR empty($alive_text_area))
		{
			echo "empty";
			exit();
		}
		// echo "empty";
		// 	exit();

	}


	// ............................HungUp Message................................

	public function hungUpMessageFunction($camp_id,$campaign_name,$hung_text)
	{
		// echo "Function Inside: c id=".$camp_id."&& c name=".$campaign_name." text =".$hung_text;
		// exit();

		if(!empty($hung_text))
		{
			
			// First File Create
			$filePath =  "../Files/campaigns/".$campaign_name."_hungUp.txt";
			$fileCreate = fopen($filePath,'w');
			fwrite($fileCreate,$hung_text);
			fclose($fileCreate);

			$checkDbQuery = "SELECT * FROM sms_hangup WHERE campaign_id = :campaign_id ";
			$checkStmt = $this->dbh->prepare($checkDbQuery);
			$checkStmt->execute(array(':campaign_id'=>$camp_id ));

			$count = $checkStmt->rowCount();

			// DB Exists..................................
			if($count > 0)
			{
				// DELETE OLD INFO FROM DB......
				$dltQuery = "DELETE FROM sms_hangup WHERE campaign_id = :campaign_id ";
				$dltStmt = $this->dbh->prepare($dltQuery);
				$dltStmt->execute(array(':campaign_id'=> $camp_id));

				// insert script_name into db form file.txt
				$fileOpen = fopen($filePath,'r');

				while(!feof($fileOpen))
				{
					$line = fgets($fileOpen,filesize($filePath)+1);

					$insetQ = "INSERT INTO sms_hangup(campaign_id,hgup_msg) VALUES(:campaign_id,:hgup_msg); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':hgup_msg',$line);

					$insertStmt->execute();

				}
				fclose($fileOpen);

				// unlink file...............
				unlink($filePath);


				echo "success";
			exit();


			} // DB not exist for first time...................
			else{
				
				$fileOpen = fopen($filePath,'r');

				while(!feof($fileOpen))
				{
					$line = fgets($fileOpen,filesize($filePath)+1);
					// echo filesize($filePath)."<br>";
					// echo $line;
					// exit();

					$insetQ = "INSERT INTO sms_hangup(campaign_id,hgup_msg) VALUES(:campaign_id,:hgup_msg); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':hgup_msg',$line);

					$insertStmt->execute();

				}
				fclose($fileOpen);

				unlink($filePath);

				echo "success";
			exit();

			}



			
		}
		else if(empty($campaign_name) OR empty($hung_text))
		{
			echo "empty";
			exit();
		}
		// echo "empty";
		// 	exit();

	}





	// ............................Incoming Message Responce function................................

	public function incomingPicMessageFunction($camp_id,$campaign_name,$incomig_text)
	{
		// echo "Function Inside: c id=".$camp_id."&& c name=".$campaign_name." text =".$incomig_text;
		// exit();

		if(!empty($incomig_text))
		{
			
			// First File Create
			$filePath =  "../Files/campaigns/".$campaign_name."_incomingResp.txt";
			$fileCreate = fopen($filePath,'w');
			fwrite($fileCreate,$incomig_text);
			fclose($fileCreate);

			$checkDbQuery = "SELECT * FROM sms_incmig_pic WHERE campaign_id = :campaign_id ";
			$checkStmt = $this->dbh->prepare($checkDbQuery);
			$checkStmt->execute(array(':campaign_id'=>$camp_id ));

			$count = $checkStmt->rowCount();

			// DB Exists..................................
			if($count > 0)
			{
				// DELETE OLD INFO FROM DB......
				$dltQuery = "DELETE FROM sms_incmig_pic WHERE campaign_id = :campaign_id ";
				$dltStmt = $this->dbh->prepare($dltQuery);
				$dltStmt->execute(array(':campaign_id'=> $camp_id));

				// insert script_name into db form file.txt
				$fileOpen = fopen($filePath,'r');

				while(!feof($fileOpen))
				{
					$line = fgets($fileOpen,filesize($filePath)+1);

					$insetQ = "INSERT INTO sms_incmig_pic(campaign_id,imp_msg) VALUES(:campaign_id,:imp_msg); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':imp_msg',$line);

					$insertStmt->execute();

				}
				fclose($fileOpen);

				// unlink file...............
				unlink($filePath);


				echo "success";
			exit();


			} // DB not exist for first time...................
			else{
				
				$fileOpen = fopen($filePath,'r');

				while(!feof($fileOpen))
				{
					$line = fgets($fileOpen,filesize($filePath)+1);
					// echo filesize($filePath)."<br>";
					// echo $line;
					// exit();

					$insetQ = "INSERT INTO sms_incmig_pic(campaign_id,imp_msg) VALUES(:campaign_id,:imp_msg); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':imp_msg',$line);

					$insertStmt->execute();

				}
				fclose($fileOpen);

				unlink($filePath);

				echo "success";
			exit();

			}



			
		}
		else if(empty($campaign_name) OR empty($incomig_text))
		{
			echo "empty";
			exit();
		}
		// echo "empty";
		// 	exit();

	}
// .......................Update Campaign Name.............................

	public function campaignudtFunction($camp_id,$cmp_name)
	{
		// echo "c id=".$camp_id." text =".$cmp_name;
		// exit();

		if(!empty($cmp_name))
		{
			$query = "UPDATE sms_campaign SET campaign_name = ? WHERE id = ? ";
			$udtstmt = $this->dbh->prepare($query);
			$udt = $udtstmt->execute(array($cmp_name,$camp_id));

			if($udt)
			{
				echo "success";
			exit();
			}
		}
		else if(empty($cmp_name))
		{
			echo "empty";
			exit();
		}
		
	}


// .......................De;ete Campaign ...................................

	public function deleteCampaignFunction($camp_id)
	{
		// echo "inside :".$camp_id;
		// exit();

		if(!empty($camp_id))
		{
			// $query = "DELETE FROM sms_campaign WHERE id = ? ";
			// $dltstmt = $this->dbh->prepare($query);
			// $dlt = $dltstmt->execute(array($camp_id));

			$query = "DELETE sms_campaign,sms_script,sms_keywords,sms_alive,sms_signature,sms_hangup,sms_incmig_pic
						FROM sms_campaign 
							INNER JOIN sms_script
							ON sms_campaign.id = sms_script.campaign_id AND sms_script.campaign_id = ?
							
							INNER JOIN sms_keywords
							ON sms_campaign.id = sms_keywords.campaign_id AND sms_keywords.campaign_id = ?

							INNER JOIN sms_alive
							ON sms_campaign.id = sms_alive.campaign_id AND sms_alive.campaign_id = ?

							INNER JOIN sms_signature
							ON sms_campaign.id = sms_signature.campaign_id AND sms_signature.campaign_id = ?

							INNER JOIN sms_hangup
							ON sms_campaign.id = sms_hangup.campaign_id AND sms_hangup.campaign_id = ?

							INNER JOIN sms_incmig_pic
							ON sms_campaign.id = sms_incmig_pic.campaign_id AND sms_incmig_pic.campaign_id = ?
			 ";

			 $dltstmt = $this->dbh->prepare($query);
			$dlt = $dltstmt->execute(array($camp_id,$camp_id,$camp_id,$camp_id,$camp_id,$camp_id));

			if($dlt)
			{
					echo "success";
			exit();
			}
			else{
				echo "not delete";
				exit();
			}
		}
		// else if(empty($cmp_name))
		// {
		// 	echo "empty";
		// 	exit();
		// }
		
	}


	public function campaign_name_load_func($camp_id)
	{
		// echo "c id=".$camp_id." text =".$cmp_name;
		// exit();

		
			$query = "SELECT * FROM sms_campaign WHERE id = ? ";
			$stmt = $this->dbh->prepare($query);
			$selt = $stmt->execute(array($camp_id));

			// if($selt)
			// {
				$fetch = $stmt->fetch();
				echo $fetch['campaign_name'];
				exit();
			// }
		
		
		
	}










	public function SMSsignatureFunction($camp_id,$signature_name)
	{
		// 	echo "c id=".$camp_id." text =".$signature_name;
		// exit();
		if( empty($signature_name))
		{
			echo "empty";
			exit();
		}
		else{

			$checkDbQuery = "SELECT * FROM sms_signature WHERE campaign_id = :campaign_id ";
			$checkStmt = $this->dbh->prepare($checkDbQuery);
			$checkStmt->execute(array(':campaign_id'=>$camp_id ));

			$count = $checkStmt->rowCount();

			if($count > 0)
			{
				// DELETE OLD INFO FROM DB......
				$dltQuery = "DELETE FROM sms_signature WHERE campaign_id = :campaign_id ";
				$dltStmt = $this->dbh->prepare($dltQuery);
				$delete = $dltStmt->execute(array(':campaign_id'=> $camp_id));

				if($delete)
				{
					$insetQ = "INSERT INTO sms_signature(campaign_id,signature_name) VALUES(:campaign_id,:signature_name); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':signature_name',$signature_name);

					$insertStmt->execute();

						echo "success";
						exit();
				}

			}
			else{
					$insetQ = "INSERT INTO sms_signature(campaign_id,signature_name) VALUES(:campaign_id,:signature_name); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':signature_name',$signature_name);

					$insertStmt->execute();

						echo "success";
						exit();

			}

		}
	}
// outgoing image Upload.................................................

	public function outgoingImageUpload($tmp_name,$campaign_id,$pic_title,$uploaded,$current_time)
	{
		// echo "campaign_id= ".$campaign_id." && pic_title= ".$pic_title." && uploaded=".$uploaded." && current_time=".$current_time;

		$checkQuery = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title ";
		$checkStmt = $this->dbh->prepare($checkQuery);
		$checkStmt->execute(array(":campaign_id"=>$campaign_id,":pic_title"=>$pic_title ));

		if($checkStmt->rowCount() > 0)
		{

			$fetch_row = $checkStmt->fetch();
			$extRowId = $fetch_row['id'];
			$extPicLoc = $fetch_row['pic_loc'];

			unlink($extPicLoc);

			$udtQuery = "UPDATE sms_outgoing_img SET pic_loc = ? , pic_date = ? WHERE id = ? ";
			$udtStmt = $this->dbh->prepare($udtQuery);
			$udtexe = $udtStmt->execute(array($uploaded,$current_time,$extRowId));

			if($udtexe)
			{
				 move_uploaded_file($tmp_name,$uploaded);
				// echo "Image Exist and Dlt Img and DB";
				
			}

			// echo "Found";
		}
		else{ // IF TITLE NOT EXIST INTO THE DB.............

			 move_uploaded_file($tmp_name,$uploaded);

			$insetQ = "INSERT INTO sms_outgoing_img(campaign_id,pic_title,pic_loc,pic_date) VALUES(:campaign_id,:pic_title,:pic_loc,:pic_date ); ";

			$insertStmt = $this->dbh->prepare($insetQ);
			
			$insertStmt->bindValue(':campaign_id',$campaign_id);
			$insertStmt->bindValue(':pic_title',$pic_title);
			$insertStmt->bindValue(':pic_loc',$uploaded);
			$insertStmt->bindValue(':pic_date',$current_time);
			$insertStmt->execute();

			// echo "First Img Insert";




		}



	}



// links function...............................

	public function fileCreateAndLinksSave($camp_id,$campaign_name,$campaign_links_txt,$campaign_Secondary_Links_txt,$current_time)
	{

		$checkDbQuery = "SELECT * FROM sms_Links WHERE campaign_id = :campaign_id ";
			$checkStmt = $this->dbh->prepare($checkDbQuery);
			$checkStmt->execute(array(':campaign_id'=>$camp_id ));

			$count = $checkStmt->rowCount();
			// check this campaign id exist or not into the DB
			if($count>0)
			{

				// DELETE OLD INFO FROM DB......
				$dltQuery = "DELETE FROM sms_Links WHERE campaign_id = :campaign_id ";
				$dltStmt = $this->dbh->prepare($dltQuery);
				$dltStmt->execute(array(':campaign_id'=> $camp_id));

				if(!empty($campaign_links_txt) AND isset($campaign_links_txt))
				{
					$filePath =  "../Files/campaigns/".$campaign_name."_links.txt";

					// campaign_links_txt all text create and write
					createLinkFileFUnction($filePath,$campaign_links_txt);

					// file open and read for insert DB
					$lOpenFile = fopen($filePath,'r');

					while(!feof($lOpenFile))
					{
						$line = fgets($lOpenFile,filesize($filePath));
						$Link_token = "%s";

						$insetQ = "INSERT INTO sms_Links(campaign_id,Link_token,Link_name,Links_date) VALUES(:campaign_id,:Link_token,:Link_name,:Links_date); ";

						$insertStmt = $this->dbh->prepare($insetQ);

						$insertStmt->bindValue(':campaign_id',$camp_id);
						$insertStmt->bindValue(':Link_token',$Link_token);
						$insertStmt->bindValue(':Link_name',$line);
						$insertStmt->bindValue(':Links_date',$current_time);
						$insertStmt->execute();
					}
					fclose($lOpenFile);
					unlink($filePath);

				}

				if(!empty($campaign_Secondary_Links_txt) AND isset($campaign_Secondary_Links_txt))
				{
					$fileSLinkPath =  "../Files/campaigns/".$campaign_name."_Sec_links.txt";

					createSecLinkFileFUnction($fileSLinkPath,$campaign_Secondary_Links_txt);

					$lOpenFile = fopen($fileSLinkPath,'r');

					while(!feof($lOpenFile))
					{
						$line = fgets($lOpenFile,filesize($fileSLinkPath));
						$Link_token = "%r";

						$insetQ = "INSERT INTO sms_Links(campaign_id,Link_token,Link_name,Links_date) VALUES(:campaign_id,:Link_token,:Link_name,:Links_date); ";

						$insertStmt = $this->dbh->prepare($insetQ);
						
						$insertStmt->bindValue(':campaign_id',$camp_id);
						$insertStmt->bindValue(':Link_token',$Link_token);
						$insertStmt->bindValue(':Link_name',$line);
						$insertStmt->bindValue(':Links_date',$current_time);
						$insertStmt->execute();
					}
					fclose($lOpenFile);
					unlink($fileSLinkPath);
				}

				echo "success";



			}
			else
			{ // DB is free, no data here
				

				if(!empty($campaign_links_txt) AND isset($campaign_links_txt))
				{
					$filePath =  "../Files/campaigns/".$campaign_name."_links.txt";

					// campaign_links_txt all text create and write
					createLinkFileFUnction($filePath,$campaign_links_txt);
						// file open and read for insert DB
					$lOpenFile = fopen($filePath,'r');

					while(!feof($lOpenFile))
					{
						$line = fgets($lOpenFile,filesize($filePath));
						$Link_token = "%s";

						$insetQ = "INSERT INTO sms_Links(campaign_id,Link_token,Link_name,Links_date) VALUES(:campaign_id,:Link_token,:Link_name,:Links_date); ";

						$insertStmt = $this->dbh->prepare($insetQ);

						$insertStmt->bindValue(':campaign_id',$camp_id);
						$insertStmt->bindValue(':Link_token',$Link_token);
						$insertStmt->bindValue(':Link_name',$line);
						$insertStmt->bindValue(':Links_date',$current_time);
						$insertStmt->execute();
					}
					fclose($lOpenFile);
					unlink($filePath);

				}

				if(!empty($campaign_Secondary_Links_txt) AND isset($campaign_Secondary_Links_txt))
				{
					$fileSLinkPath =  "../Files/campaigns/".$campaign_name."_Sec_links.txt";

					createSecLinkFileFUnction($fileSLinkPath,$campaign_Secondary_Links_txt);

					$lOpenFile = fopen($fileSLinkPath,'r');

					while(!feof($lOpenFile))
					{
						$line = fgets($lOpenFile,filesize($fileSLinkPath));
						$Link_token = "%r";

						$insetQ = "INSERT INTO sms_Links(campaign_id,Link_token,Link_name,Links_date) VALUES(:campaign_id,:Link_token,:Link_name,:Links_date); ";

						$insertStmt = $this->dbh->prepare($insetQ);
						
						$insertStmt->bindValue(':campaign_id',$camp_id);
						$insertStmt->bindValue(':Link_token',$Link_token);
						$insertStmt->bindValue(':Link_name',$line);
						$insertStmt->bindValue(':Links_date',$current_time);
						$insertStmt->execute();
					}
					fclose($lOpenFile);
					unlink($fileSLinkPath);
				}

				echo "success";
			
			}

	}



	public function fileCreateAndScriptSave($camp_id,$campaign_name,$script_text)
	{
		if(empty($campaign_name) OR empty($script_text))
		{
			echo "empty";
			exit();
		}
		else{
			// First File Create
			$filePath =  "../Files/campaigns/".$campaign_name."_scripts.txt";
			$fileCreate = fopen($filePath,'w');
			fwrite($fileCreate,$script_text);
			fclose($fileCreate);

			$checkDbQuery = "SELECT * FROM sms_script WHERE campaign_id = :campaign_id ";
			$checkStmt = $this->dbh->prepare($checkDbQuery);
			$checkStmt->execute(array(':campaign_id'=>$camp_id ));

			$count = $checkStmt->rowCount();

			// DB Exists..................................
			if($count > 0)
			{
				// DELETE OLD INFO FROM DB......
				$dltQuery = "DELETE FROM sms_script WHERE campaign_id = :campaign_id ";
				$dltStmt = $this->dbh->prepare($dltQuery);
				$dltStmt->execute(array(':campaign_id'=> $camp_id));

				// insert script_name into db form file.txt
				$fileOpen = fopen($filePath,'r');

				while(!feof($fileOpen))
				{
					$line = fgets($fileOpen,filesize($filePath)+1);

					$insetQ = "INSERT INTO sms_script(campaign_id,script_name) VALUES(:campaign_id,:script_name); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':script_name',$line);

					$insertStmt->execute();

				}
				fclose($fileOpen);

				// unlink file...............
				unlink($filePath);


				echo "success";
			exit();


			} // DB not exist for first time...................
			else{
				
				$fileOpen = fopen($filePath,'r');

				while(!feof($fileOpen))
				{
					$line = fgets($fileOpen,filesize($filePath)+1);
					// echo filesize($filePath)."<br>";
					// echo $line;
					// exit();

					$insetQ = "INSERT INTO sms_script(campaign_id,script_name) VALUES(:campaign_id,:script_name); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':script_name',$line);

					$insertStmt->execute();

				}
				fclose($fileOpen);

				unlink($filePath);

				echo "success";
			exit();

			}

			// link();
			
		}

		
	}




public function fileCreateAndKyewordResponceSave($camp_id,$campaign_name,$keyword_text)
	{
		if(empty($campaign_name) OR empty($keyword_text))
		{
			echo "empty";
			exit();
		}
		else{
			$filePath =  "../Files/campaigns/".$campaign_name."_keyword.txt";
			$fileCreate = fopen($filePath,'w');
			fwrite($fileCreate,$keyword_text);
			fclose($fileCreate);

			$checkDbQuery = "SELECT * FROM sms_keywords WHERE campaign_id = :campaign_id ";
			$checkStmt = $this->dbh->prepare($checkDbQuery);
			$checkStmt->execute(array(':campaign_id'=>$camp_id ));

			$count = $checkStmt->rowCount();

			// DB Exists..................................
			if($count > 0)
			{
				// DELETE OLD INFO FROM DB......
				$dltQuery = "DELETE FROM sms_keywords WHERE campaign_id = :campaign_id ";
				$dltStmt = $this->dbh->prepare($dltQuery);
				$dltStmt->execute(array(':campaign_id'=> $camp_id));

				// insert script_name into db form file.txt
				
				$fileOpen = fopen($filePath,'r');

				while(!feof($fileOpen))
				{
					// get each line from file
					$line = fgets($fileOpen,filesize($filePath)+1);
					
					$line = strtolower($line);
					$keyword = strstr($line,"|",true);

					$responceStrt = strpos($line,'|');
					$respoce = substr($line,$responceStrt+1);
					// echo $respoce;
					// exit();

					$insetQ = "INSERT INTO sms_keywords(campaign_id,key_keyword,key_response) VALUES(:campaign_id,:key_keyword,:key_response); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':key_keyword',$keyword);
					$insertStmt->bindValue(':key_response',$respoce);

					$insertStmt->execute();

				}
				fclose($fileOpen);

				unlink($filePath);

				echo "success";
			exit();

			} // DB not exist for first time...................
			else{
				
				$fileOpen = fopen($filePath,'r');

				while(!feof($fileOpen))
				{
					// get each line from file
					$line = fgets($fileOpen,filesize($filePath)+1);
					// echo filesize($filePath)."<br>";
					// echo $line;
					// exit();

					$line = strtolower($line);
					$keyword = strstr($line,"|",true);

					$responceStrt = strpos($line,'|');
					$respoce = substr($line,$responceStrt+1);
					// echo $respoce;
					// exit();

					$insetQ = "INSERT INTO sms_keywords(campaign_id,key_keyword,key_response) VALUES(:campaign_id,:key_keyword,:key_response); ";
					$insertStmt = $this->dbh->prepare($insetQ);
					$insertStmt->bindValue(':campaign_id',$camp_id);
					$insertStmt->bindValue(':key_keyword',$keyword);
					$insertStmt->bindValue(':key_response',$respoce);

					$insertStmt->execute();

				}
				fclose($fileOpen);

				unlink($filePath);

				echo "success";
			exit();

			}

			
		}

		
	}







	public function udpateGenderVoicemail($data)
	{

		$query = "SELECT * FROM sms_voicemail";
	
		$stmt = $this->dbh->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch();

		$count = $stmt->rowCount();

		if($count <= 0)
		{
			
			$query = "INSERT INTO sms_voicemail(voicemail_name) VALUES(:voicemail)";
			$stmtFI = $this->dbh->prepare($query);
			$stmtFI->bindParam(":voicemail",$data);
			$stmtFI->execute();
			echo 'Insert.................. '.$data;

			exit();
		}else{

			$query = "UPDATE sms_voicemail SET voicemail_name = :voicemail_name WHERE voicemail_id = :voicemail_id ";
			$stmtudt = $this->dbh->prepare($query);
			$stmtudt->bindValue(":voicemail_name",$data);
			$stmtudt->bindValue(":voicemail_id",$fetch['voicemail_id']);
			$stmtudt->execute();
			echo 'Udt.................. '.$data;
			exit();
		}


	}

	public function playvoicefunction()
	{
		$query = "SELECT * FROM sms_voicemail";
	
		$stmt = $this->dbh->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch();

		echo $fetch['voicemail_name'];

	}

	// Outgoing Image send to the clint...........................................................................................................................................

	public function PersentSLinkFoundString($message_responce,$campaign_id)
	{

		$query = "SELECT * FROM sms_Links WHERE campaign_id = :campaign_id AND Link_token = :Link_token ORDER BY RAND() LIMIT 1";
        $s_stmt = $this->dbh->prepare($query);
        $s_stmt->execute(array(":campaign_id"=>$campaign_id,':Link_token'=>'%s'));

        $s_fetch = $s_stmt->fetch();

        $message_responce = str_replace("%s",trim($s_fetch['Link_name']),$message_responce);

        return $message_responce;

	}

	public function PersentRLinkFoundString($message_responce,$campaign_id)
	{

		 $query = "SELECT * FROM sms_Links WHERE campaign_id = :campaign_id AND Link_token = :Link_token ORDER BY RAND() LIMIT 1";
   		$r_stmt = $this->dbh->prepare($query);
          $r_stmt->execute(array(":campaign_id"=>$campaign_id,':Link_token'=>'%r'));

         $r_fetch = $r_stmt->fetch();

        $message_responce = str_replace("%r",trim($r_fetch['Link_name']),$message_responce);

        return $message_responce;

	}


	public function PersentCityFoundString($message_responce,$campaign_id,$chatting_to,$access_key)
	{


		 if(strpos($chatting_to,'+1') !== FALSE) // us and canada
          { 
            $country_prefix = "+1";
            $area_code = substr($chatting_to,2,3);
          }
          else if(strpos($chatting_to,'+44') !== FALSE) // united kingdom
          {
            $country_prefix = "+44";
            $area_code = substr($chatting_to,3,3);
          }
          else if(strpos($chatting_to,'+64') !== FALSE)  // new zealand
          {
            $country_prefix = "+64";
            $area_code = substr($chatting_to,3,3);
          }
          else if(strpos($chatting_to,'+61') !== FALSE)  // new zealand
          {
            $country_prefix = "+61";
            $area_code = substr($chatting_to,3,3);
          }

          $query = "SELECT * FROM sms_geolocation WHERE country_prefix  = :country_prefix AND area_code = :area_code ";
          $geo_stmt = $this->dbh->prepare($query);
          $geo_stmt->execute(array(":country_prefix"=>$country_prefix,":area_code"=>$area_code));

          if($geo_stmt->rowCount() > 0)
          {
          // DB Found..................

            $fetch_geo_data = $geo_stmt->fetch();
            
            $message_responce = str_replace("%city%",trim($fetch_geo_data['location']),$message_responce);
            return $message_responce;
            // $createFile = fopen("sms-smsReplyResponceManage-check-symbol.txt",'w');
            // fwrite($createFile, $str_array['message_responce'] );
            // fclose($createFile);
          }
          else
          {
        	  // DB not found......... Api call............
            
            
            // API CALL HERE..................
            $numberVer_res_Json = numberVerify_response($access_key,trim(str_replace("+"," ",$chatting_to)));
             // Decode JSON response:
            $validationResult = json_decode($numberVer_res_Json, true);
            // test...............................
            // $createFile = fopen("sms-smsReplyResponceManage-check-city-NumberVerify-API.txt",'w');
            // foreach ($validationResult as $key => $value)
            // {
            //  fwrite($createFile,$key ." == ".$value."\n");
            // }
            // fclose($createFile);  
            // ...................... ....................................            
            $uv_areaCode = substr($validationResult['local_format'],0,3);

            $query = "INSERT INTO sms_geolocation(`country_prefix`,`country_code`,`country_name`,`area_code`,`location`,`line_type`) VALUES(?,?,?,?,?,?);";
            $nv_stmt = $this->dbh->prepare($query);
            $nv_execute = $nv_stmt->execute(array($validationResult['country_prefix'],$validationResult['country_code'],$validationResult['country_name'],$uv_areaCode,$validationResult['location'],$validationResult['line_type']));

            if($nv_execute)
            {

              $message_responce = str_replace("%city%",trim($validationResult['location']),$message_responce);
              return $message_responce;
              // $createFile = fopen("sms-smsReplyResponceManage-check-symbol.txt",'w');
              // fwrite($createFile, $str_array['message_responce'] );
              // fclose($createFile);

            }

          }

	}

	public function get_outgoing_img($pic_title,$campaign_id)
	{
		$query = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title ";

        $og_stmt = $this->dbh->prepare($query);
        $og_exe = $og_stmt->execute(array(":campaign_id"=>$campaign_id,':pic_title'=> $pic_title));
        if($og_stmt->rowCount() > 0)
        {
        	return $og_stmt->fetch();
        }
	}

	public function sent_message_with_pic_for_keyword_first_time($call_back_url,$outgoing_img_loc,$userId,$username,$password,$chatting_from,$chatting_to,$message_responce)
	{

          $call_backURL = $call_back_url."/sms-chatting-app.php";
          $media = $call_back_url.substr($outgoing_img_loc,2);

          $chatting_sms = sendSMSandMMS_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$message_responce,$media,$call_backURL);
	}



public function sent_message_with_pic_for_keyword_DB_exist($call_back_url=" ",$outgoing_img_loc=" ",$userId,$username,$password,$chatting_from,$chatting_to,$message_responce=" ")
	{

          $call_backURL = $call_back_url."/sms-chatting-app.php";
          $media = $call_back_url.substr($outgoing_img_loc,2);

          $chatting_sms = sendSMSandMMS_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$message_responce,$media,$call_backURL);
	}

public function sent_only_pic_for_keyword_DB_exist($call_back_url,$outgoing_img_loc,$userId,$username,$password,$chatting_from,$chatting_to)
{

      $call_backURL = $call_back_url."/sms-chatting-app.php";
      $media = $call_back_url.substr($outgoing_img_loc,2);

      $chatting_sms = sendOnlyMMS_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$media,$call_backURL);

}




	public function sent_message_with_pic_for_script_first_time($lstId_sms_chating,$call_back_url,$outgoing_img_loc,$userId,$username,$password,$chatting_from,$chatting_to,$message_responce)
	{

		 $udtQuery = "UPDATE sms_chatting_app SET script_counter = ? WHERE id =? ";
          $udtSC_stmt = $this->dbh->prepare($udtQuery);
          $udtSC_stmt->execute(array("1",$lstId_sms_chating));


          $call_backURL = $call_back_url."/sms-chatting-app.php";
          $media = $call_back_url.substr($outgoing_img_loc,2);

          $chatting_sms = sendSMSandMMS_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$message_responce,$media,$call_backURL);
	}



	public function sent_message_with_pic_for_script_DB_exist($lstId_sms_chating,$script_counter_increment,$call_back_url,$outgoing_img_loc,$userId,$username,$password,$chatting_from,$chatting_to,$message_responce)
	{

		 $udtQuery = "UPDATE sms_chatting_app SET script_counter = ? WHERE id =? ";
                $udtSC_stmt = $this->dbh->prepare($udtQuery);
                $script_counter_increment = $script_counter_increment+1;
                $udtSC_stmt->execute(array($script_counter_increment,$lstId_sms_chating));


          $call_backURL = $call_back_url."/sms-chatting-app.php";
          $media = $call_back_url.substr($outgoing_img_loc,2);

          $chatting_sms = sendSMSandMMS_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$message_responce,$media,$call_backURL);
	}


	public function sent_message_for_script_DB_exist($lstId_sms_chating,$script_counter_increment,$call_back_url,$userId,$username,$password,$chatting_from,$chatting_to,$message_responce)
	{

		 $udtQuery = "UPDATE sms_chatting_app SET script_counter = ? WHERE id =? ";
                $udtSC_stmt = $this->dbh->prepare($udtQuery);
                $script_counter_increment = $script_counter_increment+1;
                $udtSC_stmt->execute(array($script_counter_increment,$lstId_sms_chating));


          $call_backURL = $call_back_url."/sms-chatting-app.php";
         

            $chatting_sms = sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$message_responce,$call_backURL);
	}








	public function sent_message_for_script_first_time($lstId_sms_chating,$call_back_url,$userId,$username,$password,$chatting_from,$chatting_to,$message_responce)
	{

		 $udtQuery = "UPDATE sms_chatting_app SET script_counter = ? WHERE id =? ";
          $udtSC_stmt = $this->dbh->prepare($udtQuery);
          $udtSC_stmt->execute(array("1",$lstId_sms_chating));


          $call_backURL = $call_back_url."/sms-chatting-app.php";
         

          $chatting_sms = sendSms_chatting_app($userId,$username,$password,$chatting_from,$chatting_to,$message_responce,$call_backURL);
	}

	// ......................................... ADD CLIENT................................................................................................................\\

	public function admin_log_created($date,$action,$admin_id,$admin_ip)
{
  // get admin name
  $query = "SELECT * FROM admins WHERE id = ? ";
  $a_stmt = $this->dbh->prepare($query);
  $a_stmt->execute(array($admin_id));

  if($a_stmt->rowCount() > 0)
  {
    $admin_fetch = $a_stmt->fetch();
    $query = "INSERT INTO admin_log(admin_date,admin_action,admin_name,admin_ip) VALUES(?,?,?,?)";
    $l_stmt = $this->dbh->prepare($query);
    $l_stmt->execute(array($date,$action,$admin_fetch['fname']." ".$admin_fetch['lname'],$admin_ip ));
  }
  
}

	//........................... Client Info Update......................................................................................................................................................................................................


	  public function selectOldDbInfoByid($id)
	  {
	    // $query = "SELECT name,lname,company,website,email,client_owner,address1,address2,postcode,city,country,phone,email_perm,sms_perm,status,parent FROM accounts WHERE id = :id ";

	    $query = "SELECT a.name,a.lname,a.company,a.website,a.email,CONCAT_WS(' ', r.res_name, r.res_lname) AS client_owner,a.address1,a.address2,a.postcode,a.city,a.country,a.phone,a.email_perm,a.sms_perm,a.status,a.parent 
					FROM accounts AS a 
						INNER JOIN account_reseller AS r
							ON a.client_owner = r.id AND a.id = :id
                            

	    ";
	        $stmt = $this->dbh->prepare($query);
	        $exe = $stmt->execute(array(":id"=>$id));
	        if($stmt->rowCount() > 0)
	        {
	              $fetch_result = $stmt->fetch(PDO::FETCH_ASSOC);
	           
	            return $fetch_result;
	        }
	        else{
	          return false;
	        }
	  }


	   public function selectNewDbInfoByid($id)
	  {
	    // $query = "SELECT name,lname,company,website,email,client_owner,address1,address2,postcode,city,country,phone,email_perm,sms_perm,status,parent FROM accounts WHERE id = :id ";

	    $query = "SELECT a.name,a.lname,a.company,a.website,a.email,CONCAT_WS(' ', r.res_name, r.res_lname) AS client_owner,a.address1,a.address2,a.postcode,a.city,a.country,a.phone,a.email_perm,a.sms_perm,a.status,a.parent 
					FROM accounts AS a 
						INNER JOIN account_reseller AS r
							ON a.client_owner = r.id AND a.id = :id
                            

	    ";
	        $stmt = $this->dbh->prepare($query);
	        $exe = $stmt->execute(array(":id"=>$id));
	        if($stmt->rowCount() > 0)
	        {
	              $fetch_result = $stmt->fetch(PDO::FETCH_ASSOC);
	           
	            return $fetch_result;
	        }
	        else{
	          return false;
	        }
	  }



	  public function selectOldDbInfoByidClint_owner_zero($id)
	  {
	    $query = "SELECT name,lname,company,website,email,client_owner,address1,address2,postcode,city,country,phone,email_perm,sms_perm,status,parent FROM accounts WHERE id = :id ";

	    // $query = "SELECT a.name,a.lname,a.company,a.website,a.email,CONCAT_WS(' ', r.res_name, r.res_lname) AS client_owner,a.address2,a.postcode,a.city,a.country,a.phone,a.email_perm,a.sms_perm,a.status,a.parent 
					// FROM accounts AS a 
					// 	INNER JOIN account_reseller AS r
					// 		ON a.client_owner = r.id AND a.id = :id
                            

	    // ";
	        $stmt = $this->dbh->prepare($query);
	        $exe = $stmt->execute(array(":id"=>$id));
	        if($stmt->rowCount() > 0)
	        {
	              $fetch_result = $stmt->fetch(PDO::FETCH_ASSOC);
	           
	            return $fetch_result;
	        }
	        else{
	          return false;
	        }
	  }

	  public function selectOldResellerInfoByResId($id)
	  {
	    $query = "SELECT res_name,res_lname,res_company,res_website,res_email,res_address1,res_address2,res_postcode,res_city,res_country,res_phone,res_email_perm,res_sms_perm,res_status FROM account_reseller WHERE id = :id ";

	        $stmt = $this->dbh->prepare($query);
	        $exe = $stmt->execute(array(":id"=>$id));
	        if($stmt->rowCount() > 0)
	        {
	              $fetch_result = $stmt->fetch(PDO::FETCH_ASSOC);
	           
	            return $fetch_result;
	        }
	        else{
	          return false;
	        }
	  }

	  public function selectUpdateResellerInfoByResId($id)
	  {
	    $query = "SELECT res_name,res_lname,res_company,res_website,res_email,res_address1,res_address2,res_postcode,res_city,res_country,res_phone,res_email_perm,res_sms_perm,res_status FROM account_reseller WHERE id = :id ";

	        $stmt = $this->dbh->prepare($query);
	        $exe = $stmt->execute(array(":id"=>$id));
	        if($stmt->rowCount() > 0)
	        {
	              $fetch_result = $stmt->fetch(PDO::FETCH_ASSOC);
	           
	            return $fetch_result;
	        }
	        else{
	          return false;
	        }
	  }





	   public function selectNewDbInfoByidClint_owner_zero($id)
	  {
	    $query = "SELECT name,lname,company,website,email,client_owner,address1,address2,postcode,city,country,phone,email_perm,sms_perm,status,parent FROM accounts WHERE id = :id ";

	        $stmt = $this->dbh->prepare($query);
	        $exe = $stmt->execute(array(":id"=>$id));
	        if($stmt->rowCount() > 0)
	        {
	              $fetch_result = $stmt->fetch(PDO::FETCH_ASSOC);
	           
	            return $fetch_result;
	        }
	        else{
	          return false;
	        }
	  }

	  public function change_reseller_eml_sms_param($db_result)
	  {
	  	foreach ($db_result as $key => $value) 
        {

          if($key == 'res_email_perm' AND $value == 1)
          {
            $db_result[$key] = "Yes";
          }
          else if($key == 'res_email_perm' AND $value == 0)
          {
            $db_result[$key] = "No";
          }

          if($key == 'res_sms_perm' AND $value == 1)
          {
            $db_result[$key] = "Yes";
          }
          else if($key == 'res_sms_perm' AND $value == 0)
          {
            $db_result[$key] = "No";
          }

        }
        return $db_result;

	  }

	  public function change_default_eml_sms_param($db_result)
	  {

	  		 foreach ($db_result as $key => $value) 
	        {
	          if($key == 'client_owner')
	          {
	            $db_result[$key] = "Default";
	          }
	          
	          if($key == 'email_perm' AND $value == 1)
	          {
	            $db_result[$key] = "Yes";
	          }
	          else if($key == 'email_perm' AND $value == 0)
	          {
	            $db_result[$key] = "No";
	          }

	          if($key == 'sms_perm' AND $value == 1)
	          {
	            $db_result[$key] = "Yes";
	          }
	          else if($key == 'sms_perm' AND $value == 0)
	          {
	            $db_result[$key] = "No";
	          }

	        }
	        return $db_result;

	  }





	   public function checkOwnerAndEmailSmsParm($id)
	  {
	    $query = "SELECT * FROM accounts WHERE id = :id ";

	        $stmt = $this->dbh->prepare($query);
	        $exe = $stmt->execute(array(":id"=>$id));
	        if($stmt->rowCount() > 0)
	        {
	              $fetch_result = $stmt->fetch(PDO::FETCH_ASSOC);
	           
	            return $fetch_result;
	        }
	        else{
	          return false;
	        }
	  }


	   public function checkOwnerResellerEmailSmsParm($id)
	  {
	    $query = "SELECT * FROM account_reseller WHERE id = :id ";

	        $stmt = $this->dbh->prepare($query);
	        $exe = $stmt->execute(array(":id"=>$id));
	        if($stmt->rowCount() > 0)
	        {
	              $fetch_result = $stmt->fetch(PDO::FETCH_ASSOC);
	           
	            return $fetch_result;
	        }
	        else{
	          return false;
	        }
	  }


	  public function update_account_table_by_id($fname,$lname,$company,$website,$client_owner_new_id,$email,$address1,$address2,$city,$zip,$country,$phone,$password,$date,$email_access,$sms_access,$client_status,$parent,$cmd)
	  {

// update_account_table_by_id($fname,$lname,$company,$website,$client_owner_new_id,$email,$address1,$address2,$city,$zip,$country,$phone,$password,$date,$email_access,$sms_access,$client_status,"0",$cmd);
	     $query = "UPDATE accounts SET 
	                  name = :name,
	                  lname = :lname,
	                  company = :company,
	                  website = :website,
	                  client_owner = :client_owner,
	                  email  = :email,
	                  address1 = :address1,
	                  address2 = :address2,
	                  city =:city,
	                  postcode = :postcode,
	                  country = :country,
	                  phone = :phone,
	                  password = :password,
	                  datecreated = :datecreated,
	                  email_perm = :email_perm,
	                  sms_perm = :sms_perm,
	                  status = :status,
	                  parent = :parent
	                  WHERE id = :cmd
	          ";
	              $stmt =$this->dbh->prepare($query);

	              $udt_exe = $stmt->execute(array(":name"=>$fname,":lname"=>$lname,":company"=>$company,":website"=>$website,":client_owner"=>$client_owner_new_id,":email"=>$email,":address1"=>$address1,":address2"=>$address2,":city"=>$city,":postcode"=>$zip,":country"=>$country,":phone"=>$phone,":password"=>$password,":datecreated"=>$date,":email_perm"=>$email_access,":sms_perm"=>$sms_access,":status"=>$client_status,":parent"=>"0",":cmd"=>$cmd));

	              if($udt_exe)
	              {
	                return TRUE;
	              }
	              else{
	                return FALSE;
	              }

	  }



	   public function update_reseller_account_table_by_id($name,$lname,$company,$address1,$address2,$website,$city,$zip,$phone,$email,$country,$password,$email_access,$sms_access,$res_status,$date,$cmd)
	  {


	  	//     echo "name = ".$name."<br>";
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
    // echo "date = ".$date."<br>";
   
    // echo "initpassword = ".$initpassword."<br>";
    // echo "res_status = ".$res_status."<br>";

  
    // echo "email_access = ".$email_access."<br>";
    // echo "sms_access = ".$sms_access."<br>";
    // echo "cmd = ".$cmd."<br>";

	     $query = "UPDATE account_reseller SET 
	               res_name = :res_name,
	               res_lname = :res_lname,
	               res_company = :res_company,
	               res_website = :res_website,
	               res_email = :res_email,
	               res_address1 = :res_address1,
	               res_address2 = :res_address2,
	               res_city = :res_city,
	               res_postcode = :res_postcode,
	               res_country = :res_country,
	               res_phone = :res_phone,
	               res_password = :res_password,
	               res_datecreated = :res_datecreated,
	               res_email_perm = :res_email_perm,
	               res_sms_perm = :res_sms_perm,
	               res_status = :res_status
	                  WHERE id = :cmd
	          ";
	              $stmt =$this->dbh->prepare($query);

	              $udt_exe = $stmt->execute(array(':res_name'=>$name,':res_lname'=>$lname,':res_company'=>$company,':res_website'=>$website,':res_email'=>$email,':res_address1'=>$address1,':res_address2'=>$address2,':res_city'=>$city,':res_postcode'=>$zip,':res_country'=>$country,':res_phone'=>$phone,':res_password'=>$password,':res_datecreated'=>$date,':res_email_perm'=>$email_access,':res_sms_perm'=>$sms_access,':res_status'=>$res_status,':cmd'=>$cmd));

	              if($udt_exe)
	              {
	                return TRUE;
	              }
	              else{
	                return FALSE;
	              }

	  }


	   public function insert_account_info_verification_by_accId($cmd,$fname,$lname,$company,$website,$email,$client_owner_new_id,$address1,$address2,$city,$zip,$country,$phone,$password,$email_access,$sms_access,$client_status,$parent)
	  {

	       $query = "INSERT INTO account_info_verification(accounts_id,name,lname,company,website,email,client_owner,address1,address2,postcode,city,country,phone,password,email_perm,sms_perm,status,parent) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

	     $inst_stmt = $this->dbh->prepare($query);
	     $inst_exe = $inst_stmt->execute(array($cmd,$fname,$lname,$company,$website,$email,$client_owner_new_id,$address1,$address2,$zip,$city,$country,$phone,$password,$email_access,$sms_access,$client_status,$parent) );

	     $lst_inset_Id = $this->dbh->lastInsertId();

	     if($inst_exe)
	     {
	  
	      return $lst_inset_Id;
	     }
	     else{
	      return FALSE;
	     }


	  }


	  public function check_OldData_exist_or_not_into_account_info_verification($accounts_id)
	  {
	   $query = "SELECT * FROM account_info_verification WHERE accounts_id = :accounts_id ";
	        $stmt = $this->dbh->prepare($query);
	        $stmt->execute(array(":accounts_id"=>$accounts_id));
	        if($stmt->rowCount() > 0)
	        {
	          return TRUE;
	        }
	        else{
	         return false;
	        }
	  }

	  public function delete_data_from_account_info_verification($accounts_id)
	  {
	   $query = "DELETE FROM `account_info_verification` WHERE accounts_id = :accounts_id ";
	        $stmt = $this->dbh->prepare($query);
	        $exe = $stmt->execute(array(":accounts_id"=>$accounts_id));
	      
	  }

	  public function only_password_update_client_id($password,$cmd)
	  {

	  	
			$query = "UPDATE accounts SET password = ? WHERE id = ? ";
			$udtstmt = $this->dbh->prepare($query);
			$udt = $udtstmt->execute(array($password,$cmd));

			if($udt)
			{
				return TURE;
			
			}else{
				return FALSE;
			}
		
		
	  }


	   public function only_password_update_reseller_id($password,$cmd)
	  {

	  	
			$query = "UPDATE account_reseller SET res_password = ? WHERE id = ? ";
			$udtstmt = $this->dbh->prepare($query);
			$udt = $udtstmt->execute(array($password,$cmd));

			if($udt)
			{
				return TURE;
			
			}else{
				return FALSE;
			}
		
		
	  }


public function get_admin_all_info_byId($aid)
{

	$query = "SELECT * FROM admins WHERE id = ? ";
	  $a_stmt = $this->dbh->prepare($query);
	  $a_stmt->execute(array($aid));

	  if($a_stmt->rowCount() > 0)
	  {
	     $fetch_result = $a_stmt->fetch(PDO::FETCH_ASSOC);
	     return $fetch_result;
	  }
}


public function get_reseller_all_info_byId($id)
{

	$query = "SELECT * FROM account_reseller WHERE id = ? ";
	  $stmt = $this->dbh->prepare($query);
	  $stmt->execute(array($id));

	  if($stmt->rowCount() > 0)
	  {
	     $fetch_result = $stmt->fetch(PDO::FETCH_ASSOC);
	     return $fetch_result;
	  }
}





}



?>
