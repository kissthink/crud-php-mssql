<!doctype html>
<head>
    <title>MSSQL</title>
    <!--Подключаемые библиотеки и стили-->
    <?php include "templates/resources.php" ?>
	<?php require_once "scripts/db_funcs.php" ?>
</head>

<body>
<?php include "templates/header.php" ?>

<h1>Добавить запись</h1>
<hr>

<?php include 'templates/table_select.php' ?>

<?php 
	if(isset($_POST['table_select'])) {

		$table_select = $_POST['table_select'];
		echo  "<form class='form-actions' action='scripts/insert_script.php' method='post'>";
		echo  "<input type='hidden' name='table_select' value='".$table_select."'>";
		$columns = odbc_columns($conn, $dbconf['database'], $dbconf['schema'], $table_select);
		while(odbc_fetch_row($columns)) {
			$column_name = odbc_result($columns, 4);
			if ($column_name != 'id') {
				echo "<div class='controls-row'>";
				echo "<input type='text' name='$column_name' placeholder='$column_name'>";
				echo "</div>";
			}
		}

		echo '<div class="controls-row">';
		echo '<input type="submit" name="create" class="btn btn-warning" value="Сохранить">';
		echo '</div>';
		echo '</form>';
	}
?>


<script type="text/javascript">
	$(function () {
		updateNavBar('create.php');
	})
</script>
</body>
</html>