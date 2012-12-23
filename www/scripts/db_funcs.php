<?php 
	
	$sql = array(dsn => "SQLEXPRESS", username => "Alexey", password => "");
	$dbconf = array(database => "university", schema => "dbo");

	function db_connect() {
		global $sql;

		$conn = odbc_connect ($sql['dsn'], $sql['username'], $sql['password']); //п?дключення до джерела даних ODBC
		if($conn === false) {
    		echo "Could not connect to $dsn.\n";
		}
		return $conn;
	};
?>