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

			// echo $offset." ---- ".$row;
			$query = "SELECT * FROM video LIMIT $offset, $row ";
			$result = $this->db->select($query);

			if($result != FALSE)
			{
				$data = " ";
				while ($value = $result->fetch_assoc()) {
					// echo $value['id']."<br> ----".$value['title']."<br> ----".$value['description']."<br>";
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

