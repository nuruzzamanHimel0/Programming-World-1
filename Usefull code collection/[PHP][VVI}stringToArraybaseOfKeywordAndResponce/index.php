<?php 
	echo "<h1> How to Multi Dimention associative array print.......... </h1><br>";
	$marks = array( 
            "mohammad" => array (
               "physics" => 35,
               "maths" => 30,	
               "chemistry" => 39
            ),
            
            "qadir" => array (
               "physics" => 30,
               "maths" => 32,
               "chemistry" => 29
            ),
            
            "zara" => array (
               "physics" => 31,
               "maths" => 22,
               "chemistry" => 39
            )
         );
	foreach ($marks as $key => $value) {
		echo "\n","keyword:".$key." ". $value['physics'], "\t\t", $value['maths']."<br>";
	}


//  multi dymention array.................

	$array = Array ( 
        0 => Array ( "product_id" => 33 , "amount" => 1 ) ,
        1 => Array ( "product_id" => 34  , "amount" => 3 ) ,
        2 => Array ( "product_id" => 10  , "amount" => 1 ) );

//...................................................................................................................................................

echo "<h1> Print Multi dimention array, array show, keyword show, value show.......... </h1><br>";

	$mark1 = array(
		"keyword1" => array(0 => "com1",1 => array("ren1",'ren2'),2 => 'com2',3 => array("ren4",'ren5'),4 => 'com3'),
		"keyword2" => array(
			0 => "com12",
			1 => array("ren12",'ren22'),
			2 => 'com22',
			3 => array("ren42",'ren52'),
			4 => 'com32'
		)
	);

		echo "<pre>";
	print_r($mark1);

	echo "print array using keyword <br>";
	print_r($mark1['keyword2']) ;

	echo "value show == ". $mark1['keyword2'][0];

echo "<br><br><br> Full array print.............................. <br><br>";
	foreach ($mark1 as $key => $value) {
		echo "keyword = ".$key."<br>"; 
		
		for ($i=0; $i < count($value) ; $i++) { 
			// echo $i."<br>";
			
			if(is_array($value[$i]))
			{
				foreach ($value[$i] as $k => $v) {
					echo "&nbsp &nbsp".$k ."-".$v."<br>";
				}

			}
			else{
				echo $i ."-". $value[$i]."<br>";
			}
		}
	}

	//strack overflow..............................................................
	echo "<br><br><br><h1>strack overflow (Multi dimention arrya  push into empty array and ASSOCIATIVE AARRAY  ..............</h1><br>";;

	$arrProducts = array('111' => array('description' => 'product1',
                                    'inventory' => '222',
                                    'price' =>'9.2'),
                     '184' => array('description' => 'product2',
                                    'inventory' => '52',
                                    'price'=>'1.19'));

$arrProducts[] =  array('description' => 'product3', 'inventory' => '52','price'=>'1.19');

 foreach ($arrProducts as $key1 => $value1) {
            echo "[".$key1."]";}


            echo "<br><br>";
            echo "<br><br>";

            echo "Stap 1 <br>";
            $newarray = array();
            $pushArray1 = array(0 => "com1",1 => array("ren1",'ren2'),2 => 'com2',3 => array("ren4",'ren5'),4 => 'com3');
            $pushArray2 = array(0 => "com1",1 => array("ren1",'ren2'),2 => 'com2',3 => array("ren4",'ren5'),4 => 'com3');

            $newarray['keyword1'] =$pushArray1 ;
            $newarray['keyword2'] =$pushArray2 ;

            echo "<pre>";
            print_r($newarray);



	
	//strack overflow..............................................................
	echo "<br><br><br><h1>Rendom array and Print..................................................................................</h1><br>";

	echo " get random value form array <br>";
// the array
$arrX = array("Kay", "Joe","Susan", "Frank");
// get random index from array $arrX
$randIndex = array_rand($arrX);
// output the value for the random index
echo $arrX[$randIndex];

$randI = array_rand($arrX,2);
echo "<br><br>";
echo "random 1:: ".$arrX[$randI[0]]."<br>";
echo "random 2 ::".$arrX[$randI[1]]."<br>";


echo "<br><br><br><h1>string position FIND one way..................................................................................................</h1><br>";

$str = "ignore everything except this (text)";
$start  = strpos($str, '(');
$end    = strpos($str, ')', $start + 1); 
// echo $end;
$length = $end - $start;
$result = substr($str, $start + 1, $length - 1);
echo $result;


$text = 'ignore everything except this (text)';
preg_match('#\((.*?)\)#', $text, $match);
echo $match[1];

echo "<br><br><h1>string position FIND Second way and print..................................................................................................</h1><br>";

$str = "I only want this number, [256] to be in my string!  [25dd]"; 
preg_match_all("/\\[(.*?)\\]/", $str, $matches); 
echo $matches[1][0]."-";
echo $matches[1][1];



// PROJECT WORK PRACTICE...................................................

echo "<br><br><h1>Existing Project string to array conversion..................................................................................................</h1><br>";

	echo " Keyword and resoinse.................... <br>";

	$string = "keyword1|aaa [bbb|ccc] ddd eee [fff|ggg] hhh";
	// $string = "keyword 2|[aaa|bbb|ccc] ddd [fff|ggg]";

	$keyword = strstr($string,'|',true);
	echo $keyword."<br>";
	$responsePos = strpos($string,'|');
	$response = substr($string,$responsePos+1);
	echo $response."<br>";

	if(preg_match_all("/\\[(.*?)\\]/", $response, $matches))
	{
		$strToarray = explode(' ',$response);
		echo "<pre>";
		print_r($strToarray);
		echo "<br>";

		foreach ($strToarray as $key => $value) {
			if(preg_match_all("/\\[(.*?)\\]/", $value, $matches))
			{
				// echo "Bracket exist <br>";
				preg_match_all("/\\[(.*?)\\]/", $value, $matches);
				echo $strToarray1 = $matches[1][0];

				$strToarray1 = explode('|',$matches[1][0]);

				print_r($strToarray1);

				$strToarray[$key] = $strToarray1;

			}
		}
	}
	else{
		echo "there have not any {} so full stirng go to arrayt";
	}
	echo "Final array.............. <br>";
	echo "<pre>";
		print_r($strToarray);


// // BRACKET SEARCH........................................................................................................



?>