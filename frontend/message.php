<?php
	validateUser();
	if (!$uri[1]) header('Location: /');
	if ($uri[1] == $_SESSION['user']['id']) header('Location: /');
	$user = getUser($db, $uri[1]);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Отправка сообщения | FindPi</title>
	{{INC:head}}
</head>
<body>
	<div class="container-scroller">
		{{INC:header}}
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="row">
						<div class="col-md-12 grid-margin">
							<div class="row">
								<div class="col-12 col-xl-12 mb-4 mb-xl-0">
									<h3 class="font-weight-bold">Сообщение для пользователя <?php echo $user['username'].' '.$user['userlastname']; ?></h3>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="container-fluid page-body-wrapper">
							<div class="main-panel">
								<div class="row">
									<div class="col-md-8 offset-lg-2 grid-margin stretch-card">
										<div class="card">
											<div class="card-body text-white bg-dark">
												<form action="" method="post">
													<div class="form-group">
														<textarea name="content" class="form-control" rows="10" placeholder="Введите текст..." required></textarea>
													</div>
													<div class="text-right">
														<button type="submit" class="btn btn-warning">Отправить</button>
													</div>
													<input type="hidden" name="action" value="send_message">
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				{{INC:footer}}

</body>
</html>