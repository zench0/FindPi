<?php
	validateUser();
	if (!$uri[1]) header('Location: /');
	$user = getUser($db, (int) $uri[1]);
	if (!$user) header('Location: /');
	if ($user['id'] == $_SESSION['user']['id']) header('Location: /');
	$posts = getUserPosts($db, $user['id']);
	$friend_status = getFriendStatus($db, $user['id']);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $user['username'].' '.$user['userlastname']; ?> | FindPi</title>
	{{INC:head}}
</head>
<body>
	<div class="container-scroller">
		{{INC:header}}
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="row">
						<div class="container-fluid page-body-wrapper">
							<div class="main-panel">
								<div class="row">
									<div class="col-md-8 offset-lg-2 grid-margin stretch-card">
										<div class="card">
											<div class="card-body text-white bg-dark">
												<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left">
													<div class="d-flex flex-column">
														<img src="/frontend/images/faces/face0.jpg" class="w-100 rounded" alt="profile image"/>
														<?php
															switch ($friend_status) {
																case 'is_not_friend':
																	echo '
																		<form action="" method="post">
																			<button type="submit" name="id" value="'.$user['id'].'" class="btn btn-sm btn-warning mt-2 w-100">Добавить в друзья</button>
																			<input type="hidden" name="action" value="request_friend">
																		</form>
																	';
																break;
																case 'requested_from':
																	echo '
																		<div class="btn btn-sm btn-secondary mt-2">Заявка отправлена</div>
																	';
																break;
																case 'requested_to':
																	echo '
																		<form action="" method="post">
																			<button type="submit" name="id" value="'.$user['id'].'" class="btn btn-sm btn-info mt-2 w-100">Принять заявку</button>
																			<input type="hidden" name="action" value="add_friend">
																		</form>
																	';
																break;
																case 'is_friend':
																	echo '
																		<div class="btn btn-sm btn-success mt-2">В друзьях</div>
																	';
																break;
															}
														?>
														<a href="/message/<?php echo $user['id']; ?>/" class="btn btn-sm btn-warning mt-2">Написать сообщение</a>
													</div>
													<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
														<h4 class="mb-2 text-warning font-weight-bold"><?php echo $user['username'].' '.$user['userlastname']; ?></h4>
														<p class="mb-0"><?php echo $user['description']; ?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<?php
										if ($posts) {
											foreach ($posts as $post) {
									?>
									<div class="col-md-8 offset-lg-2 grid-margin stretch-card">
										<div class="card">
											<div class="card-body text-white bg-dark">
												<p><?php echo $post['content']; ?></p>
												<div class="text-right">
													<form action="" method="post">
														<button type="submit" name="id" value="<?php echo $post['id']; ?>" class="btn btn-warning">Откликнуться</button>
														<input type="hidden" name="action" value="response_post">
													</form>
												</div>
											</div>
										</div>
									</div>
									<?php
											}
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				{{INC:footer}}

</body>
</html>