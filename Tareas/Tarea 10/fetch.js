function cargarContenido(abrir) {
    var contenedor = document.getElementById('contenido');
    fetch(abrir)
        .then(response => response.text())
        .then(data => contenedor.innerHTML = data);
}

function crear() {
    var contenedor = document.getElementById('contenido');
    var datos = new FormData(document.getElementById('form-insertar'));
    fetch("create.php", {
        method: "POST",
        body: datos
    })
    .then(response => response.text())
    .then(data => contenedor.innerHTML = data);
}

function formEditar(id) {
    var contenedor = document.getElementById('contenido');
    fetch(`formeditar.php?id=${id}`)
        .then(response => response.text())
        .then(data => contenedor.innerHTML = data);
}

function editar() {
    var contenedor = document.getElementById('contenido');
    var datos = new FormData(document.getElementById('form-editar'));
    fetch("edit.php", {
        method: "POST",
        body: datos
    })
    .then(response => response.text())
    .then(data => contenedor.innerHTML = data);
}

function eliminar(id) {
    if (confirm("¿Estás seguro que quieres eliminar?")) {
        var contenedor = document.getElementById('contenido');
        fetch(`delete.php?id=${id}`)
            .then(response => response.text())
            .then(data => contenedor.innerHTML = data);
    }
}
