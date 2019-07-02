<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');

class Project{
	private $db;
	public function __construct(){
		$this->db = new Database();
	}


	public function checkUserFunction($username)
	{
		$query = " SELECT * FROM tbl_user WHERE userNmae = '$username' ";
		$result = $this->db->select($query);

		if($username == "")
		{
			echo "<span class='error'> Please Enter Username.</span>";
			exit();
		}
		elseif($result != FALSE)
		{
			echo "<span class='error'> <b>".$username." </b>not available</span>";
			exit();
		}
		else{
			echo "<span class='success'> <b>".$username."</b>  available</span>";
			exit();
		}
	}

	public function checkSkillFunction($skill)
	{
		$query = "SELECT * FROM tbl_skill WHERE skillName LIKE '%$skill%' ";
		$getSkill = $this->db->select($query);

		$result = " ";
		$result .= "<div class='skill' >";
		$result .= "<ul>";
		if($getSkill != FALSE)
		{
			while ($value = $getSkill->fetch_assoc()) {
				$result .= "<li><a href='#'>".$value['skillName']."</a> </li>";
			}
		}else{
			$result .= "<li> Result not Found </li>";
		}

		$result .="</ul> </div>";

		echo $result;
    exit();


	}

	public function checkRefresh($body)
	{
		$query = " INSERT INTO tbl_refresh(body) VALUES('$body') ";
		$insrt = $this->db->insert($query);
	}

	public function getRefresh($id)
	{
		$query = "SELECT * FROM tbl_refresh ORDER BY id DESC LIMIT 5 ";
		$getRef = $this->db->select($query);

		$result = " ";
		$result .= "<div class='refresh' >";
		$result .= "<ul>";
		if($getRef != FALSE)
		{
			while ($value = $getRef->fetch_assoc()) {
				$result .= "<li>$id<a href='#'>".$value['body']."</a> </li>";
			}
		}else{
			$result .= "<li> Result not Found </li>";
		}

		$result .="</ul> </div>";

		echo $result;
    exit();
	}

	public function checkLiveSearch($search)
	{


		$query = "SELECT * FROM tbl_search WHERE username LIKE '%$search%' OR name LIKE '%$search%' OR email LIKE '%$search%' ";
		$getS = $this->db->select($query);

		if($getS != FALSE)
		{
			$i = 0;

			$data = "";
			$data .= "<table class='tblone'  > <tr>";
			$data .= "<th> No </th>";
			$data .= "<th>  username</th>";
			$data .= "<th> name </th>";
			$data .= "<th> email </th> </tr>";

			while ($value = $getS->fetch_assoc()) {
			$data .= "<tr>";
			$data .= "<td> ".++$i."</td>";
			$data .= "<td> ".$value['username']."</td>";
			$data .= "<td> ".$value['name']."</td>";
			$data .= "<td> ".$value['email']."</td>";
			$data .= "</tr> ";
			}
			$data .="</table>";
			echo $data;
			exit();


		}
		else{
			echo "Search not found";
			exit();
		}

	}

		public function autosavafunc($content,$contentId)
	{
		if($contentId != "")
		{
			$query = "UPDATE tbl_autosave
					SET content = '$content'
					WHERE contentId = '$contentId'
			";
			$udt_cont = $this->db->update($query);

			if($udt_cont != FALSE)
			{
				echo "Content update and save as Draft "; // make reflection................
				exit();
			}

		}
		else{


			$query = "INSERT INTO tbl_autosave(content,status) VALUES('$content','draft')";
			$insert_row = $this->db->insert($query);
			$lstid = $this->db->link->insert_id;
			echo $lstid; // make reflection................
			exit();




		}



	}


}
?>
