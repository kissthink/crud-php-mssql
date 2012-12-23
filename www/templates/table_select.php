<h2>Выберите таблицу</h2>
<form method="post">
<div class="controls-row">
<select name='table_select'>
<?php 
	$conn = db_connect();
	$res = odbc_tables($conn, $dbconf['database'], $dbconf['schema']);
	$fields = odbc_num_fields($res);
	while(odbc_fetch_row($res)) {
		$table_name = odbc_result($res, 3);
		if ($table_name != 'sysdiagrams') { 
			echo "<option value='".$table_name."'>".$table_name."</option>";
		}
	}
?>
</select>
</div>
<input type="submit" class="btn btn-primary" value="Выбрать">
</form>