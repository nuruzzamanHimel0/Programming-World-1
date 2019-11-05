<?php 
    include('manager/init.php');  // WHMCS Encripted File
    include('lib/functions.php');

    // PDO Connect with WHMCS
     use WHMCS\Database\Capsule;
// 	$pdo = Capsule::connection()->getPdo();
// 	$pdo->beginTransaction();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index</title>
</head>
<body>

<?php 
  // ---------------- GeoIp2--------------------
  require 'vendor/autoload.php';
  use GeoIp2\Database\Reader;
$reader = new Reader('vendor/GeoLite2-Country/GeoLite2-Country.mmdb');
$record = $reader->country(getUserIP());
$country = $record->country->isoCode;
//echo $country;
// .................. End.....................

// $stmt = $pdo->prepare("SELECT * FROM tblclients WHERE id = :id ");
// $stmt->execute(array(':id'=>5));
// $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
//  echo "<pre>";
// print_r($fetch);
//   $pdo->commit();   
//   
// ------------------ laravel query Bilder-----------------------

?>
<h1>...............Laravel Query Stirng.............................</h1>




<?php 
// --------------# Get All Data from this table #.............
	$users = Capsule::table('tblclients')->where('id','5')->get();
	// echo "<pre>";
	// print_r($users);
	
	// foreach ($users as $user) {
 	// $fn = $user->firstname;
 	// $ln = $user->lastname;
	// }
	// echo $fn." ".$ln;
	
	
?>

<?php 

//-----------# Retrieving A Single Row / Column From A Table #-----------

	$user = Capsule::table('tblclients')->where('id', '5')->first();
	// echo "<pre>";
	// print_r($user);
	// echo $user->firstname." ".$user->lastname."<br><br>";

	// foreach ($user as $key => $value) {
 //    echo $key." = ".$value."<br>";
	// }
?>

<?php 
// If you don't even need an entire row, you may extract a single value from a record using the value method. It take sigle value from a single row


	$user = Capsule::table('tblclients')->value('email');

	$user = Capsule::table('tblclients')->where('id',5)->value('email');
	
	// echo $user;
	
?>


<?php 
// To retrieve a single row by its id column value, use the find method:
// 
	$user = Capsule::table('tblclients')->find(5);
	// echo "<pre>";
	// print_r($user);
	// echo $user->firstname." ".$user->lastname."<br>"."<br>";

	// foreach ($user as $key => $value) {
 //    echo $key." = ".$value."<br>";
	// }
?>
<!-- ------------------------- OR ---------------------------- -->
<?php 
// To retrieve a single row by its id column value, use the find method:
// 
	$user = Capsule::table('tblclients')->select('firstname','lastname')->find(5);
	// echo "<pre>";
	// print_r($user);
	// echo $user->firstname." ".$user->lastname."<br>"."<br>";

	// foreach ($user as $key => $value) {
 //    echo $key." = ".$value."<br>";
	// }
?>



<!-- ----------Retrieving A List Of Column Values....................... -->

<!-- #### pluck -->
<?php 

// Collection containing the values of a single column
// 
// get firstname where id = 5 in the table
$user = Capsule::table('tblclients')->where('id','5')->pluck('firstname');

// //GET all firstname form the table 'tblclients' then

	$user = Capsule::table('tblclients')->pluck('firstname');
	// echo "<pre>";
	// print_r($user);
	// echo $user->firstname." ".$user->lastname."<br>"."<br>";

	// foreach ($user as $ur) {
 //    echo $ur."<br>";
	// }
?>

<?php 
// You may also specify a custom " key column " for the returned Collection:

	$user = Capsule::table('tblclients')->pluck('lastname', 'firstname');
	// echo "<pre>";
	// print_r($user);
	// echo $user->firstname." ".$user->lastname."<br>"."<br>";
	// print_r($user);

	// foreach ($user as $ur) {
 //    echo $ur."<br>";
		// }
?>


<!-- ####--------------------Chunking Results ----------------- -->
<?php 
// If you need to work with thousands of database records, consider using the chunk method

	// Capsule::table('tblclients')->orderBy('id')->chunk(10,function ($users) {
	//     foreach ($users as $user) 
	//     {
	    
	//        // echo $user->firstname."<br>";
	       
	//     }
	// });
?>

<?php 
// Determining If Records Exist

	// $user = Capsule::table('tblclients')->where('id','5')->exists();
	// echo $user;
?>

