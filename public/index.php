<?php require_once("../includes/initialize.php"); ?>
<?php

	//find the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// x records per page ($per_page)
	$per_page = 5;

	// total record count ($total_count)
	$total_count = Photograph::count_all();

	
	$pagination = new Pagination($page, $per_page, $total_count);

	$sql = "SELECT * FROM photographs ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()}";
	$photos = Photograph::find_by_sql($sql);

	
?>

<?php include_layout_template('header.php'); ?>
    <!-- Page Content -->
<div menu-container class="container">
    <div class="row">
    	<div  class="col-lg-12">
            <h1 id="header" class="page-header">Photo Gallery</h1>
        </div>
		<?php foreach($photos as $photo): ?>
		  <div id="thumbnail" class=" thumb">
				<a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
					<img class="img-responsive" src="<?php echo $photo->image_path(); ?>" width="250" />
				</a>
		    <p class="text-center"><?php echo $photo->caption; ?></p>
		  </div>
		<?php endforeach; ?>
		<hr>

		<div id="pagination" style="clear: both;">
		<?php
			if($pagination->total_pages() > 1) {
				
				if($pagination->has_previous_page()) { 
			    	echo "<a href=\"index.php?page=";
					echo $pagination->previous_page();
					echo "\">&laquo; Previous</a> "; 
		   		}

				for($i=1; $i <= $pagination->total_pages(); $i++) {
					if($i == $page) {
						echo " <span class=\"selected\">{$i}</span> ";
					} else {
						echo " <a href=\"index.php?page={$i}\">{$i}</a> "; 
					}
				}

				if($pagination->has_next_page()) { 
					echo " <a href=\"index.php?page=";
					echo $pagination->next_page();
					echo "\">Next &raquo;</a> "; 
		    	}
			}
		?>
		</div>

	</div>

</div>




<?php include_layout_template('footer.php'); ?>
