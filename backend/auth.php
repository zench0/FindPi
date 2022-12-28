<?php validateLogin(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Авторизация | FindPi</title>
	{{INC:head}}
</head>
<body>

	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="main-panel">
				<div class="content-wrapper d-flex align-items-center auth px-0">
					<div class="row w-100 mx-0">
						<div class="col-lg-4 mx-auto">
							<div class="bg-dark text-white shadow text-left pb-5 pt-1 px-4 px-sm-5">
								<h1 class="mt-5 text-center"><img src="/frontend/images/favicon.png" alt="" height="50"> FindPi</h1>
								<h3 class="mt-5 text-center">Авторизация</h3>
								<form action="" method="post">
									<div class="form-group">
										<label>Логин</label>
										<input type="text" name="login" class="form-control mt-2 bg-white" required>
									</div>
									<div class="form-group">
										<label>Пароль</label>
										<input type="password" name="password" class="form-control mt-2 bg-white" required>
									</div>
									<div class="form-group mt-4 text-center">
										<button class="btn btn-warning px-5">Войти</button>
									</div>
									<input type="hidden" name="action" value="login">
								</form>
								<div class="text-center mt-4 font-weight-light">
									<a href="/registration/" class="text-white">Регистрация</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
		if (isset($_SESSION['error'])) {
			echo '
				<script>
					setTimeout(function() {
						alert("'.$_SESSION['error'].'");
					}, 300);
					$.ajax({
						type: "POST",
						url: "/backend/ajax.php",
						data: "action=release_error",
					});
				</script>
			';
		}
	?>

</body>
</html>