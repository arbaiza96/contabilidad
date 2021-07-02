<?php 

class empresas extends Conexion{

	public function __construct(){
		parent::__construct();  
	}

  public function guardar_compra(){
    $data = $_REQUEST['data'];
    $id_empresa = $data['id_empresa'];
    $ex_internas = $data['ex_internas'];
    $ex_import = $data['ex_import'];
    $gr_internas = $data['gr_internas'];
    $gr_import = $data['gr_import'];
    $fovial = $data['fovial'];
    $per_iva = $data['per_iva'];
    $ret_iva = $data['ret_iva'];
    $ret_ter = $data['ret_ter'];
    $sujetos = $data['sujetos'];
    $cf = $data['cf'];
    $total = $data['total'];
    $tipo_documento = $data['tipo_documento'];
    $fecha = $data['fecha'];
    $numero = $data['numero'];
    $id_proveedor = $data['id_proveedor'];
    $registro = $data['registro'];
    $nit = $data['nit'];
    $resolucion = $data['resolucion'];
    $serie = $data['serie'];
    $clasificacion = $data['clasificacion'];
    $clasificacion_detalle = $data['clasificacion_detalle'];
    $id_unico = date('YmdHis')."_".rand(1000,9999);
    $mes = 6;
    $anio = 2021;

    $q="INSERT INTO libro_compras(
          id,
          fecha_documento,
          comprobante,
          registro,
          nit,
          proveedor,
          ce_local,
          ce_inter,
          cg_local,
          cg_inter,
          ccf,
          fovial,
          total,
          p_iva,
          r_iva,
          r_terceros,
          excluidos,
          tipo_documento,
          id_proveedor,
          mes,
          anio,
          clasificacion,
          clasificacion_detalle,
          resolucion,
          serie,
          id_empresa
        ) 
        VALUES(
          :id,
          :fecha_documento,
          :comprobante,
          :registro,
          :nit,
          :proveedor,
          :ce_local,
          :ce_inter,
          :cg_local,
          :cg_inter,
          :ccf,
          :fovial,
          :total,
          :p_iva,
          :r_iva,
          :r_terceros,
          :excluidos,
          :tipo_documento,
          :id_proveedor,
          :mes,
          :anio,
          :clasificacion,
          :clasificacion_detalle,
          :resolucion,
          :serie,
          :id_empresa
        )";
    $st = $this->pdo->prepare($q);
    $st->execute(array(
      ":id" => $id_unico,
      ":fecha_documento" => $fecha,
      ":comprobante" => $numero,
      ":registro" => $registro,
      ":nit" => $nit,
      ":proveedor" => $id_proveedor,
      ":ce_local" => $ex_internas,
      ":ce_inter" => $ex_import,
      ":cg_local" => $gr_internas,
      ":cg_inter" => $gr_import,
      ":ccf" => $cf,
      ":fovial" => $fovial,
      ":total" => $total,
      ":p_iva" => $per_iva,
      ":r_iva" => $ret_iva,
      ":r_terceros" => $ret_ter,
      ":excluidos" => $sujetos,
      ":tipo_documento" => $tipo_documento,
      ":id_proveedor" => $id_proveedor,
      ":mes" => $mes,
      ":anio" => $anio,
      ":clasificacion" => $clasificacion,
      ":clasificacion_detalle" => $clasificacion_detalle,
      ":resolucion" => $resolucion,
      ":serie" => $serie,
      ":id_empresa" => $id_empresa,
    ));

