<?php require_once '../scripts/db_funcs.php' ?>
<?php 
  	$conn = db_connect();

	if(isset($_POST['remove'])) {
		$delete_query = 'delete from '.$_POST['table_select'].' where id = \''.$_POST['record_id'].'\';';
		odbc_exec($conn, $delete_query) or die ("Couldn't remove record from database: ".odbc_errormsg());
	}

	odbc_close ($conn);
  	echo "Redirecting...";
?>

<form action='/remove.php' method='post' name='frm'>
<?php
foreach ($_POST as $key => $val) {
echo "<input type='hidden' name='".htmlentities($key)."' value='".htmlentities($val)."'>";
}
echo "<input type='hidden' name='success' value='Row was successfuly removed!'>";
?>
</form>
<script type="text/javascript">
	document.frm.submit();
</script>