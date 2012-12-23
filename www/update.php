<!doctype html>
<head>
    <title>MSSQL</title>
    <!--Подключаемые библиотеки и стили-->
    <?php include "templates/resources.php" ?>
    <?php require_once "scripts/db_funcs.php" ?>
</head>

<body>

<?php include "templates/header.php" ?>

<?php include "templates/table_select.php" ?>

<?php 

if(!isset($_POST["table_select"])) { //якщо змінна $_POST["table_select"]) не визначена, буде відображена таблиця Tovary
	$table_select="students";
}
else {
	$table_select = $_POST["table_select"];//отриммування назви таблиц? ?з масиву $_POST
}
echo "<h2>Таблица $table_select:</h2>";
/* Connect to the server using SQL Authentication and
specify the Books database as the database in use. */

$conn = db_connect();
/* Set up and execute the query. */

$query_string="select * from $table_select";	
$res = odbc_exec ($conn, $query_string); //отримування ?дентиф?катора результату запиту

//побудова таблиці
odbc_result_all($res, "class='table table-striped table-bordered'") ; //виводимо результат як таблицю
?>

<div class="modal hide fade" role="dialog">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>You are going to update a row in table: <?php echo $table_select; ?></h3>
  </div>
  <form method="post" action="/scripts/update_script.php">
  <div class="modal-body">
  	<?php 
    		$columns = odbc_columns($conn, $dbconf['database'], $dbconf['schema'], $table_select);
			while(odbc_fetch_row($columns)) {
			$column_name = odbc_result($columns, 4);
			if ($column_name != 'id') {
				echo "<div class='controls-row'>";
				echo "<input type='text' name='$column_name' placeholder='$column_name'>";
				echo "</div>";
			}
		}
    ?>
  </div>
  <div class="modal-footer">
    	<input type="hidden" id="record_id" name="id">
    	<input type="hidden" id="table_select" name="table_select" value="<?php echo $table_select; ?>">
    	<a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Close</a>
    	<input type="submit" name="update" class="btn btn-warning" value="Update">
  </div>
  </form>
</div>

<?php 
	odbc_close ($conn);
?>


<script type="text/javascript">
	$(function() {
		updateNavBar('update.php');

		$('.table tr').click(function () {
			var $this = $(this);
			var id = $this.children('td')[0].innerHTML;
			$('#record_id').val(id);
			$('.modal').modal({show: true});
		});
	});
</script>
</body>
</html>