<!doctype html>
<head>
    <title>MSSQL</title>
    <!--Подключаемые библиотеки и стили-->
    <?php include "templates/resources.php" ?>
    <?php require_once "scripts/db_funcs.php" ?>
</head>

<body>

<?php include "templates/header.php" ?>

<?php include 'templates/table_select.php' ?>

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
    <h3>Are you sure? Think twice...</h3>
  </div>
  <div class="modal-body">
  	<div class="row-container">
  	</div>
  </div>
  <div class="modal-footer">
  	<form method="post" action="/scripts/remove_script.php">
    	<input type="hidden" id="record_id" name="record_id">
    	<input type="hidden" id="table_select" name="table_select" value="<?php echo $table_select; ?>">
    	<a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Close</a>
    	<input type="submit" name="remove" class="btn btn-danger" value="Remove">
	</form>
  </div>
</div>



<script type="text/javascript">
	$(function() {
		updateNavBar('remove.php');

		$('.table tr').click(function () {
			var $this = $(this);
			var id = $this.children('td')[0].innerHTML;
			$('#record_id').val(id);
			$('.modal .row-container').html("Record with id: " + id + " would be removed, are you sure?");
			$('.modal').modal({show: true});
		});
	});
</script>
</body>
</html>