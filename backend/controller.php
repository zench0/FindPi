<?php

	session_name('FINDPI');
	session_start();

	if (isset($_POST['action'])) {
		switch ($_POST['action']) {
			# Message
			case 'send_message':
				$_POST['uri'] = $_GET['path'];
				sendMessage($db, $_POST);
			break;

			# Friends
			case 'request_friend':
				requestFriend($db, $_POST);
			break;
			case 'add_friend':
				addFriend($db, $_POST);
			break;
			case 'delete_friend':
				deleteFriend($db, $_POST);
			break;
			
			# Posts
			case 'add_post':
				addPost($db, $_POST);
			break;
			case 'response_post':
				responsePost($db, $_POST);
			break;
			case 'delete_post':
				deletePost($db, $_POST);
			break;

			# Users
			case 'login':
				userLogin($db, $_POST);
			break;
			case 'register':
				userRegister($db, $_POST);
			break;

			# Profile
			case 'save_profile':
				saveProfile($db, $_POST);
			break;
		}
	}

?>