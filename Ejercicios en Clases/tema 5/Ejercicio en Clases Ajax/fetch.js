function cargarImagenes(abrir) {
	var contenedor;
	contenedor = document.getElementById('princip');
	fetch(abrir)
		.then(response => response.text())
		.then(data => contenedor.innerHTML=data);
}

function guardarFormulario() {
    var datos = new FormData(document.querySelector('#formulario'));

    fetch("create.php",
		{method:"POST",
		body:datos})
		.then(response => response.text())
		.then(data => document.querySelector("#princip").innerHTML=data);
        
        setTimeout(function() {
            cargarImagenes('galeria.php');
        }, 1000);
}

