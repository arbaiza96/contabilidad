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
    public function number_months(){
        $meses = array(
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Septiembre',
            '10' => 'Ocubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        );
        return $meses;
    }

}


?>