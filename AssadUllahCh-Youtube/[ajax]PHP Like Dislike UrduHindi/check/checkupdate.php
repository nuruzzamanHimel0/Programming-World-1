<?php 
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/project.php');
	$pro = new project();
	session_start();

	if($_SERVER['REQUEST_METHOD'] == "POST" AND $_SESSION['user_login'] == TRUE)
	{
		$question_id = $_POST['id'];
		$action = $_POST['action'];
		$user_id = $_SESSION['user_id'];
		$html_fetch = " ";

		// check like or dislike using question_id and user_id
		$status = $pro->get_question_status($question_id,$user_id);
		// if status alreay liked into DB and also hit the like button
		if($status['liked'] AND $action == 'like_opt' )
		{
			// if user already like the question and you again trying to like the question then it will be dislike
			$udt_act = $pro->update_action($action,$question_id,$user_id,"decriment",NULL);

			if($udt_act != FALSE)
			{
				$html_fetch = $pro->fetch_updated_row_by_qustId($question_id);
			}
			if(!empty($html_fetch))
			{
				// echo "Already liked and also click like button";
				echo json_encode([
					'status' => 'success',
					'html_fetch' =>$html_fetch
				]);
			}
			// echo "Like by be already";

			// echo "Question id=".$question_id." User id=".$user_id;
		}
		// if status already liked and trying to dislike
		else if($status['liked'] AND $action == 'dislike_opt' )
		{
			// if user already like the question and you tring to dislike
			// like decrement
			// dislike incremant
	$udt_act = $pro->update_action($action,$question_id,$user_id,"decriment","incriment");

			if($udt_act != FALSE)
			{
				$html_fetch = $pro->fetch_updated_row_by_qustId($question_id);
			}
			if(!empty($html_fetch))
			{
				echo json_encode([
					'status' => 'success',
					'html_fetch' =>$html_fetch
				]);
			}
			// echo "Like by be already";
		}

		else if($status['disliked'] AND $action == 'dislike_opt' )
		{
			// if user already disliked the question and you trying to disliked once more
			// disliked decrement
	$udt_act = $pro->update_action($action,$question_id,$user_id,NULL,"decriment");

			if($udt_act != FALSE)
			{
				$html_fetch = $pro->fetch_updated_row_by_qustId($question_id);
			}
			if(!empty($html_fetch))
			{
				echo json_encode([
					'status' => 'success',
					'html_fetch' =>$html_fetch
				]);
			}
			// echo "Like by be already";
		}
		else if($status['disliked'] AND $action == 'like_opt' )
		{
			// if user already disliked the question and you trying to disliked once more
			// disliked decrement
	$udt_act = $pro->update_action($action,$question_id,$user_id,"incriment","decriment");

			if($udt_act != FALSE)
			{
				$html_fetch = $pro->fetch_updated_row_by_qustId($question_id);
			}
			if(!empty($html_fetch))
			{
				echo json_encode([
					'status' => 'success',
					'html_fetch' =>$html_fetch
				]);
			}
			// echo "Like by be already";
		}
		else if( !$status['liked'] AND !$status['disliked'] )
		{
			// if user already disliked the question and you trying to disliked once more
			// disliked decrement
			$udt_act = $pro->update_action($action,$question_id,$user_id);

			if($udt_act != FALSE)
			{
				$html_fetch = $pro->fetch_updated_row_by_qustId($question_id);
			}
			if(!empty($html_fetch))
			{
				echo json_encode([
					'status' => 'success',
					'html_fetch' =>$html_fetch
				]);
			}
			// echo "Like by be already";
		}

		
	}

?>