    echo "<pre>";
    print_r($_REQUEST);
    echo "</pre>";

// id,
// fecha_documento,
// comprobante,
// registro,
// nit,
// proveedor,
// ce_local,
// ce_inter,
// cg_local,
// cg_inter,
// ccf,
// fovial,
// total,
// p_iva,
// r_iva,
// r_terceros,
// excluidos,
// fecha_registro,
// tipo_documento,
// id_proveedor,
// mes,
// anio,
// clasificacion,
// clasificacion_detalle,
// resolucion,
// serie,
// id_empresa,


  }

  public function guardar_sucursal(){
    return json_encode(1);
  }

  public function eliminar_sucursal(){
    return json_encode(1);
  }

  public function cargar_lista_sucursales(){
    return json_encode(array());
  }


  public function proveedor_autocomplete(){
    $con = $this->pdo;
    $term = $_REQUEST['term'];
    $id = $_REQUEST['id'];
    $sql = "SELECT id, nombre, nit, registro, nombre as value from proveedores WHERE nombre like :nombre AND id_empresa = :id LIMIT 20;";
    $arr = array(":nombre" => "%".$term."%",":id" => $id);
    $proveedores = $this->ejecutar_consulta_preparada($sql, $arr, $con);
    return json_encode($proveedores);
  }

  public function cargar_datos_registro_compra(){
    $arr = new stdClass();
    $con = $this->pdo;
    $sql = "SELECT id, tipo from documento_tipo WHERE estado = 1;";
    $tipo_documento = $this->ejecutar_consulta($sql, $con);
    $sql = "SELECT id, clasificacion from documento_clasificacion WHERE estado = 1;";
    $clasificacion = $this->ejecutar_consulta($sql, $con);
    $sql = "SELECT id, id_clasificacion, nombre from documento_clasificacion_detalle WHERE estado = 1;";
    $clasificacion_detallle = $this->ejecutar_consulta($sql, $con);
    $arr->tipo_documento = $tipo_documento;
    $arr->clasificacion = $clasificacion;
    $arr->clasificacion_detallle = $clasificacion_detallle;

    return json_encode($arr);
  }
  public function cargar_empresas(){
    $con = $this->pdo;
    $sql="SELECT empresas.id,empresas.nombre, empresas.registro, count(clientes.id) as clientes, 
          (SELECT count(id) from proveedores where proveedores.id_empresa = empresas.id AND proveedores.estado = 1) as proveedores 
          FROM empresas left join clientes on (clientes.id_empresa = empresas.id AND clientes.estado = 1) 
          WHERE empresas.estado = 1 GROUP BY empresas.id";
    $arr = $this->ejecutar_consulta($sql, $con);
    return json_encode($arr);
  }

  public function crear_sesionEmpresa(){
    $_SESSION['idempresa'] = $_REQUEST['id'];
    return 1;
  }

  public function obtener_nombre_empresa($id){
    $sql = "SELECT nombre FROM empresas WHERE estado = 1 AND id = :id";
    $statement = $this->pdo->prepare($sql);
    $statement->execute(array(":id" => $id));
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function guardar_empresa(){
  	try {
  		$sql="CALL guardar_empresa(:nombre,:direccion,:giro,:registro,:nit,:contribuyente,:isss,:afp);";
    	$statement = $this->pdo->prepare($sql);
    	$statement->execute(ARRAY(
    		":nombre" => $_REQUEST['nombre'],
    		":direccion" => $_REQUEST['direccion'],
    		":giro" => $_REQUEST['giro'],
    		":registro" => $_REQUEST['registro'],
    		":nit" => $_REQUEST['nit'],
    		":contribuyente" => $_REQUEST['contribuyente'],
    		":isss" => $_REQUEST['isss'],
    		":afp" => $_REQUEST['afp'],
    	));
    	return json_encode(1);
  	} catch (PDOException $e) {
      echo "ERROR >> " . $e->getMessage();
  		return 0;
  	}
  }

  // -- --------------------------------------------------------
  // -- funciones de empresas
  // -- --------------------------------------------------------
  public function guardar_cliente(){
    try {
      $sql="CALL guardar_cliente(:id_empresa,:nombre,:dui,:nit,:registro,:contacto,:correo,:giro,:tipo,:contribuyente);";
      $statement = $this->pdo->prepare($sql);
      $statement->execute(ARRAY(
        ":id_empresa" => $_SESSION['idempresa'],
        ":nombre" => $_REQUEST['nombre'],
        ":dui" => $_REQUEST['dui'],
        ":nit" => $_REQUEST['nit'],
        ":registro" => $_REQUEST['registro'],
        ":contacto" => $_REQUEST['contacto'],
        ":correo" => $_REQUEST['correo'],
        ":giro" => $_REQUEST['giro'],
        ":tipo" => $_REQUEST['tipo'],
        ":contribuyente" => $_REQUEST['contribuyente'],
      ));
      return json_encode(1);
    } catch (PDOException $e) {
      echo "ERROR >> " . $e->getMessage();
      return 0;
    }
  }

  public function guardar_proveedor(){
    try {
      $sql="CALL guardar_proveedor(:id_empresa,:nombre,:razon,:telefono,:direccion,:nit,:registro,:plazo,:contribuyente);";
      $statement = $this->pdo->prepare($sql);
      $statement->execute(ARRAY(
        ":id_empresa" => $_SESSION['idempresa'],
        ":nombre" => $_REQUEST['nombre'],
        ":razon" => $_REQUEST['razon'],
        ":telefono" => $_REQUEST['telefono'],
        ":direccion" => $_REQUEST['direccion'],
        ":nit" => $_REQUEST['nit'],
        ":registro" => $_REQUEST['registro'],
        ":plazo" => $_REQUEST['plazo'],
        ":contribuyente" => $_REQUEST['contribuyente'],
      ));
      return json_encode(1);
    } catch (PDOException $e) {
      echo "ERROR >> " . $e->getMessage();
      return 0;
    }
  }

  public function eliminar_proveedor(){
    try {
      $sql="CALL eliminar_proveedor(:id);";
      $statement = $this->pdo->prepare($sql);
      $statement->execute(ARRAY(":id" => $_REQUEST['id']));
      return json_encode(1);
    } catch (PDOException $e) {
      echo "ERROR >> " . $e->getMessage();
      return 0;
    }
  }

  public function cargar_lista_proveedores(){
    try {
      $sql="CALL cargar_lista_proveedores(:id_empresa, 1);";
      $statement = $this->pdo->prepare($sql);
      $statement->execute(ARRAY(":id_empresa" => $_SESSION['idempresa']));
      return json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
      echo "ERROR >> " . $e->getMessage();
    }
  }

  public function cargar_lista_clientes(){
    try {
      $sql="CALL cargar_lista_clientes(:id_empresa, 1);";
      $statement = $this->pdo->prepare($sql);
      $statement->execute(ARRAY(":id_empresa" => $_SESSION['idempresa']));
      return json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
      echo "ERROR >> " . $e->getMessage();
    }
  }

  public function eliminar_cliente(){
    try {
      $sql="CALL eliminar_cliente(:id);";
      $statement = $this->pdo->prepare($sql);
      $statement->execute(ARRAY(":id" => $_REQUEST['id']));
      return json_encode(1);
    } catch (PDOException $e) {
      echo "ERROR >> " . $e->getMessage();
      return 0;
    }
  }

}


?>