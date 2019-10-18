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

		public function getSuggestion($result)
		{

			
			$sql = "SELECT DISTINCT q.* 
			FROM question_keywords as qk
				INNER JOIN keywords as k
					ON qk.keywords_id = k.id AND k.keywords_label LIKE '%$result%'
				INNER JOIN questions as q
					ON qk.question_id = q.id AND q.title LIKE '%$result%' AND q.descriptions LIKE '%$result%' LIMIT 5
			";

			$get_select = $this->db->select($sql);
			

			

			if($get_select != FALSE)
			{
				$result = " ";
			$result .= "<div class='result-wrapper'><ul>";
				while($value = $get_select->fetch_assoc())
				{
					$result .= "<li> <a href='search.php?id=".$value["id"]." '>".$value['title']."</a></li>";
				}
				$result .= "</ul></div>";

			echo $result;

			}

			

		}

		public function get_question_keywords_id($id)
		{
			$query = " SELECT * FROM question_keywords WHERE id = '$id' ";
			$result = $this->db->select($query);

			if($result != FALSE)
			{
				return $result->fetch_assoc();
			}
		}

		public function get_question_keywords_result($keyword_id,$question_id)
		{
			$query ="SELECT keywords.keywords_label,questions.title,questions.descriptions 
				FROM question_keywords
					INNER JOIN keywords
 						ON question_keywords.keywords_id = keywords.id AND keywords.id = '$keyword_id'
 					INNER JOIN questions
 						ON question_keywords.question_id = questions.id AND questions.id = '$question_id' ";
 			$result = $this->db->select($query);
 			
 			if($result != FALSE)			
 			{
 				return $result->fetch_assoc();
 			}

		}

	}

?>

