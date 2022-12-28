<?php validateUser(); $user = getUser($db, $_SESSION['user']['id']); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Настройки | FindPi</title>
	{{INC:head}}
</head>
	<div class="container-scroller">
		{{INC:header}}
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="row">
						<div class="col-md-12 grid-margin">
							<div class="row">
								<div class="col-12 col-xl-5 mb-4 mb-xl-0">
									<h3 class="font-weight-bold">Настройки</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 offset-lg-3 grid-margin stretch-card">
							<div class="card position-relative bg-dark text-white">
								<div class="card-body">
									<form class="forms-sample" action="" method="post">
										<div class="form-group">
											<label>Имя</label>
											<input type="text" name="username" class="form-control mt-2" value="<?php echo $user['username']; ?>" required>
										</div>
										<div class="form-group">
											<label>Фамилия</label>
											<input type="text" name="userlastname" class="form-control mt-2" value="<?php echo $user['userlastname']; ?>" required>
										</div>
										<div class="form-group">
											<label>Описание</label>
											<textarea name="description" rows="7" class="form-control mt-2"><?php echo $user['description']; ?></textarea>
										</div>
										<div class="form-group mt-4 text-center">
											<button class="btn btn-warning px-5">Сохранить</button>
										</div>
										<input type="hidden" name="action" value="save_profile">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				{{INC:footer}}

</body>
</html>