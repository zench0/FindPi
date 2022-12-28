		<?php global $uri; ?>
		<div class="horizontal-menu">
			<nav class="navbar top-navbar col-lg-12 col-12 p-0 bg-dark">
				<div class="container">
					<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
						<a class="navbar-brand brand-logo" href="/"><img src="/frontend/images/favicon.png" alt="logo"> FindPi</a>
						<a class="navbar-brand brand-logo-mini" href="/"><img src="/frontend/images/favicon.png" alt="logo"></a>
					</div>
					<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
						<ul class="navbar-nav navbar-nav-right">
							<li class="nav-item nav-profile dropdown">
								<a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
									Привет, <?php echo $_SESSION['user']['username'];?>!
								</a>
								<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
									<a class="dropdown-item" href="/logout/">
										<i class="ti-power-off text-primary"></i>
										Выход
									</a>
								</div>
							</li>
						</ul>
						<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
							<span class="ti-menu"></span>
						</button>
					</div>
				</div>
			</nav>
			<nav class="bottom-navbar">
				<div class="container">
					<ul class="nav page-navigation">
						<li class="nav-item<?php if ($uri[0] == '') echo ' active'; ?>">
							<a class="nav-link" href="/">
								<i class="ti-home menu-icon text-warning"></i>
								<span class="menu-title">Профиль</span>
							</a>
						</li>
						<li class="nav-item<?php if ($uri[0] == 'response') echo ' active'; ?>">
							<a class="nav-link" href="/response/">
								<i class="ti-signal menu-icon text-warning"></i>
								<span class="menu-title">Отклики</span>
							</a>
						</li>
						<li class="nav-item<?php if ($uri[0] == 'messages') echo ' active'; ?>">
							<a class="nav-link" href="/messages/">
								<i class="ti-comment menu-icon text-warning"></i>
								<span class="menu-title">Сообщения</span>
							</a>
						</li>
						<li class="nav-item<?php if ($uri[0] == 'friends') echo ' active'; ?>">
							<a class="nav-link" href="/friends/">
								<i class="ti-user menu-icon text-warning"></i>
								<span class="menu-title">Друзья</span>
							</a>
						</li>
						<li class="nav-item<?php if ($uri[0] == 'settings') echo ' active'; ?>">
							<a class="nav-link" href="/settings/">
								<i class="ti-settings menu-icon text-warning"></i>
								<span class="menu-title">Настройки</span>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
