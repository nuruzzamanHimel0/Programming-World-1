 <?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
date_default_timezone_set('Asia/Kolkata');
	class project
	{
		private $db;
		public function __construct()
		{
			$this->db = new Database();
		}

		public function fetch_user_details_wo_login($user_id)
		{
			date_default_timezone_set('Asia/Kolkata');

			$output = " ";
			$query = "SELECT * FROM login WHERE user_id != '$user_id' ";
			$result = $this->db->select($query);
			if($result != FALSE)
			{
				$output .= '<table class="table table-bordered table-striped"><tr> ';
 				$output .= '<td>Username</td> ';
 				$output .= '<td>Status</td> ';
 				$output .= '<td>Action</td> </tr>';

 				while ($value = $result->fetch_assoc()) 
 				{
 					// ONline OR Offline checkiing.............

 					  $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 						$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 					   $user_last_activity = $this->fetch_user_last_activity($value['user_id']); 

 					   	// 4. Display Online / Offline User Status in Live chat application..................

 					    if($user_last_activity > $current_timestamp)
						 {
						  $status = '<span class="badge  badge-success">Online</span>';
						 }
						 else
						 {
						  $status = '<span class="badge  badge-danger">Offline</span>';
						 }
 					// ---------------- end ---------------------
						 // 8. Make New Message Notification in Chat Application.................
 					$output .= '<tr><td>'.$value['username']." ".$this->count_unseen_message($value['user_id'], $_SESSION['user_id'])." ".$this->fetch_is_type_status($value['user_id']). '</td> ';
 					$output .= '<td> '.$status.'</td> ';
 					$output .= '<td>
 					<button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$value['user_id'].'" data-tousername="'.$value['username'].'">Start Chat</button></td></tr> ';
 				}
 				$output .= "</table>";

 				echo $output;


			}

		}

		public function fetch_is_type_status($user_id)
		{
			$output = "";
			$query = "SELECT is_type FROM  login_details WHERE user_id = '".$user_id."' ORDER BY last_activity  DESC LIMIT  1 ";
			$result = $this->db->select($query);
			if($result != FALSE)
			{
				while ($value = $result->fetch_assoc())
				 {
					if($value['is_type'] == 'yes')
					{
						$output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
					}
				}
				return $output;
			}
		}

		public function count_unseen_message($from_user_id, $to_user_id)
		{
			// return $from_user_id." -- -".$to_user_id;
			$query = "SELECT * FROM chat_message WHERE from_user_id = '$from_user_id' AND to_user_id = '$to_user_id' AND status = '1' ";
			$result = $this->db->select($query);
			if($result != FALSE)
			{
				$count = $result->num_rows;
				if($count >0)
				{
					return  '<span class="badge  badge-success">'.$count.'</span>';
				}
			}

		}

		public function fetch_user_last_activity($user_id)
		{
			 $query = "SELECT * FROM login_details WHERE user_id = '$user_id' ORDER BY last_activity DESC  LIMIT 1 ";

			 // return $query;
			 $result = $this->db->select($query);

			 if($result != false)
			 {
			 	while ($value = $result->fetch_assoc()) {
			 		return $value['last_activity'];
			 	}
	
			 }

		}

		public function check_update_last_activity($login_details_id)
		{
			$query = "
			UPDATE login_details 
			SET last_activity = now()
			WHERE login_details_id = '$login_details_id'
			";
			$result = $this->db->update($query);
			if($result != FALSE)
			{
				// echo "Update Result Activity";
			}

		}

		public function check_insert_chatting_message($to_user_id,$from_user_id,$chat_message,$status)
		{
			$query = "
			INSERT INTO chat_message 
			(to_user_id, from_user_id, chat_message, status) 
			VALUES ('$to_user_id','$from_user_id','$chat_message','$status')
			";
			$result = $this->db->insert($query);

			if($result != FALSE)
			{
				echo $this->fetch_user_chat_history($from_user_id,$to_user_id);
			}

			// echo $query;
		}

		public function remove_chat_method($chat_message_id)
		{
			$query = "UPDATE chat_message 
					  SET status = '2' 
					  WHERE chat_message_id = '$chat_message_id'
			";
			$result = $this->db->update($query);
		}

		public function fetch_user_chat_history($from_user_id,$to_user_id)
		{
			 $query = "
			 SELECT * FROM chat_message 
			 WHERE (from_user_id = '".$from_user_id."' 
			 AND to_user_id = '".$to_user_id."') 
			 OR (from_user_id = '".$to_user_id."' 
			 AND to_user_id = '".$from_user_id."') 
			 ORDER BY timestamp DESC
			 ";
			 $result = $this->db->select($query);

			 if($result != FALSE)
			 {
			 	$output = '<ul class="list-unstyled">';
			 	while ($row = $result->fetch_assoc()) 
			 	{
			 		 $user_name = '';
					  if($row["from_user_id"] == $from_user_id)
					  {

					  	if($row['status'] == '2')
					  	{
						  $chat_message = '<em>This message has been removed</em>'; 
						  $user_name = '<b class="text-success">You</b>';
					  	}else{
					  		 $chat_message = $row['chat_message'];
    						$user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
					  	}
					   // $user_name = '<b class="text-success">You</b>'; 
					  	// $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>'; 

					  	$dynamic_background = 'background-color:#ffe6e6;';
					  }
					  else
					  {

					  	if($row['status'] == '2')
					  	{
						  $chat_message = '<em>This message has been removed</em>'; 
						 
					  	}else{
					  		 $chat_message = $row['chat_message'];
    						
					  	}


					   $user_name = '<b class="text-danger">'.$this->get_user_name($to_user_id).'</b>';
					      $dynamic_background = 'background-color:#ffffe6;';
					  } 

					   $output .= '
					  <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
					   <p>'.$user_name.' - '.$chat_message.'
					    <div align="right">
					     - <small><em>'.$row['timestamp'].'</em></small>
					    </div>
					   </p>
					  </li>
					  ';
			 	}

			 	$output .= '</ul>'; 

			 	// IF Click Start_chat Button then NNotification will be removed 
			 	
// 8. Make New Message Notification in Chat Application.................
			 	$query = " UPDATE chat_message
					SET status = '0'
					WHERE from_user_id = '$to_user_id'
					AND 
					to_user_id = '$from_user_id' 
					AND 
					status = '1'
			 	";
			 	$result = $this->db->update($query);

			 	if($result != FALSE)
			 	{
			 		
 				return $output;
			 	}


			 }

		}

		public function get_user_name($user_id)
		{
			$query = "SELECT username FROM login WHERE user_id = '$user_id'";
			$result = $this->db->select($query);

			if($result != FALSE)
			{
				 
				// return $fetch_result['username'];
				while ($value = $result->fetch_assoc()) {
					return $value['username'];
				}
			}
		}


		public function update_is_type_status($login_details_id,$is_type)
		{
			$query = "
			UPDATE login_details 
			SET is_type = '".$is_type."' 
			WHERE login_details_id = '".$login_details_id."'
			";
			$result = $this->db->update($query); 

			// echo $login_details_id." -- ".$is_type;
			// echo $query;
		}

		public function insert_group_chat($from_user_id,$chat_message,$status)
		{
			$query = "
			 INSERT INTO chat_message 
			 (to_user_id,from_user_id, chat_message, status) 
			 VALUES ('0','$from_user_id', '$chat_message', '$status')
			 ";

			$result = $this->db->insert($query);
			if($result != FALSE)
			{
				echo $this->fetch_group_chat_history();
			}


		}

		public function fetch_group_chat_history()
		{
			 $query = "
			 SELECT * FROM chat_message 
			 WHERE to_user_id = '0'  
			 ORDER BY timestamp DESC
			 ";
			 $result = $this->db->select($query);
			 if($result != FALSE)
			 {
			 	$output = '<ul class="list-unstyled">';
			 	while ($row = $result->fetch_assoc())
			 	{

			 		 $user_name = '';
					  if($row["from_user_id"] ==  $_SESSION["user_id"])
					  {

					  	if($row['status'] == '2')
					  	{
						  $chat_message = '<em>This message has been removed</em>'; 
						  $user_name = '<b class="text-success">You</b>';
					  	}else{
					  		 $chat_message = $row['chat_message'];
    						$user_name = '<button type="button" class="btn btn-danger btn-xs remove_group_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
					  	}

					  	$dynamic_background = 'background-color:#ffe6e6;';
					  }
					  else
					  {

					  	if($row['status'] == '2')
					  	{
						  $chat_message = '<em>This message has been removed</em>'; 
						 
					  	}else{
					  		 $chat_message = $row['chat_message'];
    						
					  	}


					   $user_name = '<b class="text-danger">'.$this->get_user_name($row["from_user_id"] ).'</b>';
					      $dynamic_background = 'background-color:#ffffe6;';
					  } 


					   $output .= '
					  <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
					   <p>'.$user_name.' - '.$chat_message.'
					    <div align="right">
					     - <small><em>'.$row['timestamp'].'</em></small>
					    </div>
					   </p>
					  </li>
					  ';

			 	}

			 	 $output .= '</ul>';
 				return $output;

			 }
		}

	

	

	}

?>

