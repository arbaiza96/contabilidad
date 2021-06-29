  <?php require '../app/template/header.php'; ?>
  <?php require 'menu/menu.php';?>
  
      <script type="text/javascript" src='js/clientes.js'></script>
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
                        <button class='btn btn-primary' id='btnAgregarCliente'>Nuevo cliente</button>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class='table table-striped table-hover table-sm border mt-3'>
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>DUI</th>
                            <th>N.I.T</th>
                            <th>Tipo</th>
                            <th>Opc.</th>
                          </tr>
                        </thead>
                        <tbody id='lista_clientes'>
                          <tr>
                            <td colspan='6' class='text-center py-3'>Lista de clientes</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-8 col-sm-12 d-none" id='formularioClientes'>
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column mb-3">
                      <h5 class="card-title">Datos de formulario</h5>
                      <small class='text-muted'>Los campos marcados con * son obligatorios</small>
                    </div>
                    <div class="col row d-flex justify-content-center align-items-center">
                      <div class="row">
                        <div class='px-4'>
                          <label for="rad_consumidor">Consumidor&nbsp;</label>
                          <input type="radio" name='tipo_cliente' id='rad_consumidor'>
                        </div>
                        <div class='px-4'>
                          <label for="rad_contribuyente">Contribuyente&nbsp;</label>
                          <input type="radio" name='tipo_cliente' id='rad_contribuyente'>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="mb-3 col row" consumidor contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Nombre: </label>
                      <div class="col-sm-9">
                        <input type="text" id='txtNombre' autocomplete="off" class='form-control' placeholder="Nombre completo de cliente">
                      </div>
                    </div>
                    <div class="mb-3 col row" consumidor contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*DUI: </label>
                      <div class="col-sm-9">
                        <input type="text" id='txtDUI' autocomplete="off" class='form-control' placeholder="Número de DUI">
                      </div>
                    </div>
                    <div class="mb-3 col row" consumidor contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">N.I.T:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtNIT' autocomplete="off" class='form-control' placeholder="Número de N.I.T">
                      </div>
                    </div>
                    <div class="mb-3 col row d-none" contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*N. Registro:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtRegistro' autocomplete="off" class='form-control' placeholder="Número de registro">
                      </div>
                    </div>
                    <div class="mb-3 col row d-none" contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Giro:</label>
                      <div class="col-sm-9">
                        <input type="text" id="txtGiro" autocomplete="off" class='form-control' placeholder="Giro del negocio">
                      </div>
                    </div>
                    <div class="mb-3 col row d-none" contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Contribuyente:</label>
                      <div class="col-sm-9">
                        <select autocomplete="off" id='txtContribuyente' class='form-control' id="">
                          <option value="1">Pequeño</option>
                          <option value="2">Mediano</option>
                          <option value="3">Grande</option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-3 col row" consumidor contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">Contacto:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtContacto' autocomplete="off" class='form-control' placeholder="Número telefónico de contácto">
                      </div>
                    </div>
                    <div class="mb-3 col row" consumidor contribuyente>
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">Correo:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtCorreo' autocomplete="off" class='form-control' placeholder="Dirección de correo electrónico">
                      </div>
                    </div>
                    <div class="col p-0">
                      <button class="btn btn-primary" id="btnGuardarDatos">Guardar datos</button>
                      <button class="btn btn-secondary" id='btnVolver'>Volver</button>
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
