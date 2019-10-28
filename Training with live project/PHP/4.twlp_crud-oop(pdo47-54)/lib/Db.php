<?php 
	
	class Db 
	{
		private static $pdo;
		
		public static function connection()
		{
			if(!isset(self::$pdo))
			{
				try {
				self::$pdo =  new PDO("mysql:dbname=".DB_NAME.";host=".HOST,USER,PASS);
				
				} catch (PDOException $e) {
					echo "DB Connection Fail".$e->getMessage();
				}
			}
			return self::$pdo;
		}

		public static function prepare($query)
		{
			// $stmt = $conn->prepare($query);
			return self::connection()->prepare($query);
		}



	}


?>