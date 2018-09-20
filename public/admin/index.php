<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php'); ?>

	<div id="menu-container" class="container">
		<div class="row">
			<div class="col-md-6">
				<?php echo output_message($message); ?>
				<ul class="list-goup">
					<li class="list-group-item active">Menu</li>
					<li><a class="list-group-item" href="list_photos.php">List Photos</a></li>
					<li><a class="list-group-item" href="logfile.php">View Log file</a></li>
					<li><a class="list-group-item" href="logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>

<?php include_layout_template('admin_footer.php'); ?>
		