<!-- ======================== # SELECT # =================== -->
<!-- ## first ## -->
<?php 
	
	// $user = Capsule::table('tblclients')->select('firstname','lastname')->where('id','5')->first();
	// echo "<pre>";
	// print_r($user);

	// echo $user->firstname;
?>

<!-- ======================== # Determining If Records Exist # =================== -->
<!-- ## first ## -->
<?php 
	
	$user = Capsule::table('tblclients')->where('id', 5)->exists();;
	// echo "exists = ".$user;
?>

<!-- ## get ## -->
<?php 
	
$users = Capsule::table('tblclients')->select('firstname','lastname as LASTNAME')->where('id','5')->get();
	// echo "<pre>";
	// print_r($users);

	// foreach ($users as $user) {
	// 	echo  $user->firstname . " ".$user->lastname;
	// }
	
?>

<!-- ==== # distinct # ==== -->

<?php 
	// The distinct method allows you to force the query to return distinct results:
	// 
$users = Capsule::table('tblclients')->distinct()->get();
	// echo "<pre>";
	// print_r($users);

	// // foreach ($users as $user) {
	// // 	echo  $user->firstname . " ".$user->lastname;
	// // }
	
?>

<!-- =========== # addSelect # ==================== --> 


<?php 
	
$query = Capsule::table('tblclients')->select('firstname');
$users = $query->addSelect('lastname as AddLastname')->where('id','5')->get();
// 	echo "<pre>";
// print_r($users);

	
?>

<!-- =================== # Joins # ============================ -->

<?php 
	
	// GET ALL VALUE FORM TWO COLUMN(SIMPLE JOIN QUERY)..................
$users = Capsule::table('tblclients')
		->join('tblupgrades','tblclients.id','=','tblupgrades.userid')
		->select('tblclients.*','tblupgrades.userid')
		->get();
// 	echo "<pre>";
// print_r($users);
// 
// Not SELECT USERS.........................................................

		// ===================== ## Advanced Join Clauses ## ================

$users = Capsule::table('tblclients')
		  ->join('tblupgrades', function ($join) {
            $join->on('tblclients.id', '=', 'tblupgrades.userid')
                 ->where('tblclients.id', '=', 5);
        }) ->get();

// 		  echo "<pre>";
// print_r($users);



// TWO TABLE JOIN QUERY( SELECT ).............................

$users = Capsule::table('tblclients')
		  ->join('tblupgrades', function ($join) {
            $join->on('tblclients.id', '=', 'tblupgrades.userid')
                 ->where('tblclients.id', '=', 5);
        })->select('tblclients.*','tblupgrades.userid') ->get();

// 		  echo "<pre>";
// print_r($users);
// 
// MULTIPLE TABLE JOIN QUERY (SELECT)................

$users = Capsule::table('tblclients')
		  ->join('tblupgrades', function ($join) {
            $join->on('tblclients.id', '=', 'tblupgrades.userid')
                 ->where('tblclients.id', '=', 5);
        })->join('tblticketreplies', function ($join) {
            $join->on('tblclients.id', '=', 'tblticketreplies.userid')
                 ->where('tblclients.id', '=', 5);
        })->select('tblclients.firstname','tblclients.lastname','tblupgrades.userid','tblticketreplies.message') ->get();

// 		  echo "<pre>";
// print_r($users);

// foreach ($users as$value) {
// 	echo $value->firstname." ----------------------- ".$value->message;
// }
// 
// 


?>


 <!-- ============================== ## Aggregates ## ============================ -->

 <?php 
	
// // $users = Capsule::table('tblclients')->count();
// $users = Capsule::table('tblclients')->max('id');
// 		echo $users;
	
?>
 <!-- ================================== ## Unions ## ================================= -->

<?php 
	// N:B: Not working.............
	

// 	$first = Capsule::table('tblclients')
//             ->whereNull('firstname');

// $users = Capsule::table('tblclients')
//             ->whereNull('lastname')
//             ->union($first)
//             ->get();
//               echo "<pre>";
// print_r($users);
?>

<!-- =============================== ## Where Clauses ## ================================ --> 


<?php 
		// $users = Capsule::table('tblclients')->where('id', '=', 5)->get(); // OR
		$users = Capsule::table('tblclients')->where('id', 5)->get();
		  echo "<pre>";
// print_r($users); 
// 

// ---------------------------- ou may also pass an array of conditions to the where function: --- 

// ================ (AND Statement)===============
$users = Capsule::table('tblclients')->select('firstname','lastname','state')->where([
	    ['id', '=', '5'],
	    ['firstname', '=', 'Rakibur'],
])->get(); 
//   echo "<pre>";
// print_r($users); 	

