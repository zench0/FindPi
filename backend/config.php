<?php

	$dbhost = '127.0.0.1';
	$dbname = 'zencho';
	$dbuser = 'root';
	$dbpass = '';

	$err_level = error_reporting(0);
	$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	error_reporting($err_level);
	if ($db->affected_rows === 0) {
		$db->query('SET NAMES "utf8";');
		$db->query('SET CHARACTER SET "utf8";');
		$db->query('SET SESSION collation_connection = "utf8_general_ci";');
	}

?>