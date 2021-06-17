$(document).ready(function(){
  cargar_listado_sucursales();
  $("#btnAgregarSucursal").click(function(){
    $("#contenedorSucursales").addClass('d-none');
    $("#formularioSucursales").removeClass('d-none');
  });
  $("#btnRecargar").click(function(){
    cargar_listado_sucursales();
  })
  $("#btnVolver").click(function(){
    volver_sucursales();
  });
  $("#btnGuardarDatos").click(function(){
    guardar_sucursal();
  });
});


function cargar_listado_sucursales(){
  $.ajax({
    url: '../app/request.php',
    type: 'post',
    dataType: 'json',
    data: {
      class: 'empresas',
      action: 'cargar_lista_sucursales',
    },
    beforeSend : function(){
      let e = $("#lista_sucursales");
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
    console.log(data);
    let e = $("#lista_sucursales");
    e.html("");
    if(data.length == 0){
      e.append("<tr><td colspan='6' class='text-center py-3'>No se han agregado registros</td></tr>");
      return false;
    }
    let contador = 0;
    $.each(data, function(index, val) {
      contador++;
      e.append("\
        <tr>\
          <td>"+contador+"</td>\
          <td>"+val.sucursal+"</td>\
          <td>\
            <span id='btnEditar_"+val.id+"' class='btn btn-light btn-sm'>&nbsp;<i class='fa fa-pencil'></i>&nbsp;</span>\
            <span id='btnEliminar_"+val.id+"' class='btn btn-light btn-sm'>&nbsp;<i class='fa fa-trash'></i>&nbsp;</span>\
          </td>\
        </tr>\
      ");
      $("#btnEditar_"+val.id).click(function(){
        console.log("editar sucursal");
      })
      $("#btnEliminar_"+val.id).click(function(){
        alertify.confirm("Se eliminará el registro del proveedor '"+val.nombre+"' ¿Desea proceder?", 
        function(){
          eliminar_sucursal(val.id);
        });
      })
    });
  }).fail(function(data, textstatus, jqxhr){
    console.log("algo ha salido mal >> " + textstatus);
  });
}

function eliminar_sucursal(id){
  $.ajax({
    url: '../app/request.php',
    type: 'post',
    dataType: 'json',
    data: {
      class: 'empresas',
      action: 'eliminar_sucursal',
      id: id,
    }
  }).done(function(data, textstatus, jqxhr){
    if(data == 1){
      alertify.success("Se ha eliminado la sucursal");
      cargar_listado_sucursales();
    }
  });
}

function guardar_sucursal(){
  let nombre = $("#txtNombre").val();

  if(nombre == ""){
    alertify.error("Debe completar los campos obligatorios *");
    return false;
  }

  $.ajax({
    url: '../app/request.php',
    type: 'post',
    dataType: 'json',
    data: {
      class: 'empresas',
      action: 'guardar_sucursal',
      nombre: nombre,
    }
  }).done(function(data, textstatus, jqxhr){
    if(data == 1){
      alertify.success("Se ha agregado la sucursal");
      cargar_listado_sucursales();
      limpiar_formulario_sucursales();
      volver_sucursales();
    }
  });
}

function limpiar_formulario_sucursales(){
  $("#txtNombre").val("");
}

function volver_sucursales(){
  $("#contenedorSucursales").removeClass('d-none');
  $("#formularioSucursales").addClass('d-none');
}