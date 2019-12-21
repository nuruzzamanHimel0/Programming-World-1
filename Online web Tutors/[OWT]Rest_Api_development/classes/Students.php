<?php


class Students{

	public $name;
	public $email;
	public $mobile;
	public $status;

	public $id;

	private $db;
	private $table_name;

	public function __construct()
	{
		$this->db = new Database();
		$this->table_name = 'tbl_students';
	}

	public function create_data()
	{
		$query ="INSERT INTO ".$this->table_name."(name,email,mobile) VALUES('".$this->name."','".$this->email."','".$this->mobile."' ) ";
		$result = $this->db->insert($query);
		if($result)
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function get_all_data()
	{
		$query="SELECT * FROM ".$this->table_name." ";
		$result = $this->db->select($query);

		if($result != FALSE)
		{
			return $result;
		}
	}

	public function get_single_student()
	{
		$query="SELECT * FROM ".$this->table_name." WHERE id = ".$this->id." ";
		$result = $this->db->select($query);

		if($result != FALSE)
		{
			return $result->fetch_assoc();
		}
		else{
			return false;
		}
	}

	public function update_student()
	{
		$query = "UPDATE ".$this->table_name." SET name = '".$this->name."',email = '".$this->email."', mobile='".$this->mobile."' WHERE id = '".$this->id."'  ";
		$result = $this->db->update($query);

		if($result != FALSE)
		{
			return true;
		}
		else{
			return false;
		}
	}

	public function delete_student()
	{
		$query = "DELETE FROM ".$this->table_name." WHERE id = ".$this->id." ";
		$result = $this->db->delete($query);

		if($result != FALSE)
		{
			return true;
		}
		else{
			return false;
		}
	}

	


	
}
?>