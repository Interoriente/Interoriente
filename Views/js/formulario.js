function validar() {
	let id, contrasena,expresion,expresion1;
	id=document.getElementById("id").value;
	contrasena=document.getElementById("contrasena").value;

	expresion= /^\w+@\w+\.+[a-z]$/;
	expresion1=/^[0-9]+$/;

	if (id=="" || contrasena=="") {
		alert("Todos los campos son obligatorios.");
		return false;
	}else if (id.length>100) {
		alert("El correo o documento supera el límite establecido.");
		return false;
	}else if (!expresion.test(id) ||!expresion1.test(id)) {
		alert("El correo o documento no es válido.");
		return false;
	} else if (contrasena.length>20) {
		alert("La contraseña supera el límite establecido.");
		return false;
	}else if (isNaN(contrasena)) {
		alert("No tiene números.");
		return false;
	}
}