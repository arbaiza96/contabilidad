$(document).ready(function(){
  cargar_listado_proveedores();
  $("#btnAgregarProveedor").click(function(){
    $("#contenedorProveedores").addClass('d-none');
    $("#formularioProveedores").removeClass('d-none');
  });
  $("#btnRecargar").click(function(){
    cargar_listado_proveedores();
  })
  $("#btnVolver").click(function(){
    volver_proveedores();
  });
  $("#btnGuardarDatos").click(function(){
    guardar_proveedor();
  });
});


function cargar_listado_proveedores(){
  $.ajax({
    url: '../app/request.php',
    type: 'post',
    dataType: 'json',
    data: {
      class: 'empresas',
      action: 'cargar_lista_proveedores',
    },
    beforeSend : function(){
      let e = $("#lista_proveedores");
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
    let e = $("#lista_proveedores");
    e.html("");
    if(data.length == 0){
      e.append("<tr><td colspan='6' class='text-center py-3'>NO SE HAN AGREGADO REGISTROS</td></tr>");
      return false;
    }
    let contador = 0;
    $.each(data, function(index, val) {
      contador++;
      e.append("\
        <tr>\
          <td>"+contador+"</td>\
          <td>"+val.nombre+"</td>\
          <td>"+val.razon_social+"</td>\
          <td>"+val.nit+"</td>\
          <td>"+val.registro+"</td>\
          <td>\
            <span id='btnEditar_"+val.id+"' class='btn btn-light btn-sm'>&nbsp;<i class='fa fa-pencil'></i>&nbsp;</span>\
            <span id='btnEliminar_"+val.id+"' class='btn btn-light btn-sm'>&nbsp;<i class='fa fa-trash'></i>&nbsp;</span>\
          </td>\
        </tr>\
      ");
      $("#btnEditar_"+val.id).click(function(){
        console.log("editar proveedor");
      })
      $("#btnEliminar_"+val.id).click(function(){
        alertify.confirm("Se eliminará el registro del proveedor '"+val.nombre+"' ¿Desea proceder?", 
        function(){
          eliminar_proveedor(val.id);
        });
      })
    });
  }).fail(function(data, textstatus, jqxhr){
    console.log("algo ha salido mal >> " + textstatus);
  });
}

function eliminar_proveedor(id){
  $.ajax({
    url: '../app/request.php',
    type: 'post',
    dataType: 'json',
    data: {
      class: 'empresas',
      action: 'eliminar_proveedor',
      id: id,
    }
  }).done(function(data, textstatus, jqxhr){
    if(data == 1){
      alertify.success("Se ha eliminado el proveedor");
      cargar_listado_proveedores();
    }
  });
}

function validar_email(mail){
  if(mail=="") return true;
  exp =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  let res = exp.test(mail);
  return res;
}

function guardar_proveedor(){
  let nombre = $("#txtNombre").val();
  let razon = $("#txtRazon").val();
  let nit = $("#txtNIT").val();
  let registro = $("#txtRegistro").val();
  let plazo = $("#txtPlazo").val();
  let contribuyente = $("#txtContribuyente").val();
  let telefono = $("#txtTelefono").val();
  let direccion = $("#txtDireccion").val();


  if(nombre == "" || razon == "" || nit == "" || registro == "" || plazo == ""){
    alertify.error("DEBE COMPLETAR LOS CAMPOS OBLIGATORIOS *");
    return false;
  }

  let expnit = /^[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}$/;
  nitval = expnit.test(nit);

  let expreg = /^[0-9]{1,10}-[0-9]{1,5}$/;
  regval = expreg.test(registro);

  console.log("nitval >> " + nitval);
  console.log("regval >> " + regval);

  // return false;

  $.ajax({
    url: '../app/request.php',
    type: 'post',
    dataType: 'json',
    data: {
      class: 'empresas',
      action: 'guardar_proveedor',
      nombre: nombre,
      razon: razon,
      nit: nit,
      registro: registro,
      plazo: plazo,
      contribuyente: contribuyente,
      telefono: telefono,
      direccion: direccion,
    }
  }).done(function(data, textstatus, jqxhr){
    if(data == 1){
      alertify.success("SE HA AGREGADO EL PROVEEDOR");
      cargar_listado_proveedores();
      limpiar_formulario_proveedores();
      volver_proveedores();
    }
  });
}

function limpiar_formulario_proveedores(){
  $("#txtNombre").val("");
  $("#txtRazon").val("");
  $("#txtNIT").val("");
  $("#txtRegistro").val("");
  $("#txtPlazo").val("");
  $("#txtContribuyente").val("");
  $("#txtContacto").val("");
  $("#txtDireccion").val("");
}

function volver_proveedores(){
  $("#contenedorProveedores").removeClass('d-none');
  $("#formularioProveedores").addClass('d-none');
}