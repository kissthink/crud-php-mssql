<!doctype html>
<head>
    <title>MSSQL</title>
    <!--Подключаемые библиотеки и стили-->
    <?php include "templates/resources.php" ?>
	<?php require_once "scripts/db_funcs.php" ?>
</head>

<body>
<?php include "templates/header.php" ?>

<h1>Просмотреть таблицы</h1>
<hr>

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
odbc_close ($conn);
?>

<script type="text/javascript">
	$(function() {
		updateNavBar('read.php');
	});
</script>
</body>
</html>