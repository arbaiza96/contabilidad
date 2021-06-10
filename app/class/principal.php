<?php 

Class principal extends Conexion{

	public function __construct(){
        parent::__construct();  
    }
    public function cargar_empresas($id){
        $sql = "SELECT * 
            FROM leccion_global 
            WHERE id = :leccion";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(':leccion' => $id));
        return $statement->fetchAll();
    }

}


?>