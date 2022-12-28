<?php validateUser(); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo renderAdminTitle($uri); ?></title>
	{{INC:head}}
</head>
<body>
	<header>
		<div class="container">
			<a href="/account/" class="logo"><span></span></a>
			<div class="menu">
				<ul>
					<li class="item<?php if ($_GET['path'] == 'account/profile/') echo ' active'; ?>"><a href="/account/profile/"><span>PROFILE</span></a></li>
				</ul>
			</div>
			<div class="login">
				<a href="/logout/"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
				<a href="/"><i class="fa fa-search" aria-hidden="true"></i></a> 
			</div>
		</div>
	</header>
	<div class="container2">
		<div class="content">
			<?php
				switch ($controller) {
					case 'account.profile':
						includeTemplate($db, 'account.profile');
					break;
				}
			?>
		</div>
	</div>
</body>
</html>