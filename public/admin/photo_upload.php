<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	$max_file_size = 1048576;   // expressed in bytes
	                            //     10240 =  10 KB
	                            //    102400 = 100 KB
	                            //   1048576 =   1 MB
	                            //  10485760 =  10 MB

	if(isset($_POST['submit'])) {
		$photo = new Photograph();
		$photo->caption = $_POST['caption'];
		$photo->attach_file($_FILES['file_upload']);
		if($photo->save()) {
			// Success
      $session->message("Photograph uploaded successfully.");
			redirect_to('list_photos.php');
		} else {
			// Failure
      $message = join("<br />", $photo->errors);
		}
	}
	
?>

<?php include_layout_template('admin_header.php'); ?>

<div id="menu-container" class="container">

<a href="list_photos.php">&laquo; Back</a><br />
<br />


	<h2>Photo Upload</h2>

	<?php echo output_message($message); ?>
  <form action="photo_upload.php" enctype="multipart/form-data" method="POST">
  <div class="form-group"></div>
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
    <label class="btn btn-default btn-file">
    	<input type="file" name="file_upload" />
    </label>
    <input class="form-control" placeholder="Caption" type="text" name="caption" value="" />
    <input class="btn btn-primary" type="submit" name="submit" value="Upload" />
    </div>
  </form>
  
  </div>

<?php include_layout_template('admin_footer.php'); ?>
		
