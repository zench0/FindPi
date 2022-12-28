<?php validateUser(); $friends = getFriends($db); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Друзья | FindPi</title>
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
									<h3 class="font-weight-bold">Друзья</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="container-fluid page-body-wrapper">
							<div class="main-panel">
								<div class="row">
									<?php
										if ($friends) {
											foreach ($friends as $friend) {
									?>
									<a class="col-md-4 grid-margin stretch-card text-decoration-none" href="/user/<?php echo $friend['id']; ?>/">
										<div class="card">
											<div class="card-body text-white bg-dark">
												<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left">
													<div class="d-flex flex-column">
														<img src="/frontend/images/faces/face0.jpg" class="img-lg rounded" alt="profile image"/>
														<form action="" method="post">
															<button type="submit" name="id" value="<?php echo $friend['id']; ?>" class="btn btn-sm btn-warning mt-2 w-100">Удалить</button>
															<input type="hidden" name="action" value="delete_friend">
														</form>
													</div>
													<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
														<h6 class="mb-0 text-warning font-weight-bold mb-2"><?php echo $friend['username'].' '.$friend['userlastname']; ?></h6>
														<p class="mb-0"><?php echo $friend['description']; ?></p>
													</div>
												</div>
											</div>
										</div>
									</a>
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