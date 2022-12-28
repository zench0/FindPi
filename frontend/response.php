<?php validateUser(); $responses = getResponses($db); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Отклики | FindPi</title>
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
									<h3 class="font-weight-bold">Отклики</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="container-fluid page-body-wrapper">
							<div class="main-panel">
								<div class="row">
									<?php
										if ($responses) {
											foreach ($responses as $response) {
									?>
									<div class="col-md-8 offset-lg-2 grid-margin stretch-card">
										<div class="card">
											<div class="card-body text-white bg-dark">
												<div class="d-sm-flex flex-row">
													<div class="d-flex flex-column">
														<img src="/frontend/images/faces/face0.jpg" class="rounded" alt="profile image"/>
														<a href="/message/<?php echo $response['id']; ?>/" class="btn btn-sm btn-warning mt-2">Написать сообщение</a>
													</div>
													<div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
														<h6 class="mb-0 text-warning font-weight-bold mb-2"><?php echo $response['username'].' '.$response['userlastname']; ?></h6>
														<p><?php echo $response['content']; ?></p>
													</div>
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