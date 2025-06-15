function readSucursales() {
    let contenedor = document.getElementById("contenido");
    fetch("readsucursales.php")
        .then((response) => response.json())
        .then((data) => {
            const objeto = data;
            contenedor.innerHTML = renderizarTablaSucursales(objeto);
        });
}

function renderizarTablaSucursales(objeto) {
    let tabla = `<button onclick="javascript:formCrearSucursal()">Agregar Sucursal</button>
    <table><tr><th>Nombre</th><th>Direccion</th><th>Ciudad</th><th>Telefono</th><th>Email</th><th>Activo</th><th>Acciones</th></tr>`;
    for (let i = 0; i < objeto.length; i++) {
        tabla += `<tr>
                    <td>${objeto[i].nombre}</td>
                    <td>${objeto[i].direccion}</td>
                    <td>${objeto[i].ciudad}</td>
                    <td>${objeto[i].telefono}</td>
                    <td>${objeto[i].email}</td>
                    <td>${objeto[i].activo == 1 ? `<button onclick="javascript:activarSuspenderSucursal(${objeto[i].id})">Activo</button>` : `<button onclick="javascript:activarSuspenderSucursal(${objeto[i].id})">Inactivo</button>`}</td>
                    <td>
                        <button onclick="javascript:formEditSucursal(${objeto[i].id})">Editar</button>
                        <button onclick="javascript:deleteSucursal(${objeto[i].id})">Eliminar</button>
                    </td>
                </tr>`;
    }
    return tabla + "</table>";
}

function activarSuspenderSucursal(id) {
    fetch("activarSuspenderSucursal.php?id=" + id)
        .then((response) => response.text())
        .then((data) => {
            readSucursales();
        });
}



var modal = document.getElementById("myModal");
var openModalBtn = document.getElementById("openModalBtn");
var closeBtn = document.getElementsByClassName("close")[0];

mostrar = function () {
    modal.style.display = "block";

};

closeBtn.onclick = function () {
    modal.style.display = "none";
};

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

function formEditSucursal(id) {
    fetch("formeditsucursal.php?id=" + id)
        .then((response) => response.text())
        .then((data) => {
            document.getElementById("titulo-modal").innerHTML = "Editar Sucursal";
            document.getElementById("contenido-modal").innerHTML = data;
            modal.style.display = "block";
        });
}
function editSucursal() {
    const formData = new FormData(document.querySelector('form'));
    fetch("editsucursal.php", {
        method: "POST",
        body: formData
    })
        .then((response) => response.text())
        .then(() => {
            readSucursales();
            modal.style.display = "none";
        });
}


function deleteSucursal(id) {
    fetch("deletesucursal.php?id=" + id)
        .then(() => {
            readSucursales();
        });
}

function formCrearSucursal() {
    fetch("formcrearsucursal.php")
        .then((response) => response.text())
        .then((data) => {
            document.getElementById("titulo-modal").innerHTML = "Crear Sucursal";
            document.getElementById("contenido-modal").innerHTML = data;
            modal.style.display = "block";
        });
}
function crearSucursal() {
    const formData = new FormData(document.querySelector('form'));
    fetch("crearsucursal.php", {
        method: "POST",
        body: formData
    })
        .then((response) => response.text())
        .then(() => {
            readSucursales();
            modal.style.display = "none";
        });
}
