<?php

	# --- --- --- --- POSTS --- --- --- --- #

	function getPosts($db) {
		$query = $db->query('SELECT * FROM posts WHERE user_id="'.$_SESSION['user']['id'].'" ORDER BY id DESC');
		$posts = false;
		if ($query->num_rows > 0) {
			$posts = array();
			while ($row = $query->fetch_assoc()) {
				$posts[] = $row;
			}
		}
		return $posts;
	}

	function getUserPosts($db, $user_id) {
		$query = $db->query('SELECT * FROM posts WHERE user_id="'.$user_id.'" ORDER BY id DESC');
		$posts = false;
		if ($query->num_rows > 0) {
			$posts = array();
			while ($row = $query->fetch_assoc()) {
				$posts[] = $row;
			}
		}
		return $posts;
	}

	function addPost($db, $post) {
		$content = $db->real_escape_string($post['content']);
		if (empty($content)) {
			$_SESSION['error'] = 'Напишите текст.';
		} else {
			$db->query('INSERT INTO posts SET user_id="'.$_SESSION['user']['id'].'", posted_date="'.date('Y-m-d H:i:s').'", content="'.$content.'"');
		}
		header('Location: /');
	}

	function deletePost($db, $post) {
		$id = $db->real_escape_string($post['id']);
		$db->query('DELETE FROM posts WHERE user_id="'.$_SESSION['user']['id'].'" AND id="'.$id.'"');
		header('Location: /');
	}

	# --- --- --- --- MESSAGES --- --- --- --- #

	function getMessages($db) {
		$query = $db->query('SELECT u.id, u.username, u.userlastname, m.content FROM messages m, users u WHERE m.to_user="'.$_SESSION['user']['id'].'" AND u.id=m.from_user ORDER BY id DESC');
		$messages = false;
		if ($query->num_rows > 0) {
			$messages = array();
			while ($row = $query->fetch_assoc()) {
				$messages[] = $row;
			}
		}
		return $messages;
	}

	function sendMessage($db, $post) {
		$content = $db->real_escape_string($post['content']);
		$uri = explode('/', $post['uri']);
		$uri = (int) $uri[1];
		if ($uri > 0) {
			$db->query('INSERT INTO messages SET from_user="'.$_SESSION['user']['id'].'", to_user='.$uri.', content="'.$content.'", send_date="'.date('Y-m-d H:i:s').'"');
			$_SESSION['error'] = 'Сообщение отправлено.';
		}
		header('Location: /'.$post['uri']);
	}

	# --- --- --- --- RESPONSES --- --- --- --- #

	function getResponses($db) {
		$query = $db->query('SELECT u.id, u.username, u.userlastname, p.content FROM responses r, users u, posts p WHERE r.owner_id="'.$_SESSION['user']['id'].'" AND u.id=r.user_id AND p.id=r.post_id ORDER BY id DESC');
		$responses = false;
		if ($query->num_rows > 0) {
			$responses = array();
			while ($row = $query->fetch_assoc()) {
				$responses[] = $row;
			}
		}
		return $responses;
	}

	function responsePost($db, $post) {
		$id = $db->real_escape_string($post['id']);
		$db->query('INSERT INTO responses SET user_id="'.$_SESSION['user']['id'].'", owner_id=(SELECT user_id FROM posts WHERE id="'.$id.'"), post_id="'.$id.'", response_date="'.date('Y-m-d H:i:s').'"');
		$_SESSION['error'] = 'Отклик на пост отправлен пользователю.';
		header('Location: /');
	}

	# --- --- --- --- FRIENDS --- --- --- --- #

	function getFriends($db) {
		$query = $db->query('SELECT friends FROM users WHERE id="'.$_SESSION['user']['id'].'"');
		$friends = false;
		if ($query->num_rows > 0) {
			$row = $query->fetch_assoc();
			$query = $db->query('SELECT * FROM users WHERE id IN ('.$row['friends'].')');
			if ($query->num_rows > 0) {
				$friends = array();
				while ($row = $query->fetch_assoc()) {
					$friends[] = $row;
				}
			}
		}
		return $friends;
	}

	function getFriendStatus($db, $user_id) {
		$status = 'is_not_friend';
		$query = $db->query('SELECT * FROM friends_requests WHERE from_user="'.$_SESSION['user']['id'].'" AND to_user="'.$user_id.'"');
		if ($query->num_rows > 0) {
			$status = 'requested_from';
		}
		$query = $db->query('SELECT * FROM friends_requests WHERE to_user="'.$_SESSION['user']['id'].'" AND from_user="'.$user_id.'"');
		if ($query->num_rows > 0) {
			$status = 'requested_to';
		}
		$query = $db->query('SELECT friends FROM users WHERE id="'.$_SESSION['user']['id'].'"');
		if ($query->num_rows > 0) {
			$friends = $query->fetch_assoc();
			$friends = explode(',', $friends['friends']);
			if (in_array($user_id, $friends)) {
				$status = 'is_friend';
			}
		}
		return $status;
	}

	function requestFriend($db, $post) {
		$id = $db->real_escape_string($post['id']);
		$db->query('INSERT INTO friends_requests SET from_user="'.$_SESSION['user']['id'].'", to_user="'.$id.'", send_date="'.date('Y-m-d H:i:s').'"');
		$_SESSION['error'] = 'Запрос отправлен пользователю.';
		header('Location: /user/'.$id.'/');
	}

	function addFriend($db, $post) {
		$id = $db->real_escape_string($post['id']);
		$query = $db->query('SELECT * FROM friends_requests WHERE to_user="'.$_SESSION['user']['id'].'" AND from_user="'.$id.'"');
		if ($query->num_rows > 0) {
			$query = $db->query('SELECT friends FROM users WHERE id="'.$_SESSION['user']['id'].'"');
			if ($query->num_rows > 0) {
				$friends = $query->fetch_assoc();
				if (!empty($friends['friends'])) {
					$friends = explode(',', $friends['friends']);
				} else {
					$friends = array();
				}
				$friends[] = $id;
				$friends = implode(',', $friends);
				$db->query('UPDATE users SET friends="'.$friends.'" WHERE id="'.$_SESSION['user']['id'].'"');
			}
			$query = $db->query('SELECT friends FROM users WHERE id="'.$id.'"');
			if ($query->num_rows > 0) {
				$friends = $query->fetch_assoc();
				if (!empty($friends['friends'])) {
					$friends = explode(',', $friends['friends']);
				} else {
					$friends = array();
				}
				$friends[] = $_SESSION['user']['id'];
				$friends = implode(',', $friends);
				$db->query('UPDATE users SET friends="'.$friends.'" WHERE id="'.$id.'"');
				$db->query('DELETE FROM friends_requests WHERE to_user="'.$_SESSION['user']['id'].'" AND from_user="'.$id.'"');
			}
		}
		header('Location: /user/'.$id.'/');
	}

	function deleteFriend($db, $post) {
		$id = $db->real_escape_string($post['id']);
		$query = $db->query('SELECT friends FROM users WHERE id="'.$_SESSION['user']['id'].'"');
		if ($query->num_rows > 0) {
			$row = $query->fetch_assoc();
			if (!empty($row['friends'])) {
				$row = explode(',', $friends['friends']);
				$friends = array();
				foreach ($row as $value) {
					$friends[$value] = $value;
				}
			}
			unset($friends[$id]);
			$friends = implode(',', $friends);
			$db->query('UPDATE users SET friends="'.$friends.'" WHERE id="'.$_SESSION['user']['id'].'"');
		}
		$query = $db->query('SELECT friends FROM users WHERE id="'.$id.'"');
		if ($query->num_rows > 0) {
			$row = $query->fetch_assoc();
			if (!empty($row['friends'])) {
				$row = explode(',', $friends['friends']);
				$friends = array();
				foreach ($row as $value) {
					$friends[$value] = $value;
				}
			}
			unset($friends[$_SESSION['user']['id']]);
			$friends = implode(',', $friends);
			$db->query('UPDATE users SET friends="'.$friends.'" WHERE id="'.$id.'"');
		}
		header('Location: /friends/');
	}

	# --- --- --- --- USERS --- --- --- --- #

	function getUsers($db) {
		$query = $db->query('SELECT * FROM users ORDER BY id ASC');
		$users = false;
		if ($query->num_rows > 0) {
			$users = array();
			while ($row = $query->fetch_assoc()) {
				$users[] = $row;
			}
		}
		return $users;
	}

	function getUser($db, $id) {
		$query = $db->query('SELECT * FROM users WHERE id="'.$id.'"');
		$user = false;
		if ($query->num_rows > 0) {
			$user = $query->fetch_assoc();
		}
		return $user;
	}

	function saveProfile($db, $post) {
		$username = $db->real_escape_string($post['username']);
		$userlastname = $db->real_escape_string($post['userlastname']);
		$description = $db->real_escape_string($post['description']);
		$db->query('UPDATE users SET username="'.$username.'", userlastname="'.$userlastname.'", description="'.$description.'" WHERE id="'.$_SESSION['user']['id'].'"');
		$_SESSION['user']['username'] = $username;
		$_SESSION['user']['userlastname'] = $userlastname;
		$_SESSION['user']['description'] = $description;
		header('Location: /settings/');
	}

	# --- --- --- --- SYSTEM --- --- --- --- #

	function validateUser() {
		if (!isset($_SESSION['user'])) {
			header('Location: /auth/');
		}
	}

	function validateLogin() {
		if (isset($_SESSION['user'])) {
			header('Location: /account/');
		}
	}

	function isUser() {
		return isset($_SESSION['user']);
	}

	function userLogin($db, $post) {
		$login = $db->real_escape_string($post['login']);
		$password = hash('md5', $post['password']);
		$query = $db->query('SELECT * FROM users WHERE login="'.$login.'"');
		if ($query->num_rows > 0) {
			$query = $db->query('SELECT * FROM users WHERE login="'.$login.'" AND password="'.$password.'"');
			if ($query->num_rows > 0) {
				$_SESSION['user'] = $query->fetch_assoc();
				header('Location: /account/');
			} else {
				$_SESSION['error'] = 'Неправильный пароль.';
				header('Location: /auth/');
			}
		} else {
			$_SESSION['error'] = 'Пользователь не зарегистрирован.';
			header('Location: /auth/');
		}
	}

	function userRegister($db, $post) {
		$username = $db->real_escape_string($post['username']);
		$userlastname = $db->real_escape_string($post['userlastname']);
		$login = $db->real_escape_string($post['login']);
		$password = hash('md5', $post['password']);
		$password2 = hash('md5', $post['password2']);
		$error = false;
		if ($password !== $password2) {
			$error = true;
			$_SESSION['error'] = 'Пароли не совпадают.';
			header('Location: /registration/');
		}
		$query = $db->query('SELECT id FROM users WHERE login="'.$login.'"');
		if ($query->num_rows > 0) {
			$error = true;
			$_SESSION['error'] = 'Пользователь уже зарегистрирован.';
			header('Location: /registration/');
		}
		if (!$error) {
			$db->query('INSERT INTO users SET username="'.$username.'", userlastname="'.$userlastname.'", login="'.$login.'", password="'.$password.'", role="2"');
			$_SESSION['error'] = 'Вы успешно зарегистрировались, теперь можете войти.';
			header('Location: /auth/');
		}
	}

	function userLogout() {
		unset($_SESSION['user']);
		header('Location: /');
	}

	function includeTemplate($db, $template, $params = array()) {
		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/backend/includes/'.$template.'.php')) {
			include $_SERVER['DOCUMENT_ROOT'].'/backend/includes/'.$template.'.php';
		}
	}

	function renderAdminTitle($uri) {
		if (isset($uri[2]) && !empty($uri[2])) {
			$title = ucfirst(str_replace('-', ' ', $uri[2]));
		} elseif (isset($uri[1]) && !empty($uri[1])) {
			$title = ucfirst(str_replace('-', ' ', $uri[1]));
		} else {
			$title = ucfirst($uri[0]);
		}
		$title .= ' - Fractal Samples';
		return $title;
	}

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function renderTemplate($db, $contents, $item_id = 0) {
		preg_match_all("#\{{(.+?)}}#", $contents, $matches);
		if (isset($matches['1']['0'])) {
			foreach ($matches['1'] as $match) {
				$output = '';
				$matchitems = explode(':', $match);
				switch ($matchitems[0]) {
					case 'INC': # Include
						if (file_exists($_SERVER['DOCUMENT_ROOT'].'/frontend/'.$matchitems[1].'.php')) {
							ob_start();
							include $_SERVER['DOCUMENT_ROOT'].'/frontend/'.$matchitems[1].'.php';
							$output .= renderTemplate($db, ob_get_clean());
						}
					break;
				}
				$contents = str_replace($matches[0][0], $output, $contents);
				return renderTemplate($db, $contents, $item_id);
			}
		}
		return $contents;
	}

?>