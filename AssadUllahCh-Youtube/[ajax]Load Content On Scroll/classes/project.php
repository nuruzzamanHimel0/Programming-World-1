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


		public function get_data_from_videos($offset,$row)
		{
			$query = "SELECT * FROM `video` ORDER BY id ASC LIMIT $offset , $row";
			$result = $this->db->select($query);

			
			if($result != false)
			{
				$data = " ";
				while($value = $result->fetch_assoc())
				{
					$data .= " <div class='card'>";
					$data .= " <div class='card-header bg-primary'>".$value['id']."--".$value['title'];
					$data .= "</div><div class='card-body'><p class='card-text'>".$value['description'];
					$data .= " </p></div> </div> <br><br>";
				}

				echo $data;
			}
			
		}

	

	}

?>

