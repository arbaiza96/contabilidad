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

      <script type="text/javascript" src='js/venta_consumidores.js'></script>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Venta a consumidores</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active"><a href="../">Empresas</a></li>
                  <li class="breadcrumb-item active">Venta a consumidores</li>
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

              <div class="col-lg-12 col-sm-12" id='contenedor_compras'>
                <div class="card">
                  <div class="card-body">
                    <div class="col p-0 d-flex justify-content-end">
                      <div class="">
                        <button class='btn btn-dark' id='btnRecargar'>&nbsp;<span class='fa fa-refresh'></span>&nbsp;</button>
                        <button class='btn btn-primary' id='btnAgregarRegistro'>Nuevo registro</button>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class='table table-striped table-bordered table-hover table-sm border mt-3'>
                        <thead>
                          <tr>
                            <th rowspan='2'>#</th>
                            <th rowspan='2'>Fecha</th>
                            <th rowspan='2'>No doc.</th>
                            <th rowspan='2'>Nrc</th>
                            <th rowspan='2'><span>Nombre Prov. /</span><br><span>Tipo Doc.</span></th>
                            <th colspan='2'>Exentas</th>
                            <th colspan='2'>Gravadas</th>
                            <th rowspan='2'>Ccf</th>
                            <th rowspan='2'>Total compras</th>
                            <th rowspan='2'>Percep. Iva</th>
                            <th rowspan='2'>Reten. Iva</th>
                            <th rowspan='2'>Reten. Terceros</th>
                            <th rowspan='2' title='Sujetos excluidos'>Excluidos</th>
                            <th rowspan='2'>Opc.</th>
                          </tr>
                          <tr>
                            <th>Internas</th>
                            <th>Import</th>
                            <th>Internas</th>
                            <th>Import</th>
                          </tr>
                        </thead>
                        <tbody id='lista_compras'>
                          <tr>
                            <td colspan='16' class='text-center py-3'>Registro de compras</td>
                          </tr>
                        </tbody>
                      </table>
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
