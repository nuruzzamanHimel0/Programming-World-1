<?php 
	multidimention array print EXAMPLE.................................
	
	  $sentc_voice_array = array(

            $Lan['English US'] => array(
                $Lan['Kate']."_key" => $Lan['Kate'],
                $Lan['Susan']."_key" => $Lan['Susan'],
                $Lan['Julie']."_key" => $Lan['Julie'],
                $Lan['Dave']."_key" => $Lan['Dave'],
                $Lan['Paul']."_key" => $Lan['Paul']
            ),
             "namee arraere" => array(
                $Lan['Kate']."_key" => $Lan['Kate'],
                $Lan['Susan']."_key" => $Lan['Susan'],
                $Lan['Julie']."_key" => $Lan['Julie'],
                $Lan['Dave']."_key" => $Lan['Dave'],
                $Lan['Paul']."_key" => $Lan['Paul']
            )
        );

        echo "<pre>";
        print_r($sentc_voice_array);

        foreach ($sentc_voice_array as $key => $value) {
            echo $key." ------ ".$value."<br>";

            foreach ($value as $key => $value) {
                echo $key." ------ ".$value."<br>";
            }
        }


        exit();
		
		OUTPUT:
		
		English US ------ Array
Kate_key ------ Kate
Susan_key ------ Susan
Julie_key ------ Julie
Dave_key ------ Dave
Paul_key ------ Paul
namee arraere ------ Array
Kate_key ------ Kate
Susan_key ------ Susan
Julie_key ------ Julie
Dave_key ------ Dave
Paul_key ------ Paul
?>

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

	echo "<pre>";

	print_r($mark1['keyword2'][1]);

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

$str = "I only want this number, {256dd} to be in my string!  {25ddddd}"; 
preg_match_all("/{(.*)}/U", $str, $matches); 
echo $matches[1][0]."-";
echo $matches[1][1];

echo "<br><br><br><h1>FIND %P portion from the string For Message send ..................................................................................................</h1><br>";

// $imgString = "%p10 abcd";
$imgString = "  abc %p10 ";

echo "total string length = ".$strlength = strlen($imgString)."<br>";
echo "%p postiton found = ".$picPostion = strpos($imgString,"%p");
echo "<br>";

$str_array = [];
if($picPostion  > 3)
{
	$pic = substr($imgString,$picPostion);
	echo "Get Full %p after strubg =".$pic."<br>";
	$message = trim(str_replace($pic, " ", $imgString));
	echo "Message =".$message;
	
}
else{
	
	$pic_right_space = strrpos($imgString, ' ');

	$pic = substr($imgString,$picPostion,$pic_right_space);

	echo "Only picture = ".$pic."<br>";

	$message = trim(substr($imgString,$pic_right_space));
	echo "Message =".$message;
	// echo strrpos($imgString, ' ');
}

echo "<br><br><br><h1>%s , %r and %botcity%..................................................................................................</h1><br>";

echo " <br><br> <h3> FOR %S........................... </h3><br>";

$string1 = "Its %s just accept my cam invite";
$s = "http://datingreg.live/sara ";
// echo preg_match('/\bs\b/', $string1);

if(strpos($string1, '%s' ) !== false)
{
	// echo "found";
	echo str_replace("%s",$s,$string1);
}





// echo strpos($imgString,'%p');

// if( strpos($imgString,'%p') == 0)
// {
// 	echo "%p have fist postiton";
// }
// else{
// 	echo "Not found";
// }






// PROJECT WORK PRACTICE...................................................

echo "<br><br><h1>Existing Project string to array conversion..................................................................................................</h1><br>";
	?>
Rule:
1) Divide Keyword and responce using strstr() function.
2) Using preg_match_all() Function find Bracket [] under value(exp: abc|dfd|dfdf df ) in multi dimention arrya..AND to use this bracket under value multidimention arry must be count

3) Basis of Looping replace white space to ^ into under bracket value.

4) then each under bracket value replace into ^ (exm: aa|b^c )  And finally Full respance under bracket value is replaced by ^ ex:aaa [bbb|ccc^e] ddd eee [fff|ggg|www] [fff|ggg|www|1223] hhh [bbb|ccc^e]
5)Then String to arry convert using explode(' ',$responce) function
6)Then create loop and if find [] then take value form [ braket] and explode("|",$array) and insert this arry in to same keyword



<?php

	echo " Keyword and resoinse.................... <br>";

	$string = "keyword1|aaa {bbb|ccc e|dfdf dfdf} ddd eee {fff|ggg|www} {fff|ggg|www|1223} hhh {bbb|ccc e|ddddd df}";
	// $string = "keyword1|guess i'm just looking for [someone|some1|some one] to [chill|hang] with... i'm not a [ho|hoe|slut] but just [lookin|looking] for [some|sum] fun lol";

	// $string = "keyword 2|[aaa|bbb|ccc] ddd [fff|ggg]";

//1) Divide Keyword and responce using strstr() function.
	//keyy
	$keyword = strstr($string,'|',true);
	echo $keyword."<br>";
	//responce....
	$responsePos = strpos($string,'|');
	$response = substr($string,$responsePos+1);
	echo $response."<br>";

//2) Using preg_match_all() Function find Bracket [] under value(exp: abc|dfd|dfdf df ) in multi dimention arrya..AND to use this bracket under value multidimention arry must be count
	preg_match_all("/{(.*)}/U", $response, $RESLT); 
	echo "consol check:".$RESLT[1][0]."-";
echo $RESLT[1][1]."-";
echo $RESLT[1][2];

// COunt multi dimention array
$typeTotals = array_map("count", $RESLT);
$totalTickets = array_sum($typeTotals);

echo "<br> Count:".$totalTickets."<br>";
$loop = $totalTickets/2;
echo "Multi Dimention loop count: ".$loop."<br>";

for ($i=0; $i < $loop ; $i++) { 
	// get multidimention array
	$optiionReal = $RESLT[1][$i];
	echo $optiionReal."<br>";
	// 3) Basis of Looping replace white space to ^ into under bracket value.
	$underScoreReplace = str_replace(" ","^",$optiionReal);
	echo $underScoreReplace."<br><br>";
	// 4) then each under bracket value replace into ^ (exm: aa|b^c )  And finally Full respance under bracket value is replaced by ^ ex:aaa [bbb|ccc^e] ddd eee [fff|ggg|www] [fff|ggg|www|1223] hhh [bbb|ccc^e]
	$response = str_replace($optiionReal,$underScoreReplace,$response);
	// echo $underScoreReplace."<br>";
}

echo "Finel responce: ".$response;



	if(preg_match_all("/{(.*)}/U", $response, $matches))
	{

		// 5)Then String to arry convert using explode(' ',$responce) function
		$strToarray = explode(' ',$response);
		echo "<pre>";
		print_r($strToarray);
		echo "<br>";

		foreach ($strToarray as $key => $value) {
			if(preg_match_all("/{(.*)}/U", $value, $matches))
			{
				// echo "Bracket exist <br>";
				preg_match_all("/{(.*)}/U", $value, $matches);
				echo $strToarray1 = $matches[1][0];
				// 6)Then create loop and if find [] then take value form [ braket] and explode("|",$array) and insert this arry in to same keyword
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