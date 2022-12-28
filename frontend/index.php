<?php validateUser(); $posts = getPosts($db); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Профиль | FindPi</title>
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
								<div class="col-12 col-xl-5 mb-4 mb-xl-0">
									<h3 class="font-weight-bold">Профиль</h3>
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
												<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left">
													<div class="d-flex flex-column">
														<img src="/frontend/images/faces/face0.jpg" class="w-100 rounded" alt="profile image"/>
														<a href="/settings/" class="btn btn-sm btn-warning mt-2">Редактировать<br>профиль</a>
													</div>
													<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
														<h4 class="mb-2 text-warning font-weight-bold"><?php echo $_SESSION['user']['username'].' '.$_SESSION['user']['userlastname']; ?></h4>
														<p class="mb-0"><?php echo $_SESSION['user']['description']; ?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8 offset-lg-2 grid-margin stretch-card">
										<div class="card">
											<div class="card-body text-white bg-dark">
												<form action="" method="post">
													<div class="form-group">
														<textarea name="content" class="form-control" rows="5" placeholder="Введите текст..." required></textarea>
													</div>
													<div class="text-right">
														<button type="submit" class="btn btn-warning">Отправить</button>
													</div>
													<input type="hidden" name="action" value="add_post">
												</form>
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
														<button type="submit" name="id" value="<?php echo $post['id']; ?>" class="btn btn-warning">Удалить</button>
														<input type="hidden" name="action" value="delete_post">
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