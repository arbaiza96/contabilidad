<?php 
  session_start();
  if(empty($_SESSION['idempresa'])){
    echo "<script> window.location='../'; </script>";
  }
  require '../app/link/conexion.php';
  require '../app/class/empresas.php';
  $class = new empresas();
  $id = $_SESSION['idempresa'];
  $nombre = $class->obtener_nombre_empresa($id);
  echo "<script>const idempresa_ = $id;</script>";
  echo "<script>const nombreEmpresa_ = '".$nombre['nombre']."';</script>";
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link">
    <img src="../dist/img/ContaLTELogo.png" alt="AdminLTE Logo" class="brand-image"
         style="opacity: .8">
    <span class="brand-text font-weight-light">CONTABILIDAD</span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image bg-dark d-flex justify-content-center align-items-center flex-column" style="padding:0.5rem 1rem;">
        <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        <span class='fa fa-angle-double-right' title='EMPRESA 1'></span>
      </div>
      <div class="info">
        <a href="#" class="d-block"><?=$nombre['nombre']?></a>
      </div>
    </div>
    <nav class="mt-2">
      <!-- nav-pills nav-flat nav-legacy nav-child-indent -->
      <ul class="nav nav-pills nav-child-indent nav-sidebar flex-column" data-widget="treeview" data-accordion="false">
        <li class="nav-item">
          <a href="index.php" class="nav-link <?=($file=='index.php'?'active':'')?>">
            <i class="nav-icon fa fa-home"></i>
            <p>Inicio</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="clientes.php" class="nav-link <?=($file=='clientes.php'?'active':'')?>">
            <i class="nav-icon fa fa-users"></i>
            <p>Clientes</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="proveedores.php" class="nav-link <?=($file=='proveedores.php'?'active':'')?>">
            <i class="nav-icon fa fa-vcard"></i>
            <p>Proveedores</p>
          </a>
        </li>
        <?php 
          if($file=='venta_contribuyentes.php' || $file=='venta_consumidores.php' || $file=='compras.php'){
            $treeative = "active";
          }

        ?>
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link <?=@$treeative?>">
            <i class="nav-icon fa fa-book"></i>
            <p>Libros <i class="right fa fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="venta_contribuyentes.php" class="nav-link <?=($file=='venta_contribuyentes.php'?'active':'')?>">
                <i class="fa fa-circle-thin nav-icon"></i>
                <p>Ventas a contribuyente</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="venta_consumidores.php" class="nav-link <?=($file=='venta_consumidores.php'?'active':'')?>">
                <i class="fa fa-circle-thin nav-icon"></i>
                <p>Ventas a consumidores</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="compras.php" class="nav-link <?=($file=='compras.php'?'active':'')?>">
                <i class="fa fa-circle-thin nav-icon"></i>
                <p>Compras</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="sucursales.php" class="nav-link <?=($file=='sucursales.php'?'active':'')?>">
            <i class="nav-icon fa fa-map-marker"></i>
            <p>Sucursales</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>


<script>
  $(document).ready(function(){
    setSidebarStatus();
    $("a.nav-link[data-widget='pushmenu']").click(function(){
      // si es true es que esta minimizado si es false es que esta agrandado
      let esta_minimizado = !$("body").hasClass("sidebar-collapse");
      document.cookie = "sidebar_collapse="+esta_minimizado;
    })
    function setSidebarStatus(){
      let cookies = document.cookie;
      let arr = cookies.split(";");
      let status = false;
      for (var i = 0; i < arr.length; i++) {
        if(arr[i].split("=")[0].trim() == "sidebar_collapse" && arr[i].split("=")[1].trim() == "true"){
          status = true;
        }
      }
      if(status == true){
        $("body").addClass("sidebar-collapse");
      }else{
        $("body").removeClass("sidebar-collapse");
      }
    }
  })
</script>