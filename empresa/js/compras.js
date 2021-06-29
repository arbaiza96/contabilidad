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
    guardar_compra(arr);
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
      $("#txtRegistro").val(ui.item.registro);
      $("#txtNIT").val(ui.item.nit);
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
    let e = $("#slcClasificacionDetalle"); e.html("<option value='' class='d-none'>Seleccione</option>");
    $.each(source.clas_detalle, function(index, val) {
      if(val.id_clasificacion == valor){
        e.append("<option value='"+val.id+"'>"+val.nombre+"</option>");
      }
    })
  })
})

function guardar_compra(arr){
  console.log(arr);
  $.ajax({
    url: '../app/request.php',
    type: 'post',
    dataType: 'json',
    data: {
      class: 'empresas',
      action: 'guardar_compra',
      data : arr,
    },
  }).done(function(data, textstatus, jqxhr){
    console.log(data);
  }).fail(function(data, textstatus, jqxhr){
    console.log(data);
  });
}

function numero_documento(){
  console.log("numero documendo");
}


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