<?php 
	// This prints file full path and name
	echo "File:--- '" .__FILE__ . "'.\n <br>";
	// This prints file full path and name
	echo "File with dirname():--- '" . dirname(__FILE__ ). "'.\n <br>";
	// This prints file full path, without file name
	echo "Dir:------- '" . __DIR__ . "'.\n <br>";

	// This prints current line number on file
	echo "This is line number(__LINE__) :" . __LINE__ . ".\n <br>";


	//.................................
	// Really simple basic test function
	function test_function_magic_constant() {
		echo "This is from '" . __FUNCTION__ . "' function.\n <br>";
	}

	// Prints function and used namespace
	test_function_magic_constant();
	//.............................

	echo "<br> <br> <br> <br>";


	// class

	class TestMagicConstants{

		// Print Class name...........
		public function printClassName()
		{
			echo "Class name :--".__CLASS__."  <br>";
		}

		// Print Method name

		public function printMethodName()
		{
			echo "Method name is :--- ".__METHOD__." <br> ";
		}

		//print function name

		public function printFunction()
		{
			echo "Fucntion is:--  ".__FUNCTION__." <br> ";
		}

		// Prints namespace name (works only with PHP 5.3)
		public function printNamespace() {
			echo "Namespace name is '" . __NAMESPACE__ . "'.\n <br>";
		}
	}

	$test_magic_constants  = new TestMagicConstants();

	// This prints class name and used namespace
	$test_magic_constants->printClassName();

	// This prints method name and used namespace
	$test_magic_constants->printMethodName();

	// This prints function name inside class and used namespace
	// same as method name, but without class
	$test_magic_constants->printFunction();

	// This prints namespace name (works only with PHP 5.3)
	$test_magic_constants->printNamespace();


?>