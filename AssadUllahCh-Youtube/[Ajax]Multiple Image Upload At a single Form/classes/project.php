 <?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');

	class project
	{
		private $db;
		public function __construct()
		{
			$this->db = new Database();
		}


		
		public function getResult()
		{
			$query = "SELECT q.*,ql.user_id,sum(ql.like_opt) AS LIKE_OPT,sum(ql.dislike_opt) AS DISLIKE_OPT 
					FROM question_table AS q 
					INNER JOIN question_like AS ql 
						ON  q.id = ql.question_id GROUP BY question_id
			";

			// $query = "SELECT * FROM question_table";
			$result = $this->db->select($query);
				$data = " ";
			if($result != FALSE)
			{
			
				while ($value = $result->fetch_assoc()) 
				{

					$data .= "<div class='col-md-12 mt-3'>";
					$data .= "<h3>".$value['title']."</h3>";
					$data .= "<p class='lead'>".$value['description']." </p>";
					$data .= "<hr class='my-1'>";
					$data .= "<div class='footer-icon'>";
					$data .= "<ul class='questions'>";

						if($value['LIKE_OPT'] AND !$value['DISLIKE_OPT'])
						{
							$data .='<li>';
				            $data .='<a href="#" class="like" data-id="'.$value['id'].'">';
				            $data .='<i class="fa fa-thumbs-up"></i>';
				            $data .='<span class="like-counter">'.$value['LIKE_OPT'].'</span>';
				            $data .='</a>';
				            $data .='</li>';

							$data .='<li>';
							$data .='<a href="#" class="empty" data-id="'.$value['id'].'">';
							$data .='<i class="fa fa-thumbs-down"></i>';
							$data .='<span class="dislike-counter"></span>';
							$data .='</a>';
							$data .='</li>';
						}
						else if(!$value['LIKE_OPT'] AND $value['DISLIKE_OPT'])
						{
							$data .='<li>';
				            $data .='<a href="#" class="empty" data-id="'.$value['id'].'">';
				            $data .='<i class="fa fa-thumbs-up"></i>';
				            $data .='<span class="like-counter"></span>';
				            $data .='</a>';
				            $data .='</li>';

							$data .='<li>';
							$data .='<a href="#" class="dislike" data-id="'.$value['id'].'">';
							$data .='<i class="fa fa-thumbs-down"></i>';
							$data .='<span class="dislike-counter">'.$value['DISLIKE_OPT'].'</span>';
							$data .='</a>';
							$data .='</li>';
						}
						else if($value['LIKE_OPT'] AND $value['DISLIKE_OPT'])
						{
							$data .='<li>';
				            $data .='<a href="#" class="like" data-id="'.$value['id'].'">';
				            $data .='<i class="fa fa-thumbs-up"></i>';
				            $data .='<span class="like-counter">'.$value['LIKE_OPT'].'</span>';
				            $data .='</a>';
				            $data .='</li>';

				            $data .='<li>';
							$data .='<a href="#" class="dislike" data-id="'.$value['id'].'">';
							$data .='<i class="fa fa-thumbs-down"></i>';
							$data .='<span class="dislike-counter">'.$value['DISLIKE_OPT'].'</span>';
							$data .='</a>';
							$data .='</li>';
						}
						else if(!$value['LIKE_OPT'] AND !$value['DISLIKE_OPT'])
						{
							$data .='<li>';
				            $data .='<a href="#" class="empty" data-id="'.$value['id'].'">';
				            $data .='<i class="fa fa-thumbs-up"></i>';
				            $data .='<span class="like-counter"></span>';
				            $data .='</a>';
				            $data .='</li>';

				            $data .='<li>';
							$data .='<a href="#" class="empty" data-id="'.$value['id'].'">';
							$data .='<i class="fa fa-thumbs-down"></i>';
							$data .='<span class="dislike-counter"></span>';
							$data .='</a>';
							$data .='</li>';
						}

						$data .= "</ul> </div> </div>";

				}

				echo $data;
			}
			else{
				echo "<b>No Record exist into Database </b>";
			}
		}

		public function userLogin($email,$password)
		{
			$message = " ";
			$query = "SELECT * FROM user_table WHERE email ='$email' AND password='$password' LIMIT 1 ";
			$result = $this->db->select($query);

			if($result != FALSE)
			{
				$fetch_reslt = $result->fetch_assoc();
				$_SESSION['user_id'] = $fetch_reslt['id'];
				$_SESSION['user_email'] = $fetch_reslt['email'];
				$_SESSION['user_login'] = TRUE;

				// return $_SESSION['user_id']." ".$_SESSION['user_email']." ".$_SESSION['user_login'];
				header('Location: index.php');

				exit();

				// $message = "User login";
				// return $message;


			}
			else{
				$message = "Email and Password not match";
				return $message;
			}
		}


		public function get_question_status($question_id,$user_id)
		{
			$query = "SELECT like_opt AS liked, dislike_opt AS disliked FROM question_like WHERE user_id = '$user_id' AND question_id = '$question_id' ";
			$result = $this->db->select($query);

			if($result != FALSE)
			{
				$fetch_reslt = $result->fetch_assoc();
				// echo $fetch_reslt['liked']." ".$fetch_reslt['disliked'];
				return $fetch_reslt;
			}
			// echo $question_id." ".$user_id;
		}

		public function update_action($action,$question_id,$user_id,$like=NULL,$dislike=NULL)
		{
			if($like == 'decriment' AND empty($dislike))
			{
				// $like = $like-1;
				$query = "DELETE FROM question_like WHERE question_id = '$question_id' AND user_id = '$user_id' ";
				$result = $this->db->delete($query);
				if($result)
				{
					return TRUE;
				}
				else{
					return FALSE;
				}
			}

			if($like == 'decriment' AND $dislike == 'incriment')
			{
				// $like = $like-1;
				$query = "UPDATE question_like SET like_opt =like_opt-1,dislike_opt=dislike_opt+1 WHERE question_id = '$question_id' AND user_id = '$user_id' ";
				$result = $this->db->update($query);
				if($result)
				{
					return TRUE;
				}
				else{
					return FALSE;
				}
			}	

			if($dislike == 'decriment' AND empty($like))
			{
				// $like = $like-1;
				$query = "DELETE FROM question_like WHERE question_id = '$question_id' AND user_id = '$user_id' ";
				$result = $this->db->delete($query);
				if($result)
				{
					return TRUE;
				}
				else{
					return FALSE;
				}
			}

			if($dislike == 'decriment' AND $like === 'incriment')
			{
				// $like = $like-1;
				$query = "UPDATE question_like SET like_opt =like_opt+1,dislike_opt=dislike_opt-1 WHERE question_id = '$question_id' AND user_id = '$user_id' ";
				$result = $this->db->update($query);
				if($result)
				{
					return TRUE;
				}
				else{
					return FALSE;
				}
			}

			if(empty($dislike) AND empty($like))
			{
				// $like = $like-1;
				$query = "UPDATE question_like SET like_opt =like_opt+1,dislike_opt=dislike_opt-1 WHERE question_id = '$question_id' AND user_id = '$user_id' ";
				$result = $this->db->update($query);
				if($result)
				{
					return TRUE;
				}
				else{
					return FALSE;
				}
			}



		}

		public function fetch_updated_row_by_qustId($question_id)
		{

			$data = " ";
			$query = "SELECT question_id AS id, SUM(like_opt) AS likes, SUM(dislike_opt) AS dislikes FROM question_like WHERE question_id = '$question_id' ";

			$result = $this->db->select($query);

			if($result != FALSE)
			{
				$value = $result->fetch_assoc();

				$data .= "<ul class='questions'>";

						if($value['likes'] AND !$value['dislikes'])
						{
							$data .='<li>';
				            $data .='<a href="#" class="like" data-id="'.$value['id'].'">';
				            $data .='<i class="fa fa-thumbs-up"></i>';
				            $data .='<span class="like-counter">'.$value['likes'].'</span>';
				            $data .='</a>';
				            $data .='</li>';

							$data .='<li>';
							$data .='<a href="#" class="empty" data-id="'.$value['id'].'">';
							$data .='<i class="fa fa-thumbs-down"></i>';
							$data .='<span class="dislike-counter"></span>';
							$data .='</a>';
							$data .='</li>';
						}
						else if(!$value['likes'] AND $value['dislikes'])
						{
							$data .='<li>';
				            $data .='<a href="#" class="empty" data-id="'.$value['id'].'">';
				            $data .='<i class="fa fa-thumbs-up"></i>';
				            $data .='<span class="like-counter"></span>';
				            $data .='</a>';
				            $data .='</li>';

							$data .='<li>';
							$data .='<a href="#" class="dislike" data-id="'.$value['id'].'">';
							$data .='<i class="fa fa-thumbs-down"></i>';
							$data .='<span class="dislike-counter">'.$value['dislikes'].'</span>';
							$data .='</a>';
							$data .='</li>';
						}
						else if($value['likes'] AND $value['dislikes'])
						{
							$data .='<li>';
				            $data .='<a href="#" class="like" data-id="'.$value['id'].'">';
				            $data .='<i class="fa fa-thumbs-up"></i>';
				            $data .='<span class="like-counter">'.$value['likes'].'</span>';
				            $data .='</a>';
				            $data .='</li>';

				            $data .='<li>';
							$data .='<a href="#" class="dislike" data-id="'.$value['id'].'">';
							$data .='<i class="fa fa-thumbs-down"></i>';
							$data .='<span class="dislike-counter">'.$value['dislikes'].'</span>';
							$data .='</a>';
							$data .='</li>';
						}
						else if(!$value['likes'] AND !$value['dislikes'])
						{
							$data .='<li>';
				            $data .='<a href="#" class="empty" data-id="'.$value['id'].'">';
				            $data .='<i class="fa fa-thumbs-up"></i>';
				            $data .='<span class="like-counter"></span>';
				            $data .='</a>';
				            $data .='</li>';

				            $data .='<li>';
							$data .='<a href="#" class="empty" data-id="'.$value['id'].'">';
							$data .='<i class="fa fa-thumbs-down"></i>';
							$data .='<span class="dislike-counter"></span>';
							$data .='</a>';
							$data .='</li>';
						}

						$data .= "</ul>";

						return $data;
			}
		}
	

	}

?>

