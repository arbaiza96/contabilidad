  <?php require 'app/template/header.php'; ?>
  
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="dist/img/ContaLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">CONTABILIDAD</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <!-- nav-pills nav-flat nav-legacy nav-child-indent -->
            <ul class="nav nav-pills nav-child-indent nav-sidebar flex-column" data-widget="treeview" data-accordion="false">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fa fa-building"></i>
                  <p>Empresas</p>
                </a>
              </li>
            </ul>
          </nav>
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
                <h1 class="m-0 text-dark">Empresas</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <!-- <li class="breadcrumb-item active"><a href="#">Empresas</a></li> -->
                  <li class="breadcrumb-item active">Empresas</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- /.content-header -->
        

        <script>
          const source = {
            accion : 'guardar',
            empresas : [],
          };

          $(document).ready(function(){
              cargar_lista();

            $("#btnRecargar").click(function(){
              cargar_lista();
            })

            $("#btnGuardarDatos").click(function(){
              let nombre = $("#txtNombre").val();
              let direccion = $("#txtDireccion").val();
              let giro = $("#txtGiro").val();
              let registro = $("#txtRegistro").val();
              let nit = $("#txtNit").val();
              let contribuyente = $("#txtContribuyente").val();
              let isss = $("#txtISSS").val();
              let afp = $("#txtAFP").val();

              if(nombre == "" || giro == "" || registro == "" || nit == "" || contribuyente == ""){
                alertify.error("DEBE COMPLETAR LOS CAMPOS OBLIGATORIOS *");
                return false;
              }

              $.ajax({
                url: 'app/request.php',
                type: 'post',
                dataType: 'json',
                data: {
                  class: 'empresas',
                  action: 'guardar_empresa',
                  nombre: nombre,
                  direccion: direccion,
                  giro: giro,
                  registro: registro,
                  nit: nit,
                  contribuyente: contribuyente,
                  isss: isss,
                  afp: afp,
                }
              }).done(function(data, textstatus, jqxhr){
                console.log(data);
                console.log(textstatus);
                console.log(jqxhr);
                if(data == 1){
                  alertify.success("SE HA AGREGADO LA EMPRESA");
                  limpiar_formulario_empresas();
                  volver_empresas();
                }
              });
            })

            $("#btnAgregarEmpresa").click(function(){
              $("#contenedorEmpresas").addClass("d-none");
              $("#formularioEmpresa").removeClass("d-none");
              source.accion = "guardar";
              $("#txtNombre").focus();
            })

            $("#btnVolver").click(function(){
              volver_empresas();
            })
          })

          function cargar_lista(){

            $.ajax({
              url: 'app/request.php',
              type: 'post',
              dataType: 'json',
              data: {class: 'empresas', action : 'cargar_empresas'},
              beforeSend : function(){
                $("#lista_empresas").html("<tr><td colspan='6' class='text-center py-3'>CARGANDO LISTA</td></tr>");
              },
            }).done(function(data,text,jqxhr){
              let e = $("#lista_empresas");
              let contador = 0;
              e.html("");
              $.each(data, function(index, val) {
                contador++;
                e.append("\
                  <tr>\
                    <td>"+contador+"</td>\
                    <td>"+val.nombre+"</td>\
                    <td>"+val.registro+"</td>\
                    <td>"+val.clientes+"</td>\
                    <td>"+val.proveedores+"</td>\
                    <td>\
                      <span id='btnEntrar_"+val.id+"' class='btn btn-primary btn-sm'>&nbsp;<span class='fa fa-chevron-right'></span>&nbsp;</span>\
                      <span class='btn btn-light btn-sm'>&nbsp;<span class='fa fa-trash'></span>&nbsp;</span>\
                      <span id='btnEditar' class='btn btn-light btn-sm'>&nbsp;<span class='fa fa-pencil'></span>&nbsp;</span>\
                    </td>\
                  </tr>\
                ");

                $("#btnEntrar_"+val.id).click(function(){
                  $.ajax({
                    url: 'app/request.php',
                    type: 'post',
                    dataType: 'json',
                    data: {class: 'empresas', action : 'crear_sesionEmpresa', id :val.id},
                  }).done(function(data, text, jqxhr){
                    if(data == 1){
                      location.href = "empresa/";
                    }
                  })
                })

              });
            });
          }
          function volver_empresas(){
            $("#contenedorEmpresas").removeClass("d-none");
            $("#formularioEmpresa").addClass("d-none");
          }
          function limpiar_formulario_empresas(){
            $("#txtNombre").val("");
            $("#txtDireccion").val("");
            $("#txtGiro").val("");
            $("#txtRegistro").val("");
            $("#txtNit").val("");
            $("#txtContribuyente").val("");
            $("#txtISSS").val("");
            $("#txtAFP").val("");
          }
        </script>

        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row">

              <div class="col-lg-12 col-sm-12" id='contenedorEmpresas'>
                <div class="card">
                  <div class="card-body">
                    <div class="col p-0 d-flex justify-content-end">
                      <div class="">
                        <button class='btn btn-dark' id='btnRecargar'>&nbsp;<span class='fa fa-refresh'></span>&nbsp;</button>
                        <button class='btn btn-primary' id='btnAgregarEmpresa'>NUEVA EMPRESA</button>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class='table table-striped table-hover table-sm border mt-3'>
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>NRC</th>
                            <th>CLIENTES</th>
                            <th>PROVEEDORES</th>
                            <th>OPCIONES</th>
                          </tr>
                        </thead>
                        <tbody id='lista_empresas'>
                          <tr>
                            <td colspan='6' class='text-center py-3'>LISTA DE EMPRESAS</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-8 col-sm-12 d-none" id='formularioEmpresa'>
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column mb-3">
                      <h5 class="card-title">DATOS DE EMPRESA</h5>
                      <small class='text-muted'>LOS CAMPOS MARCADOS CON * SON OBLIGATORIOS</small>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*EMPRESA: </label>
                      <div class="col-sm-9">
                        <input type="text" id='txtNombre' class='form-control' placeholder="NOMBRE DE LA EMPRESA">
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*GIRO: </label>
                      <div class="col-sm-9">
                        <input type="text" id='txtGiro' class='form-control' placeholder="GIRO DE LA EMPRESA">
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">DIRECCIÓN:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtDireccion' class='form-control' placeholder="DIRECCIÓN PRINCIPAL">
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*N. REGISTRO:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtRegistro' class='form-control' placeholder="NÚMERO DE REGISTRO">
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*N.I.T :</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtNit' class='form-control' placeholder="NÚMERO DE N.I.T">
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*CONTRIBUYENTE:</label>
                      <div class="col-sm-9">
                        <select autocomplete="off" id='txtContribuyente' class='form-control' id="">
                          <option value="1">PEQUEÑO</option>
                          <option value="2">MEDIANO</option>
                          <option value="3">GRANDE</option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">ISSS:</label>
                      <div class="col-sm-9">
                        <input type="text" id="txtISSS" class='form-control' placeholder="NÚMERO DE ISSS">
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">AFP:</label>
                      <div class="col-sm-9">
                        <input type="text" id="txtAFP" class='form-control' placeholder="NÚMERO DE AFP">
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

  <?php require 'app/template/footer.php'; ?>
