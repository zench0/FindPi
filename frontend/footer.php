				<footer class="footer">
					<div class="w-100 clearfix">
						<span class="text-muted d-block text-center text-sm-left d-sm-inline-block"><?php echo date('Y'); ?></span>
					</div>
				</footer>
			</div>
		</div>
	</div>

	<script src="/frontend/vendors/js/vendor.bundle.base.js"></script>
	<script src="/frontend/vendors/chart.js/Chart.min.js"></script>
	<script src="/frontend/js/off-canvas.js"></script>
	<script src="/frontend/js/hoverable-collapse.js"></script>
	<script src="/frontend/js/template.js"></script>
	<script src="/frontend/js/settings.js"></script>
	<script src="/frontend/js/todolist.js"></script>
	<script src="/frontend/js/dashboard.js"></script>
	<script src="/frontend/js/todolist.js"></script>

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
