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
                <h1 class="m-0 text-dark">Clientes</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active"><a href="../">Empresas</a></li>
                  <li class="breadcrumb-item active">Clientes</li>
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

              <div class="col-lg-12 col-sm-12" id='contenedorClientes'>
                <div class="card">
                  <div class="card-body">
                    <div class="col p-0 d-flex justify-content-end">
                      <div class="">
                        <button class='btn btn-dark' id='btnRecargar'>&nbsp;<span class='fa fa-refresh'></span>&nbsp;</button>
                        <button class='btn btn-primary' id='btnAgregarCliente'>NUEVO CLIENTE</button>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class='table table-striped table-hover table-sm border mt-3'>
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>DUI</th>
                            <th>N.I.T</th>
                            <th>TIPO</th>
                            <th>OPCIONES</th>
                          </tr>
                        </thead>
                        <tbody id='lista_clientes'>
                          <tr>
                            <td colspan='6' class='text-center py-3'>LISTA DE CLIENTES</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <script>
                $(document).ready(function(){
                  cargar_listado_clientes();
                  $("#btnAgregarCliente").click(function(){
                    $("#contenedorClientes").addClass('d-none');
                    $("#formularioClientes").removeClass('d-none');
                    $("#rad_consumidor").prop('checked', true).change();
                  });
                  $("#btnRecargar").click(function(){
                    cargar_listado_clientes();
                  });
                  $("#btnVolver").click(function(){
                    volver_clientes();
                  });
                  $("#btnGuardarDatos").click(function(){
                    guardar_cliente();
                  });

                  $("#rad_consumidor").change(function(){
                    let valor = $(this).prop('checked');
                    if(valor){
                      $("div[contribuyente]").each(function(index, el) {
                        $(this).addClass("d-none");
                      });
                      $("div[consumidor]").each(function(index, el) {
                        $(this).removeClass("d-none");
                      });
                    }
                  })
                  $("#rad_contribuyente").change(function(){
                    let valor = $(this).prop('checked');
                    if(valor){
                      $("div[consumidor]").each(function(index, el) {
                        $(this).addClass("d-none");
                      });
                      $("div[contribuyente]").each(function(index, el) {
                        $(this).removeClass("d-none");
                      });
                    }
                  })
                });

                function cargar_listado_clientes(){
                  $.ajax({
                    url: '../app/request.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      class: 'empresas',
                      action: 'cargar_lista_clientes',
                    },
                    beforeSend : function(){
                      let e = $("#lista_clientes");
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
                    let e = $("#lista_clientes");
                    e.html("");
                    if(data.length == 0){
                      e.append("<tr><td colspan='6' class='text-center py-3'>NO SE HAN AGREGADO REGISTROS</td></tr>");
                      return false;
                    }
                    let contador = 0;
                    $.each(data, function(index, val) {
                      contador++;
                      let tipo = (val.tipo == 1 ? 'Consumidor' : 'Contribuyente');
                      e.append("\
                        <tr>\
                          <td>"+contador+"</td>\
                          <td>"+val.nombre+"</td>\
                          <td>"+val.dui+"</td>\
                          <td>"+val.nit+"</td>\
                          <td>"+tipo+"</td>\
                          <td>\
                            <span id='btnEditar_"+val.id+"' class='btn btn-light btn-sm'>&nbsp;<i class='fa fa-pencil'></i>&nbsp;</span>\
                            <span id='btnEliminar_"+val.id+"' class='btn btn-light btn-sm'>&nbsp;<i class='fa fa-trash'></i>&nbsp;</span>\
                          </td>\
                        </tr>\
                      ");
                      $("#btnEditar_"+val.id).click(function(){
                        console.log("editar cliente");
                      })
                      $("#btnEliminar_"+val.id).click(function(){
                        alertify.confirm("Se eliminará el registro del cliente '"+val.nombre+"' ¿Desea proceder?", 
                        function(){
                          eliminar_cliente(val.id);
                        });
                      })
                    });
                  }).fail(function(data, textstatus, jqxhr){
                    console.log("algo ha salido mal >> " + textstatus);
                  });
                }

                function eliminar_cliente(id){
                	$.ajax({
                    url: '../app/request.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      class: 'empresas',
                      action: 'eliminar_cliente',
                      id: id,
                    }
                  }).done(function(data, textstatus, jqxhr){
                    if(data == 1){
                      alertify.success("SE HA ELIMINADO EL CLIENTE");
                      cargar_listado_clientes();
                    }
                  });
                }

                function guardar_cliente(){
                  let nombre = $("#txtNombre").val();
                  let dui = $("#txtDUI").val();
                  let nit = $("#txtNIT").val();
                  let registro = $("#txtRegistro").val();
                  let giro = $("#txtGiro").val();
                  let contribuyente = $("#txtContribuyente").val();
                  let contacto = $("#txtContacto").val();
                  let correo = $("#txtCorreo").val();
                  let consumidor = $("#rad_consumidor").prop("checked");
                  let tipo = (consumidor ? 1:2); // 1 consumidor, 2 contribuyente

                  if(nombre == "" || dui == "" || nit == ""){
                    alertify.error("DEBE COMPLETAR LOS CAMPOS OBLIGATORIOS *");
                    return false;
                  }

                  $.ajax({
                    url: '../app/request.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      class: 'empresas',
                      action: 'guardar_cliente',
                      nombre: nombre,
                      dui: dui,
                      nit: nit,
                      registro: registro,
                      giro: giro,
                      contribuyente: contribuyente,
                      contacto: contacto,
                      correo: correo,
                      tipo: tipo,
                    }
                  }).done(function(data, textstatus, jqxhr){
                    if(data == 1){
                      alertify.success("SE HA AGREGADO EL CLIENTE");
                      cargar_listado_clientes();
                      limpiar_formulario_cliente();
                      volver_clientes();
                    }
                  });
                }

                function volver_clientes(){
                  $("#contenedorClientes").removeClass('d-none');
                  $("#formularioClientes").addClass('d-none');
                }

                function limpiar_formulario_cliente(){
                  $("#txtNombre").val("");
                  $("#txtDUI").val("");
                  $("#txtNIT").val("");
                  $("#txtRegistro").val("");
                  $("#txtGiro").val("");
                  $("#txtContribuyente").val("1");
                  $("#txtContacto").val("");
                  $("#txtCorreo").val("");
                  $("#rad_consumidor").change().prop("checked",true);
                }

              </script>

              <div class="col-lg-8 col-sm-12 d-none" id='formularioClientes'>
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column mb-3">
                      <h5 class="card-title">DATOS DE CLIENTE</h5>
                      <small class='text-muted'>Los campos marcados con * son obligatorios</small>
                    </div>
                    <div class="col row d-flex justify-content-center align-items-center">
                      <div class="row">
                        <div class='px-4'>
                          <label for="rad_consumidor">CONSUMIDOR&nbsp;</label>
                          <input type="radio" name='tipo_cliente' id='rad_consumidor'>
                        </div>
                        <div class='px-4'>
                          <label for="rad_contribuyente">CONTRIBUYENTE&nbsp;</label>
                          <input type="radio" name='tipo_cliente' id='rad_contribuyente'>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="mb-3 col row" consumidor contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*NOMBRE: </label>
                      <div class="col-sm-9">
                        <input type="text" id='txtNombre' autocomplete="off" class='form-control' placeholder="NOMBRE DEL CLIENTE">
                      </div>
                    </div>
                    <div class="mb-3 col row" consumidor contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*DUI: </label>
                      <div class="col-sm-9">
                        <input type="text" id='txtDUI' autocomplete="off" class='form-control' placeholder="NÚMERO DE DUI">
                      </div>
                    </div>
                    <div class="mb-3 col row" consumidor contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">N.I.T:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtNIT' autocomplete="off" class='form-control' placeholder="NÚMERO DE N.I.T">
                      </div>
                    </div>
                    <div class="mb-3 col row d-none" contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*N. REGISTRO:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtRegistro' autocomplete="off" class='form-control' placeholder="NÚMERO DE REGISTRO">
                      </div>
                    </div>
                    <div class="mb-3 col row d-none" contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*GIRO:</label>
                      <div class="col-sm-9">
                        <input type="text" id="txtGiro" autocomplete="off" class='form-control' placeholder="GIRO DEL NEGOCIO">
                      </div>
                    </div>
                    <div class="mb-3 col row d-none" contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*CONTRIBUYENTE:</label>
                      <div class="col-sm-9">
                        <select autocomplete="off" id='txtContribuyente' class='form-control' id="">
                          <option value="1">PEQUEÑO</option>
                          <option value="2">MEDIANO</option>
                          <option value="3">GRANDE</option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-3 col row" consumidor contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">CONTACTO:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtContacto' autocomplete="off" class='form-control' placeholder="NÚMERO TELEFÓNICO DE CONTACTO">
                      </div>
                    </div>
                    <div class="mb-3 col row" consumidor contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">CORREO:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtCorreo' autocomplete="off" class='form-control' placeholder="DIRECCIÓN DE CORREO ELECTRÓNICO">
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
