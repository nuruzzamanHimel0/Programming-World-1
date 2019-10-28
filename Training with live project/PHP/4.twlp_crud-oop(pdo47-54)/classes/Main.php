<?php 
	

	// DB include 
	// 
	// 
	abstract class Main
	{
		protected $table;

		abstract public function insertData($name,$dept,$age);
		abstract public function updateData($id,$name,$dept,$age);
		abstract public function deleteData($id);
		
		public function readAll()
        {
            $query = "SELECT * FROM ".$this->table;
            $stmt = Db::prepare($query);  //$stmt = $conn->prepare($query)
            $stmt->execute();
            return $stmt->fetchAll();
        }

         

         public function readById($id)
        {
        	$query = "SELECT * FROM ".$this->table." WHERE id = :id" ;
        	$stmt = Db::prepare($query);  // $stmt = $db->prepare($query);
        	$stmt->execute(array(':id'=>$id));

        	if($stmt->rowCOunt()>0)
        	{
        		return $stmt->fetch();
        	}
        	else{
        		return FALSE;
        	}

        }


	}

?>