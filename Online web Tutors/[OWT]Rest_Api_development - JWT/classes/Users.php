<?php


class Users{

	public $name;
	public $email;
	public $password;
	public $user_id;
	public $project_name;
	public $description;
	public $status;
 

	public $project_id;

	private $db;
	private $user_table;
	private $project_table;

	public function __construct()
	{
		$this->db = new Database();
		$this->user_table = 'tbl_user';
		$this->project_table = 'tbl_project';
	}


	public function create_user()
	{
		$query = "INSERT INTO ".$this->user_table."(name,email,password) VALUES('".$this->name."','".$this->email."','".$this->password."' ) ";
		$result = $this->db->insert($query);

		if($result)
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function check_email()
	{
		$query = "SELECT * FROM ".$this->user_table." WHERE email = '".$this->email."' ";
		$result = $this->db->select($query);

		if($result)
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function check_login()
	{
		$query = "SELECT * FROM ".$this->user_table." WHERE email = '".$this->email."' ";
		$result = $this->db->select($query);

		if($result)
		{
			return $result->fetch_assoc();
		}
		else{
			return FALSE;
		}

	}


	public function create_project()
	{
		$query = "INSERT INTO ".$this->project_table."(user_id,project_name,description,status) VALUES('".$this->user_id."','".$this->project_name."','".$this->description."','".$this->status."' ) ";
		$result = $this->db->insert($query);

		if($result)
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}


	public function get_all_project()
	{
		$query = "SELECT * FROM  ".$this->project_table." ORDER BY id DESC ";
		$result_obj = $this->db->select($query);
		if($result_obj != FALSE)
		{
			return $result_obj;
		}
		else{
			return FALSE;
		}

	}

	public function get_user_all_project()
	{
		$query = "SELECT * FROM  ".$this->project_table." WHERE user_id = ".$this->user_id." ORDER BY id DESC ";
		$result_obj = $this->db->select($query);
		if($result_obj != FALSE)
		{
			return $result_obj;
		}
		else{
			return FALSE;
		}

	}


	
	


	
}
?>