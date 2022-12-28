<?php $user = getUser($db, $_SESSION['user']['id']); ?>
<div class="col-lg-12">
	<form class="form-white" method="post">
		<div class="row">
			<div class="col">
				<h1 class="m-0">PROFILE</h1>
			</div>
			<div class="col">
				<div class="h-100 d-block d-sm-flex justify-content-end align-items-center">
					<div class="d-flex">
						<button type="submit" class="btn btn-success">SAVE</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col">
				<div class="form-group mb-3">
					<label class="text-field__label mb-2">Name</label><br>
					<input name="username" class="bg-dark text-white form-control border-0" value="<?php echo htmlspecialchars($user['username']); ?>" required autofocus>
				</div>
				<div class="form-group mb-3">
					<label class="text-field__label mb-2">Email</label><br>
					<input type="email" name="email" class="bg-dark text-white form-control border-0" value="<?php echo htmlspecialchars($user['email']); ?>" required>
				</div>
				<div class="form-group mb-3">
					<label class="text-field__label mb-2">Phone</label><br>
					<input name="phone" class="bg-dark text-white form-control border-0" value="<?php echo htmlspecialchars($user['phone']); ?>">
				</div>
				<div class="form-group mb-3">
					<label class="text-field__label mb-2">Password</label><br>
					<input type="password" name="password" class="bg-dark text-white form-control border-0">
				</div>
			</div>
		</div>
		<input name="action" type="hidden" value="save_profile">
	</form>
</div>
