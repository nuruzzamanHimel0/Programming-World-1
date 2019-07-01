<?php 

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
?>
