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
          font-size: 11pt !important;
        }
      </style>

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
                    <div class="col p-0 d-flex justify-content-end">
                      <div class="">
                        <button class='btn btn-dark' id='btnRecargar'>&nbsp;<span class='fa fa-refresh'></span>&nbsp;</button>
                        <button class='btn btn-primary' id='btnAgregarRegistro'>NUEVO REGISTRO</button>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class='table table-striped table-bordered table-hover table-sm border mt-3'>
                        <thead>
                          <tr>
                            <th rowspan='2'>#</th>
                            <th rowspan='2'>FECHA</th>
                            <th rowspan='2'>NO DOC.</th>
                            <th rowspan='2'>NRC</th>
                            <th rowspan='2'><span>NOMBRE PROVEEDOR /</span><br><span>TIPO DE DOCUMENTO</span></th>
                            <th colspan='2'>EXENTAS</th>
                            <th colspan='2'>GRAVADAS</th>
                            <th rowspan='2'>CCF</th>
                            <th rowspan='2'>TOTAL COMPRAS</th>
                            <th rowspan='2'>PERCEP. IVA</th>
                            <th rowspan='2'>RETEN. IVA</th>
                            <th rowspan='2'>RETEN. TERCEROS</th>
                            <th rowspan='2' title='SUJETOS EXCLUIDOS'>EXCLUIDOS</th>
                            <th rowspan='2'>OPC</th>
                          </tr>
                          <tr>
                            <th>INTERNAS</th>
                            <th>IMPORT</th>
                            <th>INTERNAS</th>
                            <th>IMPORT</th>
                          </tr>
                        </thead>
                        <tbody id='lista_compras'>
                          <tr>
                            <td colspan='16' class='text-center py-3'>REGISTROS DE COMPRAS</td>
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
                        <h5 class="card-title">DATOS DE REGISTRO</h5>
                        <small class='text-muted'>Los campos marcados con * son obligatorios</small>
                      </div>
                      <div class='d-flex'>
                        <h2 id='textNumeroRegistro'>N° 1</h2>
                      </div>
                    </div>

                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*COMPRADOR: </label>
                      <div class="col-sm-9">
                        <input type="text" id='' class='form-control' readonly value='<?=$nombre['nombre']?>' placeholder="COMPRADOR">
                      </div>
                    </div>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*TIPO: </label>
                      <div class="col-sm-9">
                        <select class='form-control' id="slcTipoDocumento">
                          <option class="d-none" value="">SELECCIONE</option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*FECHA:</label>
                      <div class="col-sm-9">
                        <input type="date" id='' autocomplete="off" class='form-control' placeholder="FECHA DE COMPROBANTE">
                      </div>
                    </div>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*N. COMPROBANTE:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtNumero' autocomplete="off" class='form-control' placeholder="NÚMERO DE COMPROBANTE">
                      </div>
                    </div>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*PROVEEDOR:</label>
                      <div class="col-sm-9">
                        <input type="text" id="txtProveedor" autocomplete="off" class='form-control' placeholder="ESCRIBE PARA BUSCAR">
                      </div>
                      <div id="inputSearch"></div>
                    </div>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*DATOS PROVEEDOR:</label>
                      <div class="col-sm-9 d-flex">
                        <input type="text" id="txtRegistro" autocomplete="off" class='form-control' readonly="" placeholder="NRC">
                        <input type="text" id="txtNIT" autocomplete="off" class='form-control' readonly="" placeholder="NIT">
                      </div>
                    </div>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">RESOLUCIÓN:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtContacto' autocomplete="off" class='form-control' placeholder="NÚMERO DE RESOLUCIÓN">
                      </div>
                    </div>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">SERIE:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtCorreo' autocomplete="off" class='form-control' placeholder="NÚMERO DE SERIE DE DOCUMENTO">
                      </div>
                    </div>
                    <hr>
                    <div class='col'>
                      <span>DETALLES DE FACTURA</span>
                      <table class='table_ my-3'>
                        <tbody>
                          <tr>
                            <td colspan='2'>EXENTAS</td><td colspan='2'>GRAVADAS</td>
                          </tr>
                          <tr>
                            <td>INTERNAS</td>
                            <td>IMPORT</td>
                            <td>INTERNAS</td>
                            <td>IMPORT</td>
                            <td title='FOVIAL CONTRANS'>FOVIAL</td>
                            <td title='CRÉDITO FISCAL'>C.F</td>
                            <td>TOTAL</td>
                            <td title='PERCEPCIÓN DE IVA'>PERC. IVA</td>
                            <td title='RETENCIÓN DE IVA'>RET. IVA</td>
                            <td title='RETENCIÓN TERCEROS'>RET. TER.</td>
                            <td title='SUJETOS EXCLUIDOS'>SUJETOS</td>
                          </tr>
                          <tr>
                            <td style='width:80px;'><input type="text" id='' autocomplete='off' class="form-control form-control-sm"></td>
                            <td style='width:80px;'><input type="text" id='' autocomplete='off' class="form-control form-control-sm"></td>
                            <td style='width:80px;'><input type="text" id='' autocomplete='off' class="form-control form-control-sm"></td>
                            <td style='width:80px;'><input type="text" id='' autocomplete='off' class="form-control form-control-sm"></td>
                            <td style='width:80px;'><input type="text" id='' autocomplete='off' class="form-control form-control-sm"></td>
                            <td style='width:80px;'><input type="text" id='' autocomplete='off' class="form-control form-control-sm"></td>
                            <td style='width:80px;'><input type="text" id='' autocomplete='off' class="form-control form-control-sm"></td>
                            <td style='width:80px;'><input type="text" id='' autocomplete='off' class="form-control form-control-sm"></td>
                            <td style='width:80px;'><input type="text" id='' autocomplete='off' class="form-control form-control-sm"></td>
                            <td style='width:80px;'><input type="text" id='' autocomplete='off' class="form-control form-control-sm"></td>
                            <td style='width:80px;'><input type="text" id='' autocomplete='off' class="form-control form-control-sm"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <hr>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">CLASIFICACIÓN:</label>
                      <div class="col-sm-9">
                        <select class='form-control' id="slcClasificacion">
                          <option class="d-none" value="">SELECCIONE</option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">DESCRIPCIÓN :</label>
                      <div class="col-sm-9">
                        <select class='form-control' id="slcClasificacionDetalle">
                          <option class="d-none" value="">SELECCIONE</option>
                        </select>
                      </div>
                    </div>

                    <div class="col p-0">
                      <button class="btn btn-primary" id="btnGuardarDatos">GUARDAR DATOS</button>
                      <button class="btn btn-secondary" id='btnVolver'>VOLVER</button>
                    </div>

                  </div>
                </div>
              </div>

              <script>
                const source = {
                  tipo : [],
                  clas : [],
                  clas_detalle : []
                }
                $(document).ready(function(){
                  cargar_datos();

                $("#txtProveedor").autocomplete({
                  source: "../app/request.php?class=empresas&action=proveedor_autocomplete&id="+idempresa_,
                  minLength: 2,
                  appendTo: "#inputSearch",
                  search: function( event, ui ) {
                    // esto pasa mientras busca el dato
                  },
                  response: function( event, ui ) {
                    // esto pasa cuando ya encontró el dato
                  },
                  select: function(event, ui) {
                    // esto pasa cuando se selecciona el dato
                    // ui.item.codigo
                    // console.log(ui.item);
                    $("#txtRegistro").val(ui.item.registro);
                    $("#txtNIT").val(ui.item.nit);
                    // window.onbeforeunload = function() {return "no podes recargar";};
                    // $(this).val("");
                    // $("#txtBuscarProducto").val("");
                    // return false;
                  }
                })

                  $("#btnAgregarRegistro").click(function(){
                    $("#contenedor_compras").addClass("d-none");
                    $("#formulario_compras").removeClass("d-none");
                  })
                  $("#btnVolver").click(function(){
                    $("#contenedor_compras").removeClass("d-none");
                    $("#formulario_compras").addClass("d-none");
                  })

                  $("#slcClasificacion").on('change',function(){
                    let valor = $(this).val();
                    // if(valor == "") return false;
                    console.log(valor);
                    let e = $("#slcClasificacionDetalle"); e.html("<option value='' class='d-none'>SELECCIONE</option>");
                    $.each(source.clas_detalle, function(index, val) {
                      console.log(val.id_clasificacion + " - " + valor);
                      if(val.id_clasificacion == valor){
                        e.append("<option value='"+val.id+"'>"+val.nombre+"</option>");
                      }
                    })
                  })
                })

                function cargar_datos(){
                  $.ajax({
                    url: '../app/request.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      class: 'empresas',
                      action: 'cargar_datos_registro_compra',
                    },
                  }).done(function(data, textstatus, jqxhr){
                    source.tipo = data.tipo_documento;
                    source.clas = data.clasificacion;
                    source.clas_detalle = data.clasificacion_detallle;

                    let e = $("#slcTipoDocumento"); e.html("<option value='' class='d-none'>SELECCIONE</option>");
                    $.each(source.tipo, function(index, val) {
                       e.append("<option value='"+val.id+"'>"+val.tipo+"</option>");
                    });
                    let f = $("#slcClasificacion"); f.html("<option value='' class='d-none'>SELECCIONE</option>");
                    $.each(source.clas, function(index, val) {
                       f.append("<option value='"+val.id+"'>"+val.clasificacion+"</option>");
                    });
                  }).fail(function(data, textstatus, jqxhr){

                  });
                }

              </script>

            </div>
          </div>
        </div>

        <link rel="stylesheet" href="../plugins/jquery_ui/jquery_ui.min.css">
        <script src="../plugins/jquery_ui/jquery_ui.min.js" type="text/javascript"></script>

        <!-- /.content -->
      </div>

  <?php require '../app/template/footer.php'; ?>
