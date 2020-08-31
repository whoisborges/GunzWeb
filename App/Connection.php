<?php

namespace App;

class Connection {

	public static function getDb() {
		try {

		    $conn = new \PDO("sqlsrv:Server=YOUR-SQL\SQLEXPRESS;Database=GunzDB","sa","yourpass");

		    $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);  

		    return $conn;

		} catch (PDOException $e) {
		    die ("Erro na conexao com o banco de dados: ".$e->getMessage());
		}
}
}
?>
