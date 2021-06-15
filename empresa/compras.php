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
                        <input type="date" id='txtFecha' autocomplete="off" class='form-control' placeholder="FECHA DE COMPROBANTE">
                      </div>
                    </div>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*N. Comprobante:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtNumero' autocomplete="off" class='form-control' placeholder="NÚMERO DE COMPROBANTE">
                      </div>
                    </div>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">*Proveedor:</label>
                      <div class="col-sm-9">
                        <input type="text" id="txtProveedor" autocomplete="off" class='form-control' placeholder="ESCRIBE PARA BUSCAR">
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
                        <input type="text" id='txtResolucion' autocomplete="off" class='form-control' placeholder="NÚMERO DE RESOLUCIÓN">
                      </div>
                    </div>
                    <div class="mb-2 col row">
                      <label class="col-sm-3 text-right pr-4 col-form-label" for="">Serie:</label>
                      <div class="col-sm-9">
                        <input type="text" id='txtSerie' autocomplete="off" class='form-control' placeholder="NÚMERO DE SERIE DE DOCUMENTO">
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

              <script>
                const source = {
                  tipo : [],
                  clas : [],
                  clas_detalle : []
                }
                $(document).ready(function(){
                  cargar_datos();

                  $("#txt_ex_internas").change(()=>{calcular_total();});
                  $("#txt_ex_import").change(()=>{calcular_total();});
                  $("#txt_gr_internas").change(()=>{calcular_total();});
                  $("#txt_gr_import").change(()=>{calcular_total();});
                  $("#txt_fovial").change(()=>{calcular_total();});
                  $("#txt_cf").change(()=>{calcular_total();});
                  $("#txt_total").change(()=>{calcular_total();});
                  $("#txt_per_iva").change(()=>{calcular_total();});
                  $("#txt_ret_iva").change(()=>{calcular_total();});
                  $("#txt_ret_ter").change(()=>{calcular_total();});
                  $("#txt_sujetos").change(()=>{calcular_total();});

                  $("#btnGuardarDatos").click(function(){
                    let ex_internas = ($("#txt_ex_internas").val()*1);
                    let ex_import = ($("#txt_ex_import").val()*1);
                    let gr_internas = ($("#txt_gr_internas").val()*1);
                    let gr_import = ($("#txt_gr_import").val()*1);
                    let fovial = ($("#txt_fovial").val()*1);
                    let per_iva = ($("#txt_per_iva").val()*1);
                    let ret_iva = ($("#txt_ret_iva").val()*1);
                    let ret_ter = ($("#txt_ret_ter").val()*1);
                    let sujetos = ($("#txt_sujetos").val()*1);
                    let cf = $("#txt_cf").val();
                    let total = $("#txt_total").val();

                    let tipo_documento = $("#slcTipoDocumento").val();
                    let fecha = $("#txtFecha").val();
                    let numero = $("#txtNumero").val();
                    let id_proveedor = $("#txtProveedor").val();
                    let registro = $("#txtRegistro").val();
                    let nit = $("#txtNIT").val();
                    let resolucion = $("#txtResolucion").val();
                    let serie = $("#txtSerie").val();
                    let clasificacion = $("#slcClasificacion").val();
                    let clasificacion_detalle = $("#slcClasificacionDetalle").val();

                    let arr = {
                      id_empresa : idempresa_,
                      ex_internas : ex_internas,
                      ex_import : ex_import,
                      gr_internas : gr_internas,
                      gr_import : gr_import,
                      fovial : fovial,
                      per_iva : per_iva,
                      ret_iva : ret_iva,
                      ret_ter : ret_ter,
                      sujetos : sujetos,
                      cf : cf,
                      total : total,
                      tipo_documento : tipo_documento,
                      fecha : fecha,
                      numero : numero,
                      id_proveedor : id_proveedor,
                      registro : registro,
                      nit : nit,
                      resolucion : resolucion,
                      serie : serie,
                      clasificacion : clasificacion,
                      clasificacion_detalle : clasificacion_detalle,
                    }

                    console.log(arr);

                    if(tipo_documento == ""){
                      alertify.error("Debes llenar los campos obligatorios");
                      return false;
                    }

                  })

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
                    let e = $("#slcClasificacionDetalle"); e.html("<option value='' class='d-none'>Seleccione</option>");
                    $.each(source.clas_detalle, function(index, val) {
                      console.log(val.id_clasificacion + " - " + valor);
                      if(val.id_clasificacion == valor){
                        e.append("<option value='"+val.id+"'>"+val.nombre+"</option>");
                      }
                    })
                  })
                })

                function calcular_total(){
                  let ex_internas = ($("#txt_ex_internas").val()*1);
                  let ex_import = ($("#txt_ex_import").val()*1);
                  let gr_internas = ($("#txt_gr_internas").val()*1);
                  let gr_import = ($("#txt_gr_import").val()*1);
                  let fovial = ($("#txt_fovial").val()*1);
                  let per_iva = ($("#txt_per_iva").val()*1);
                  let ret_iva = ($("#txt_ret_iva").val()*1);
                  let ret_ter = ($("#txt_ret_ter").val()*1);
                  let sujetos = ($("#txt_sujetos").val()*1);
                  let cf = $("#txt_cf").val();
                  let total = $("#txt_total").val();

                  let cf_final = (((gr_internas*1.13)-gr_internas)+((gr_import*1.13)-gr_import));
                  let total_final = ((ex_internas+ex_import+gr_internas+gr_import+fovial+cf_final+per_iva+sujetos)-ret_iva);

                  $("#txt_cf").val(truncar(cf_final));
                  $("#txt_total").val(truncar(total_final));
                }

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

                    let e = $("#slcTipoDocumento"); e.html("<option value='' class='d-none'>Seleccione</option>");
                    $.each(source.tipo, function(index, val) {
                       e.append("<option value='"+val.id+"'>"+val.tipo+"</option>");
                    });
                    let f = $("#slcClasificacion"); f.html("<option value='' class='d-none'>Seleccione</option>");
                    $.each(source.clas, function(index, val) {
                       f.append("<option value='"+val.id+"'>"+val.clasificacion+"</option>");
                    });
                  }).fail(function(data, textstatus, jqxhr){

                  });
                }

                function truncar(valor, numeros = 2){
                  let str = valor.toString()
                  let cadena = str.split(".", 2);
                  if(cadena.length == 1){
                    return Number(valor);
                  }else{
                    let decimales = cadena[1].substr(0,numeros);
                    return Number(cadena[0]+"."+decimales);
                  }
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
