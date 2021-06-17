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
    e.append("<tr><td colspan='6' class='text-center py-3'>No se han agregado registros</td></tr>");
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
    alertify.success("Se ha eliminado el cliente");
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
  alertify.error("Debe completar todos los campos obligatorios *");
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
    alertify.success("Se han guardado los datos");
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