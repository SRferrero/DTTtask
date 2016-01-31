function validacionVacio(e) {
	valor = e.value;

  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {	//que el valor no este vacio o sean espacios en blancos.
    //alert('[ERROR] El campo debe tener un valor.');
    showError('[ERROR] El campo debe tener un valor.');
    return false;
  }
  return true;
}

function validacionEmail(e) {
  valor = e.value;

  if ( !(/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/.test(valor))) {	//formato de email valido.
   //alert('[ERROR] El formato de email no es valido.');
    showError('[ERROR] El formato de email no es valido.');
    return false;
  }
  return true;
}

function validacionTamano(e) {
	valor = e.value;

   if (valor.length>15) {		//tamaño excesivamente grande.
    //alert('[ERROR] El campo es demasiado grande');
    showError('[ERROR] El campo es demasiado grande');
    return false;
  }
  return true;
}

function validacionPrecio() {
	valor = document.getElementById("campo").value;
  if (!(/^\d{1,6}$/.test(valor))) {		//precio tiene que ser numerico y menor o igual de 6 cifras.
    //alert('[ERROR] El campo tiene que ser numerico y menor de 7 digitos.');
    showError('[ERROR] El campo tiene que ser numerico y menor de 7 digitos.');
    return false;
  }
  return true;
}

function validacionContrasena(e) {
	valor = e.value;
  if (!(/^\d{8,2048}$/.test(valor))) {		//la contraseña tiene que ser numerica y mayor o igual de 8 cifras.
    //alert('[ERROR] El campo tiene que ser numerico y mayor de 8 digitos.');
    showError('[ERROR] El campo tiene que ser mayor de 8 digitos.');
    return false;
  }
  return true;
}
