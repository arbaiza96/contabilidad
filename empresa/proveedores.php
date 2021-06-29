  <?php require '../app/template/header.php'; ?>
  <?php require 'menu/menu.php';?>
  
      <script type="text/javascript" src='js/proveedores.js'></script>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Proveedores</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active"><a href="../">Empresas</a></li>
                  <li class="breadcrumb-item active">Proveedores</li>
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

              <div class="col-lg-12 col-sm-12" id='contenedorProveedores'>
                <div class="card">
                  <div class="card-body">
                    <div class="col p-0 d-flex justify-content-end">
                      <div class="">
                        <button class='btn btn-dark' id='btnRecargar'>&nbsp;<span class='fa fa-refresh'></span>&nbsp;</button>
                        <button class='btn btn-primary' id='btnAgregarProveedor'>Nuevo proveedor</button>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class='table table-striped table-hover table-sm border mt-3'>
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Razon</th>
                            <th>N.I.T</th>
                            <th>Registro</th>
                            <th>Opc.</th>
                          </tr>
                        </thead>
                        <tbody id='lista_proveedores'>
                          <tr>
                            <td colspan='6' class='text-center py-3'>Lista de proveedores</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-8 col-sm-12 d-none" id='formularioProveedores'>
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column mb-3">
                      <h5 class="card-title">Datos de formulario</h5>
                      <small class='text-muted'>Los campos marcados con * son obligatorios</small>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Nombre: </label>
                      <div class="col-sm-9">
                        <input type="text" id='txtNombre' autocomplete="off" class='form-control' placeholder="Nombre de proveedor">
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Razon social: </label>
                      <div class="col-sm-9">
                        <input type="text" id='txtRazon' autocomplete="off" class='form-control' placeholder="Razon social o giro del negocio">
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*N.I.T:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtNIT' autocomplete="off" class='form-control' placeholder="Número de N.I.T">
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*N. Registro:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtRegistro' autocomplete="off" class='form-control' placeholder="Número de registro">
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Plazo:</label>
                      <div class="col-sm-9">
                        <select class='form-control' id="txtPlazo">
                          <option value="30">30</option>
                          <option value="60">60</option>
                          <option value="90">90</option>
                          <option value="120">120</option>
                          <option value="150">150</option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Contribuyente:</label>
                      <div class="col-sm-9">
                        <select autocomplete="off" id='txtContribuyente' class='form-control' id="">
                          <option value="1">Pequeño</option>
                          <option value="2">Mediano</option>
                          <option value="3">Grande</option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">Contacto:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtTelefono' autocomplete="off" class='form-control' placeholder="Ej. 2663-5621, 26635621">
                      </div>
                    </div>
                    <div class="mb-3 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">Dirección:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtDireccion' autocomplete="off" class='form-control' placeholder="Dirección de calle de la empresa">
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
