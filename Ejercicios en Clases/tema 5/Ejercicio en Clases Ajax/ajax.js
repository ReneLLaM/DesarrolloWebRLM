function cargarContenido(abrir) {
	var contenedor;
	contenedor = document.getElementById('men');
	var ajax = new XMLHttpRequest() //crea el objetov ajax 

    let mensaje = document.getElementById("mensaj");
	ajax.open("get", abrir, true);
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {
			contenedor.innerHTML = ajax.responseText
            mensaje.innerHTML = "<p>Nombre: Rene Llanos Machuca</p><p>Cu: 35-5051</p>";
            
		}
	}
	ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
	ajax.send();
}

function cargarFormulario(abrir) {
	var contenedor;
	contenedor = document.getElementById('princip');
	var ajax = new XMLHttpRequest(); //crea el objetov ajax 

	ajax.open("get", abrir, true);
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {
			contenedor.innerHTML = ajax.responseText;
			obtenerEditoriales();
            obtenerUsuarios();
            obtenerCarreras();
		}
	}
	ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
	ajax.send();
}




function obtenerEditoriales()
{
    var selectEditorial = document.querySelector('#editorial');
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "editoriales.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            
            selectEditorial.innerHTML = ajax.responseText;
        }
    }
    ajax.send();
}

function obtenerUsuarios()
{
    var selectUsuario = document.querySelector('#usuario');
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "usuarios.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            
            selectUsuario.innerHTML = ajax.responseText;
        }
    }
    ajax.send();
}

function obtenerCarreras()
{
    var selectCarrera = document.querySelector('#carrera');
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "carreras.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            
            
            selectCarrera.innerHTML = ajax.responseText;
        }
    }
    ajax.send();
}



