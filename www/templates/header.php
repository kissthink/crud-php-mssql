<header>
    <div class="navbar">
  		<div class="navbar-inner">
    	<ul class="nav">
    	  <li data-ref="create.php"><a href="create.php">Create</a></li>
    	  <li data-ref="read.php"><a href="read.php">Read</a></li>
    	  <li data-ref="update.php"><a href="update.php">Update</a></li>
    	  <li data-ref="remove.php"><a href="remove.php">Remove</a></li>
    	</ul>
  	</div>
</div>


<?php 
	if(isset($_POST['success'])) {
		echo "<div class='alert alert-success'><a class='close' data-dismiss='alert' href='#'>&times;</a>{$_POST['success']}</div>";
		unset($_POST['success']);
	}
?>
</header>