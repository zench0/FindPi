<?php

	$uri = [];
	if (isset($_GET['path'])) $uri = explode('/', $_GET['path']);

	switch ($uri[0]) {
		case '':
			if (file_exists($_SERVER['DOCUMENT_ROOT'].'/frontend/index.php')) {
				ob_start();
				include $_SERVER['DOCUMENT_ROOT'].'/frontend/index.php';
				echo renderTemplate($db, ob_get_clean());
			}
		break;
		case 'account':
			$side = 'account';
			switch ($uri[1]) {
				case 'profile':
					$controller = 'account.'.$uri[1];
					if (isset($uri[2])) $action = 'account.'.$uri[2]; else $action = '';
					include $_SERVER['DOCUMENT_ROOT'].'/backend/account.php';
				break;
				default:
					header('Location: /');
				break;
			}
		break;
		case 'auth':
			ob_start();
			include $_SERVER['DOCUMENT_ROOT'].'/backend/auth.php';
			echo renderTemplate($db, ob_get_clean());
		break;
		case 'registration':
			ob_start();
			include $_SERVER['DOCUMENT_ROOT'].'/backend/registration.php';
			echo renderTemplate($db, ob_get_clean());
		break;
		case 'logout':
			userLogout();
		break;
		default:
			ob_start();
			if (file_exists($_SERVER['DOCUMENT_ROOT'].'/frontend/'.$uri[0].'.php')) {
				include $_SERVER['DOCUMENT_ROOT'].'/frontend/'.$uri[0].'.php';
				echo renderTemplate($db, ob_get_clean());
			} else {
				include $_SERVER['DOCUMENT_ROOT'].'/frontend/404.php';
				echo renderTemplate($db, ob_get_clean());
			}
		break;
	}

?>