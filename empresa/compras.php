  <?php require '../app/template/header.php'; ?>
  <?php require 'menu/menu.php';?>
  
  <style>
    .table_ td{
      /*border-top: none !important;*/
      border:1px solid #d4d4d4;
      padding:0 !important;
      text-align: center;
    }
    .table_ td[colspan]{
      background-color: #f4f4f4;
    }
    .table_ thead > tr > th{
      font-weight: lighter !important;
    }
    th{
      font-weight: 400 !important;
      font-size: 13pt !important;
    }
    .table_ td>input{
      border: none !important;
    }
    .table_ td>input:focus{
      border:1px solid #343a40 !important;
    }
    .table thead>tr>th{
      padding: 3px 0px 3px 5px !important ;
    }
    .table{
      font-size: 12pt !important;
    }
  </style>

  <?php 
    require '../app/class/principal.php';
    $i = new principal();
    $data_months = $i->number_months();
  ?>

  <script type="text/javascript" src="js/compras.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Libro de compras</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="../">Empresas</a></li>
              <li class="breadcrumb-item active">Compras</li>
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
                <div class="col p-0 d-flex justify-content-between">
                  <div class="col-md-2 d-flex justify-content-start align-items-center p-0">
                    <select  id="slcMes" class='form-control' title='El mes definido en este selector será el mes con el que se trabajarán los registros'>
                      <?php for ($i = 1; $i <= date('m') ; $i++) { ?>
                        <option value='<?=$i?>' <?= $i == date('m') ? 'SELECTED' : ''; ?> >
                          <?=$data_months[$i]?>
                        </option>
                      <?php } ?>
                    </select>
                    <!-- <button class="btn btn-primary d-flex align-items-center">
                      <span>Cambiar</span>&nbsp;&nbsp; 
                      <span class='fa fa-info'></span>&nbsp;
                    </button> -->
                  </div>
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
          <div class="col-lg-12 col-sm-12 d-none" id="formulario_compras">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div class='d-flex flex-column'>
                    <h5 class="card-title">Datos de formulario</h5>
                    <small class='text-muted'>Los campos marcados con * son obligatorios</small>
                  </div>
                  <div class='d-flex'>
                    <h2 id='textNumeroRegistro'>N° 1</h2>
                  </div>
                </div>

                <div class="mb-2 col row">
                  <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Comprador: </label>
                  <div class="col-sm-9">
                    <input type="text" id='' class='form-control' readonly value='<?=$nombre['nombre']?>' placeholder="COMPRADOR">
                  </div>
                </div>
                <div class="mb-2 col row">
                  <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Tipo: </label>
                  <div class="col-sm-9">
                    <select class='form-control' id="slcTipoDocumento">
                      <option class="d-none" value="">Seleccione</option>
                    </select>
                  </div>
                </div>
                <div class="mb-2 col row">
                  <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Fecha:</label>
                  <div class="col-sm-9">
                    <input type="date" id='txtFecha' autocomplete="off" class='form-control' placeholder="Fecha de comprobante">
                  </div>
                </div>
                <div class="mb-2 col row">
                  <label class="col-sm-3 text-right pr-4 col-form-label" for="">*N. Comprobante:</label>
                  <div class="col-sm-9">
                    <input type="text" id='txtNumero' autocomplete="off" class='form-control' placeholder="Número de comprobante">
                  </div>
                </div>
                <div class="mb-2 col row">
                  <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Proveedor:</label>
                  <div class="col-sm-9">
                    <input type="text" id="txtProveedor" autocomplete="off" class='form-control' placeholder="Escribe para buscar">
                  </div>
                  <div id="inputSearch"></div>
                </div>
                <div class="mb-2 col row">
                  <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Datos proveedor:</label>
                  <div class="col-sm-9 d-flex">
                    <input type="text" id="txtRegistro" autocomplete="off" class='form-control' readonly="" placeholder="NRC">
                    <input type="text" id="txtNIT" autocomplete="off" class='form-control' readonly="" placeholder="NIT">
                  </div>
                </div>
                <div class="mb-2 col row">
                  <label class="col-sm-3 text-right pr-4 col-form-label" for="">Resolución:</label>
                  <div class="col-sm-9">
                    <input type="text" id='txtResolucion' autocomplete="off" class='form-control' placeholder="Código de resolución">
                  </div>
                </div>
                <div class="mb-2 col row">
                  <label class="col-sm-3 text-right pr-4 col-form-label" for="">Serie:</label>
                  <div class="col-sm-9">
                    <input type="text" id='txtSerie' autocomplete="off" class='form-control' placeholder="Código de serie del documento">
                  </div>
                </div>
                <hr>
                <div class='col'>
                  <span>Detalles de factura</span>
                  <table class='table_ my-3'>
                    <tbody>
                      <tr>
                        <td colspan='2'>Exentas</td><td colspan='2'>Gravadas</td>
                      </tr>
                      <tr>
                        <td>Internas</td>
                        <td>Import</td>
                        <td>Internas</td>
                        <td>Import</td>
                        <td title='FOVIAL CONTRANS'>Fovial</td>
                        <td title='CRÉDITO FISCAL'>c.f</td>
                        <td>Total</td>
                        <td title='PERCEPCIÓN DE IVA'>Perc. Iva</td>
                        <td title='RETENCIÓN DE IVA'>Ret. Iva</td>
                        <td title='RETENCIÓN TERCEROS'>Ret. Ter.</td>
                        <td title='SUJETOS EXCLUIDOS'>Sujetos</td>
                      </tr>
                      <tr>
                        <td style='width:80px;'><input id='txt_ex_internas' type="text" autocomplete='off' class="form-control form-control-sm"></td>
                        <td style='width:80px;'><input id='txt_ex_import' type="text" autocomplete='off' class="form-control form-control-sm"></td>
                        <td style='width:80px;'><input id='txt_gr_internas' type="text" autocomplete='off' class="form-control form-control-sm"></td>
                        <td style='width:80px;'><input id='txt_gr_import' type="text" autocomplete='off' class="form-control form-control-sm"></td>
                        <td style='width:80px;'><input id='txt_fovial' type="text" autocomplete='off' class="form-control form-control-sm"></td>
                        <td style='width:80px;'><input id='txt_cf' type="text" autocomplete='off' class="form-control form-control-sm"></td>
                        <td style='width:80px;'><input id='txt_total' type="text" autocomplete='off' class="form-control form-control-sm"></td>
                        <td style='width:80px;'><input id='txt_per_iva' type="text" autocomplete='off' class="form-control form-control-sm"></td>
                        <td style='width:80px;'><input id='txt_ret_iva' type="text" autocomplete='off' class="form-control form-control-sm"></td>
                        <td style='width:80px;'><input id='txt_ret_ter' type="text" autocomplete='off' class="form-control form-control-sm"></td>
                        <td style='width:80px;'><input id='txt_sujetos' type="text" autocomplete='off' class="form-control form-control-sm"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <hr>
                <div class="mb-2 col row">
                  <label class="col-sm-3 text-right pr-4 col-form-label" for="">Clasificación:</label>
                  <div class="col-sm-9">
                    <select class='form-control' id="slcClasificacion">
                      <option class="d-none" value="">Seleccione</option>
                    </select>
                  </div>
                </div>
                <div class="mb-2 col row">
                  <label class="col-sm-3 text-right pr-4 col-form-label" for="">Descripción :</label>
                  <div class="col-sm-9">
                    <select class='form-control' id="slcClasificacionDetalle">
                      <option class="d-none" value="">Seleccione</option>
                    </select>
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

    <link rel="stylesheet" href="../plugins/jquery_ui/jquery_ui.min.css">
    <script src="../plugins/jquery_ui/jquery_ui.min.js" type="text/javascript"></script>

    <!-- /.content -->
  </div>

  <?php require '../app/template/footer.php'; ?>
