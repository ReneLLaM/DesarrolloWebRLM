
function readUsuarios() {
    let contenedor = document.getElementById("contenido");
    fetch("readusuarios.php")
        .then((response) => response.json())
        .then((data) => {
            const objeto = data;
            contenedor.innerHTML = renderizarTablaUsuarios(objeto);
        });
}

function renderizarTablaUsuarios(objeto) {
    if(objeto.length == 0){
        return `<button class="agregar-usuario" onclick="javascript:formCrearUsuario()">Agregar Usuario</button>
        <p>Aun no hay usuarios</p>`;
    }
    let tabla = `<button class="agregar-usuario" onclick="javascript:formCrearUsuario()">Agregar Usuario</button>
    <table><tr><th>Nombre</th><th>Correo</th><th>Nivel</th><th>Activo</th><th>Acciones</th></tr>`;
    for (let i = 0; i < objeto.length; i++) {
        tabla += `<tr>
                    <td>${objeto[i].nombre_completo}</td>
                    <td>${objeto[i].correo}</td>
                    <td>${objeto[i].nivel == 1 ? 'Admin' : 'Usuario'}</td>
                    <td>${objeto[i].activo == 1 ? `<button onclick="javascript:activarSuspenderUsuario(${objeto[i].id})">Activo</button>` : `<button onclick="javascript:activarSuspenderUsuario(${objeto[i].id})">Inactivo</button>`}</td>
                    <td>
                        <button onclick="javascript:formEditUsuario(${objeto[i].id})">Editar</button>
                        <button onclick="javascript:deleteUsuario(${objeto[i].id})">Eliminar</button>
                    </td>
                </tr>`;
    }
    return tabla + "</table>";
}

function activarSuspenderUsuario(id) {
    fetch("activarSuspenderUsuario.php?id=" + id)
        .then((response) => response.text())
        .then((data) => {
            readUsuarios();
        });
}



var modal = document.getElementById("myModal");
var openModalBtn = document.getElementById("openModalBtn");
var closeBtn = document.getElementsByClassName("close")[0];

mostrar = function () {
    modal.style.display = "block";
    document.body.style.overflow = 'hidden';
};

function closeModal() {
    modal.style.display = "none";
    document.body.style.overflow = 'auto';
}

closeBtn.onclick = closeModal;
document.addEventListener('click', function(event) {
    if (event.target === modal) {
        closeModal();
    }
});
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && modal.style.display === 'block') {
        closeModal();
    }
});

function formEditUsuario(id) {
    fetch("formeditusuario.php?id=" + id)
        .then((response) => response.text())
        .then((data) => {
            document.getElementById("titulo-modal").innerHTML = "Editar Usuario";
            document.getElementById("contenido-modal").innerHTML = data;
            modal.style.display = "block";
        });
}
function editUsuario() {
    const formData = new FormData(document.getElementById('form-edit-usuario'));
    fetch("editusuario.php", {
        method: "POST",
        body: formData
    })
        .then((response) => response.text())
        .then(() => {
            readUsuarios();
            modal.style.display = "none";
        });
}


function deleteUsuario(id) {
    fetch("deleteusuario.php?id=" + id)
        .then(() => {
            readUsuarios();
        });
}

function formCrearUsuario() {
    fetch("formcrearusuario.php")
        .then((response) => response.text())
        .then((data) => {
            document.getElementById("titulo-modal").innerHTML = "Crear Usuario";
            document.getElementById("contenido-modal").innerHTML = data;
            modal.style.display = "block";
        });
}
function crearUsuario() {
    const formData = new FormData(document.getElementById('form-crear-usuario'));
    fetch("crearusuario.php", {
        method: "POST",
        body: formData
    })
        .then((response) => response.text())
        .then(() => {
            readUsuarios();
            modal.style.display = "none";
        });
}







function formEditPerfil(id) {
    fetch("formeditperfil.php?id=" + id)
        .then((response) => response.text())
        .then((data) => {
            document.getElementById("titulo-modal").innerHTML = "Editar Perfil";
            document.getElementById("contenido-modal").innerHTML = data;
            modal.style.display = "block";
        });
}
function editPerfil() {
    const formData = new FormData(document.querySelector('form'));
    fetch("editperfil.php", {
        method: "POST",
        body: formData
    })
        .then((response) => response.text())
        .then(() => {
            modal.style.display = "none";
            location.reload();
        });
}

// function formCrearUsuarioCliente() {
//     fetch("formcrearusuariocliente.php")
//         .then((response) => response.text())
//         .then((data) => {
//             document.getElementById("titulo-modal").innerHTML = "Iniciar Sesión";
//             document.getElementById("contenido-modal").innerHTML = data;
//             modal.style.display = "block";
//         });
// }
function crearUsuarioCliente() {
    const formData = new FormData(document.querySelector('form'));
    fetch("crearusuariocliente.php", {
        method: "POST",
        body: formData
    })
        .then((response) => response.text())
        .then(() => {
            modal.style.display = "none";
            
        });
    //abrir login en modal
    fetch("formlogin.html")
        .then((response) => response.text())
        .then((data) => {
            document.getElementById("titulo-modal").innerHTML = "Iniciar Sesión";
            document.getElementById("contenido-modal").innerHTML = data;
            modal.style.display = "block";
        });
}