<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php

  $logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
  
  if($_GET['clear'] == 'true') {
		file_put_contents($logfile, '');
	  // Add the first log entry
	  log_action('Logs Cleared', "by User ID {$session->user_id}");

    redirect_to('logfile.php');
  }
?>

<?php include_layout_template('admin_header.php'); ?>
<div id="menu-container" class="container">
<a href="index.php">&laquo; Back</a><br />
<br />

<h2>Log File</h2>

<p><a href="logfile.php?clear=true">Clear log file</a><p>
<table class="table">
<thead>
  <tr>
    <th>Action</th>
  </tr>
</thead>
<tbody>
<?php

  if( file_exists($logfile) && is_readable($logfile) && 
			$handle = fopen($logfile, 'r')) {  // read
    
		while(!feof($handle)) {
			$entry = fgets($handle);
			if(trim($entry) != "") {
        echo "<tr >";
				echo "<td>{$entry}</td>";
        echo "</tr>";
			}
		}
		
    fclose($handle);
  } else {
    echo "Could not read from {$logfile}.";
  }
?>
</tbody>
</table>
<?php include_layout_template('admin_footer.php'); ?>
