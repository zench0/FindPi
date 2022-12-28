<?php

	include $_SERVER['DOCUMENT_ROOT'].'/backend/config.php';
	include $_SERVER['DOCUMENT_ROOT'].'/backend/functions.php';
	include $_SERVER['DOCUMENT_ROOT'].'/backend/controller.php';

	$action = $_POST['action'];
	$output = 'ok';

	switch ($action) {
		case 'release_error':
			unset($_SESSION['error']);
		break;
	}

	echo json_encode($output);

?>