<?php

	ob_start();

	try {

		$con = new PDO("mysql:dbname=se;host=localhost", "root", "");
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

	}
	catch(PDOException $e) {

		echo "Connection falied: " . $e->getMessage();

	}

?>
