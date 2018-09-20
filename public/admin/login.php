<?php
require_once("../../includes/initialize.php");

if($session->is_logged_in()) {
  redirect_to("index.php");
}


if (isset($_POST['submit'])) { // Form has been submitted.

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  
  // Check database to see if username/password exist.
	$found_user = User::authenticate($username, $password);
	
  if ($found_user) {
    $session->login($found_user);
		log_action('Login', "{$found_user->username} logged in.");
    redirect_to("index.php");
  } else {
    // username/password combo was not found in the database
    $message = "Username/password combination incorrect.";
  }
  
} else { // Form has not been submitted.
  $username = "";
  $password = "";
}

?>
<?php include_layout_template('admin_header.php'); ?>

<div id="menu-container" class="container">
    <div class="row">
    	<div  class="col-lg-12">
            <h1 id="header" class="page-header">Staff Login</h1>
            <?php echo output_message($message); ?>
        </div>
    <div class="row">
		<div class="col-md-6" id="comment-form">
        <form action="login.php" method="post">
		  <table>
		    <tr>
		      <td>Username:</td>
		      <td>
		        <input class="form-control" type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td>Password:</td>
		      <td>
		        <input class="form-control" type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td colspan="2">
		        <input class="btn btn-primary" type="submit" name="submit" value="Login" />
		      </td>
		    </tr>
		  </table>
		</form>
		</div>
	</div>
		
	</div>
</div>


		



<?php include_layout_template('admin_footer.php'); ?>
