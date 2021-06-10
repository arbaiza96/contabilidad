  <?php require '../app/template/header.php'; ?>
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="../dist/img/ContaLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">CONTABILIDAD</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <?php require 'menu/menu.php';?>
          <!-- /.sidebar-menu -->
        </div>
      </aside>
      <!-- /.sidebar -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Sucursales</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active"><a href="../">Empresas</a></li>
                  <li class="breadcrumb-item active">Sucursales</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row">

              <div class="col-lg-12 col-sm-12" id='contenedorSucursales'>
                <div class="card">
                  <div class="card-body">
                    <div class="col p-0 d-flex justify-content-end">
                      <div class="">
                        <button class='btn btn-dark' id='btnRecargar'>&nbsp;<span class='fa fa-refresh'></span>&nbsp;</button>
                        <button class='btn btn-primary' id='btnAgregarSucursal'>NUEVA SUCURSAL</button>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class='table table-striped table-hover table-sm border mt-3'>
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>RAZON</th>
                            <th>N.I.T</th>
                            <th>REGISTRO</th>
                            <th>OPCIONES</th>
                          </tr>
                        </thead>
                        <tbody id='lista_sucursales'>
                          <tr>
                            <td colspan='6' class='text-center py-3'>LISTA DE SUCURSALES</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <script>
                $(document).ready(function(){
                  cargar_listado_sucursales();
                  $("#btnAgregarSucursal").click(function(){
                    $("#contenedorSucursales").addClass('d-none');
                    $("#formularioSucursales").removeClass('d-none');
                  });
                  $("#btnRecargar").click(function(){
                    cargar_listado_sucursales();
                  })
                  $("#btnVolver").click(function(){
                    volver_sucursales();
                  });
                  $("#btnGuardarDatos").click(function(){
                    guardar_sucursal();
                  });
                });


                function cargar_listado_sucursales(){
                  $.ajax({
                    url: '../app/request.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      class: 'empresas',
                      action: 'cargar_lista_sucursales',
                    },
                    beforeSend : function(){
                      let e = $("#lista_sucursales");
                      e.html("");
                      e.append("\
                        <tr>\
                          <td colspan='6'>\
                            <div class='my-4 d-flex flex-column justify-content-center align-items-center'>\
                              <div class='spinner-border' style='width: 3rem; height: 3rem;'>\
                                <span class='sr-only'>Loading...</span>\
                              </div>\
                              <span class='mt-3'>CARGANDO</span>\
                            </div>\
                          </td>\
                        </tr>\
                      ");
                    }
                  }).done(function(data, textstatus, jqxhr){
                    console.log(data);
                    let e = $("#lista_sucursales");
                    e.html("");
                    if(data.length == 0){
                      e.append("<tr><td colspan='6' class='text-center py-3'>NO SE HAN AGREGADO REGISTROS</td></tr>");
                      return false;
                    }
                    let contador = 0;
                    $.each(data, function(index, val) {
                      contador++;
                      e.append("\
                        <tr>\
                          <td>"+contador+"</td>\
                          <td>"+val.nombre+"</td>\
                          <td>"+val.razon_social+"</td>\
                          <td>"+val.nit+"</td>\
                          <td>"+val.registro+"</td>\
                          <td>\
                            <span id='btnEditar_"+val.id+"' class='btn btn-light btn-sm'>&nbsp;<i class='fa fa-pencil'></i>&nbsp;</span>\
                            <span id='btnEliminar_"+val.id+"' class='btn btn-light btn-sm'>&nbsp;<i class='fa fa-trash'></i>&nbsp;</span>\
                          </td>\
                        </tr>\
                      ");
                      $("#btnEditar_"+val.id).click(function(){
                        console.log("editar sucursal");
                      })
                      $("#btnEliminar_"+val.id).click(function(){
                        alertify.confirm("Se eliminará el registro del proveedor '"+val.nombre+"' ¿Desea proceder?", 
                        function(){
                          eliminar_sucursal(val.id);
                        });
                      })
                    });
                  }).fail(function(data, textstatus, jqxhr){
                    console.log("algo ha salido mal >> " + textstatus);
                  });
                }

                function eliminar_sucursal(id){
                  $.ajax({
                    url: '../app/request.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      class: 'empresas',
                      action: 'eliminar_sucursal',
                      id: id,
                    }
                  }).done(function(data, textstatus, jqxhr){
                    if(data == 1){
                      alertify.success("SE HA ELIMINADO LA SUCURSAL");
                      cargar_listado_sucursales();
                    }
                  });
                }

                function guardar_sucursal(){
                  let nombre = $("#txtNombre").val();

                  if(nombre == ""){
                    alertify.error("DEBE COMPLETAR LOS CAMPOS OBLIGATORIOS *");
                    return false;
                  }

                  $.ajax({
                    url: '../app/request.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      class: 'empresas',
                      action: 'guardar_sucursal',
                      nombre: nombre,
                    }
                  }).done(function(data, textstatus, jqxhr){
                    if(data == 1){
                      alertify.success("SE HA AGREGADO LA SUCURSAL");
                      cargar_listado_sucursales();
                      limpiar_formulario_sucursales();
                      volver_sucursales();
                    }
                  });
                }

                function limpiar_formulario_sucursales(){
                  $("#txtNombre").val("");
                }

                function volver_sucursales(){
                  $("#contenedorSucursales").removeClass('d-none');
                  $("#formularioSucursales").addClass('d-none');
                }

              </script>

              <div class="col-lg-8 col-sm-12 d-none" id='formularioSucursales'>
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column mb-3">
                      <h5 class="card-title">DATOS DE SUCURSAL</h5>
                      <small class='text-muted'>Los campos marcados con * son obligatorios</small>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*NOMBRE: </label>
                      <div class="col-sm-9">
                        <input type="text" id='txtNombre' autocomplete="off" class='form-control' placeholder="NOMBRE DE SUCURSAL">
                      </div>
                    </div>
                    <div class="col p-0">
                      <button class="btn btn-primary" id="btnGuardarDatos">GUARDAR DATOS</button>
                      <button class="btn btn-secondary" id='btnVolver'>VOLVER</button>
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>



        <!-- /.content -->
      </div>

  <?php require '../app/template/footer.php'; ?>
