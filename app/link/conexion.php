<?php
require 'credenciales.php';
class Conexion{

	public $pdo;

	public function __construct($server = "contabilidad"){
		global $data;
		$host = $data[$server]['host'];
		$dbname = $data[$server]['dbname'];
		$user = $data[$server]['user'];
		$pass = $data[$server]['pass'];
		$port = $data[$server]['port'];
		try{
			$this->pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
		    $this->pdo->exec('SET CHARACTER SET utf8');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			return $this->pdo;
		}catch(PDOException $e){
		    echo "¡Error!: " . $e->getMessage();
		}
	}

	public function ejecutar($sql,$con){
		try {
            $statement = $con->prepare($sql);
            $statement->execute();
            return 1;
        } catch (PDOException $e) {
            echo "ERROR >> " . $e->getMessage();
            return 0;
        }
	}
	public function ejecutar_preparada($sql,$arr=array(),$con){
		try {
            $statement = $con->prepare($sql);
            $statement->execute($arr);
            return 1;
        } catch (PDOException $e) {
            echo "ERROR >> " . $e->getMessage();
            return 0;
        }
	}
	public function ejecutar_consulta($sql,$con){
        try {
            $statement = $con->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR >> " . $e->getMessage();
            return 0;
        }
    }

    public function ejecutar_consulta_preparada($sql,$arr=array(),$con){
        try {
            $statement = $con->prepare($sql);
            $statement->execute($arr);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "ERROR >> " . $e->getMessage();
            return 0;
        }
    }

}

?>