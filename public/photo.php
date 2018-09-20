<?php require_once("../includes/initialize.php"); ?>
<?php
  if(empty($_GET['id'])) {
    $session->message("No photograph ID was provided.");
    redirect_to('index.php');
  }
  
  $photo = Photograph::find_by_id($_GET['id']);
  if(!$photo) {
    $session->message("The photo could not be located.");
    redirect_to('index.php');
  }

	if(isset($_POST['submit'])) {
	  $author = trim($_POST['author']);
	  $body = trim($_POST['body']);
	
	  $new_comment = Comment::make($photo->id, $author, $body);
	  if($new_comment && $new_comment->save()) {

	    redirect_to("photo.php?id={$photo->id}");
	
		} else {
			// Failed
	    $message = "There was an error that prevented the comment from being saved.";
		}
	} else {
		$author = "";
		$body = "";
	}
	
	$comments = $photo->comments();
	
?>
<?php include_layout_template('header.php'); ?>

<div  class="col-lg-12">
    <h1 id="header" class="page-header"><?php echo $photo->caption; ?></h1>
</div>

<div id="photo">
  <img src="<?php echo $photo->image_path(); ?>" />
</div>

</div>
<div class="row">
	<div class="col-md-6" id="comment-form">
	  <h3>New Comment</h3>
	  <?php echo output_message($message); ?>
	  <form action="photo.php?id=<?php echo $photo->id; ?>" method="post">
	    <table>
	      <tr>
	        
	        <td><input class="form-control" placeholder="Your name:" type="text" name="author" value="<?php echo $author; ?>" /></td>
	      </tr>
	      <tr>
	        
	        <td><textarea class="form-control" placeholder="Your comment:" name="body" cols="40" rows="8"><?php echo $body; ?></textarea></td>
	      </tr>
	      <tr>
	        <td><input class="btn btn-primary" type="submit" name="submit" value="Submit Comment" /></td>
	      </tr>
	    </table>
	  </form>
	</div>
</div>

<?php foreach($comments as $comment): ?>
  <div id="comments-field" class="col-sm-6 col-lg-6">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="meta-info" style="font-size: 0.8em;">
	     		 <?php echo datetime_to_text($comment->created); ?>
	    	</div>
		    <div class="panel-body">
			    <strong><?php echo htmlentities($comment->author); ?></strong> wrote:
			</div>
		</div>
	    <div class="panel-body">
			<?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
		</div><!-- /panel-body -->
	</div>
  </div>
<?php endforeach; ?>


<?php include_layout_template('footer.php'); ?>