// foreach ($users as $user) {
// 	echo $user->firstname."-- ".$user->lastname." --- ".$user->state;
// }

// =============== (OR Statement)=======================

$users = Capsule::table('tblclients')
		->where('id', '=', 5)
        ->orWhere('firstname', 'Rakibur')
        ->select('firstname','lastname','state')
        ->get(); 
//   echo "<pre>";
// print_r($users); 	

// foreach ($users as $user) {
// 	echo $user->firstname."-- ".$user->lastname." --- ".$user->state;
// }


 // ======================= #Additional Where Clauses# ================  
 

 // --------------- whereBetween / orWhereBetween -------------
 // N:B: between work like as LiMIT
 $users = Capsule::table('tblclients')->whereBetween('id', [1, 9])->get(); // OR

 $users = Capsule::table('tblclients')->select('firstname','lastname','state')->whereBetween('id', [1, 9])->get(); 

//    echo "<pre>";
// print_r($users);  

//--------------------- whereNotBetween / orWhereNotBetween ---------- 
// That's means take all datas without 1 to 9 datas
 $users = Capsule::table('tblclients')->select('id','firstname','lastname','state')->whereNotBetween('id', [1, 9])->get(); 

//  echo "<pre>";
// print_r($users);  

// --------------------- whereIn / whereNotIn / orWhereIn / orWhereNotIn--------------
//N:b : take data within 1,5,9 of id
 $users = Capsule::table('tblclients')->select('id','firstname','lastname','state')->whereIn('id', [1, 5,9])->get(); 


//  echo "<pre>";
// print_r($users);  
// ........................ whereNotIn .................
// print all data from this table without 1,5,9 id's data
 $users = Capsule::table('tblclients')->select('id','firstname','lastname','state')->whereNotIn('id', [1, 5,9])->get(); 


//  echo "<pre>";
// print_r($users);  


//N:B: Problem
//
// -------------------------- # whereColumn / orWhereColumn #-----------
// The whereColumn method may be used to verify that two columns are equal:
$users = Capsule::table('tblclients')->whereColumn('companyname','lastname')->get(); 


//  echo "<pre>";
// print_r($users); 

?>
<!-- =============================== # Parameter Grouping # ======================= -->

<!-- query = "SELECT * FROM `tblclients`WHERE firstname ='Rakibur' AND (taxexempt >'2' OR email ='rokib91@gmail.com')    "; --> 
<!-- select * from users where name = 'John' and (votes > 100 or title = 'Admin') --> 

<?php 
	$users = Capsule::table('tblclients')
			->where('firstname', '=', 'Rakibur')
            ->where(function ($query) {
                $query->where('taxexempt', '>', 2)
                      ->orWhere('email', '=', 'rokib91@gmail.com');
            })
            ->get(); 

//             echo "<pre>";
// print_r($users); 
?>

<!-- =========================== #Ordering, Grouping, Limit, & Offset# ============ --> 
<?php 
// ....................... # orderBy #...................................
	$users = Capsule::table('tblclients')
			->orderBy('id', 'desc')
            ->get();

//             echo "<pre>";
// print_r($users); 
?>

<?php 
// ....................... # orderBy #...................................
	$users = Capsule::table('tblclients')
			->oldest()
              ->first();

            echo "<pre>";
// print_r($users); 

// echo $users->firstname;
?>

<?php 
// ....................... # inRandomOrder #...................................
	$users = Capsule::table('tblclients')
			->inRandomOrder()
              ->first();

//             echo "<pre>";
// print_r($users); 

// echo $users->firstname;
?>


<?php 
// ....................... # groupBy / having #...................................
	$users = Capsule::table('tblpricing')
			->groupBy('msetupfee')
            ->having('msetupfee', '>', 10)
            ->get();
//             echo "<pre>";
// print_r($users); 
// 
// -------------------- Multioe Grout ......................... 

$users = Capsule::table('tblpricing')
			->groupBy('msetupfee','annually')
            ->having('msetupfee', '>', 10)
            ->get();
//             echo "<pre>";
// print_r($users); 

// -------------------- Select Column  ......................... 

$users = Capsule::table('tblpricing')
			->select('type','msetupfee')
			->groupBy('msetupfee')
            ->having('msetupfee', '>', 10)
            ->get();
//             echo "<pre>";
// print_r($users); 

?>




	
</body>
</html>
