<?php 
		
	
	 
	 include("Main.php");

	class Teacher extends Main
	{
		
		protected $table = 'tbl_teachers';

		public function insertData($name,$dept,$age)
        {
        	$query = "INSERT INTO ".$this->table."(name,dept,age) VALUES(?,?,?)";
        	$stmt = Db::prepare($query);  // $stmt = $db->prepare($query);
        	$executed = $stmt->execute(array($name,$dept,$age));

        	if($executed != FALSE)
        	{
        		return "<span class='insert'>Data Insert Successfully  </span>";
        	}
        	else{
        		return "<span class='delete'>Fail to Data Insert Successfully  </span>";
        	}
        }

       
        public function updateData($id,$name,$dept,$age)
        {
        	$query = "UPDATE ".$this->table." SET name = ?,dept=?,age=? WHERE id = ? ";
        	$stmt = Db::prepare($query);  // $stmt = $db->prepare($query);
        	$executed = $stmt->execute(array($name,$dept,$age,$id));

        	if($executed != FALSE)
        	{
        		return "<span class='insert'>Data Update Successfully  </span>";
        	}
        	else{
        		return "<span class='delete'>Fail to Data Update Successfully  </span>";
        	}
        }

       

        public function deleteData($id)
        {
        	$query = "DELETE FROM ".$this->table." WHERE id = :id";
        	$stmt = Db::prepare($query);  // $stmt = $db->prepare($query);
        	$executed = $stmt->execute(array(":id"=>$id));

        	if($executed != FALSE)
        	{
        		return "<span class='insert'>Data Deleted Successfully  </span>";
        	}
        	else{
        		return "<span class='delete'>Fail to Data Deleted Successfully  </span>";
        	}
        }
		
	}

?>