<?php require_once '../scripts/db_funcs.php' ?>
<?php 
  	$conn = db_connect();

	if(isset($_POST['update'])) {

		$table_select = $_POST['table_select'];
		$columns_row = odbc_columns($conn, $dbconf['database'], $dbconf['schema'], $table_select);
		$query_string = "update $table_select SET ";
		$columns = array();
		while(odbc_fetch_row($columns_row)) {
			$column_name = odbc_result($columns_row, 4);
			array_push($columns, $column_name);
		}

		foreach($columns as $column) {
			if ($column != 'id') {
				if ($_POST[$column] != '') {
					$query_string = "{$query_string} {$column} = '".$_POST[$column]."'";
				}	
			} else {
				$id = $column;
			}
		}

		$query_string = "{$query_string} where id = ".$_POST['id'];
 	
		odbc_exec($conn, $query_string) or die("Couldn't update record in database: ".odbc_errormsg());

		unset($_POST['update']);
	}


	odbc_close ($conn);
	echo "Redirecting...";
?>

<form action='/update.php' method='post' name='frm'>
<?php
echo "<input type='hidden' name='table_select' value='{$_POST['table_select']}'>";
echo "<input type='hidden' name='success' value='Row was successfuly updated!'>";
?>
</form>
<script type="text/javascript">
	document.frm.submit();
</script>
