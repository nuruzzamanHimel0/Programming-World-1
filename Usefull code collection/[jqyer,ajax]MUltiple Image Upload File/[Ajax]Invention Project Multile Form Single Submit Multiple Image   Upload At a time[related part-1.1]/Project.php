<?php

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
