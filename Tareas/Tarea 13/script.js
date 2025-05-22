var asente = "asc";
// Variable para mantener el estado de ordenamiento
var ordenActual = {
    columna: 'personas.id',
    direccion: 'asc'
};

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

function cargarContenido(abrir) {
  var contenedor;
  contenedor = document.getElementById("contenido");
  fetch(abrir)
    .then((response) => response.text())
    .then((data) => (contenedor.innerHTML = data));
}

function formInsertar() {
  var contenedor = document.getElementById("contenido");
  fetch("forminsertar.php")
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Insertar"
      document.querySelector("#contenido-modal").innerHTML = data
      mostrar();

    });
}

function crearPersona() {
  var datos = new FormData(document.querySelector("#form-crear"));

  fetch("create.php", { method: "POST", body: datos })
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Mensaje"
      document.querySelector("#contenido-modal").innerHTML = data
      mostrar();
      setTimeout(() => {
        modal.style.display = "none";
        listar();
      }, 2000);
    });
}

function cargarPagina(pagina, buscar, orden, ascendente) {
  var url = `read.php?pagina=${pagina}&buscar=${buscar}&orden=${orden}&asendente=${ascendente}`;
  var contenedor = document.getElementById("contenido");
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      try {
        const objeto = JSON.parse(data);
        contenedor.innerHTML = renderizarTablaRead(objeto);
      } catch (e) {
        console.error('Error al procesar la respuesta:', e);
        contenedor.innerHTML = data;
      }
    });
}

function editar(id) {
  var url = `formeditar.php?id=${id}`;
  var contenedor = document.getElementById("contenido");
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Editar"
      document.querySelector("#contenido-modal").innerHTML = data
      document.getElementById("myModal").style.display = "block";
    });
}

function guardarEditar() {
  var datos = new FormData(document.querySelector("#form-edit"));

  fetch("edit.php", { method: "POST", body: datos })
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#titulo-modal").innerHTML = "Mensaje"
      document.querySelector("#contenido-modal").innerHTML = data
    
        mostrar();
        setTimeout(() => {
          modal.style.display = "none";
          listar();
        }, 2000);
      }
    
    );
}

function eliminar(id) {
  // Guardamos el ID para usarlo en la confirmación
  window.deleteId = id;
  document.querySelector("#titulo-modal").innerHTML = "Confirmar eliminación";
  document.querySelector("#contenido-modal").innerHTML = `
    <div class="card">
      <div class="card-header bg-danger text-white py-2">
        <h5 class="card-title mb-0 text-center">Confirmar eliminación</h5>
      </div>
      <div class="card-body py-2 px-3">
        <p class="text-center mb-3">¿Estás seguro que quieres eliminar este registro?</p>
        <div class="text-center">
          <button onclick="confirmarEliminacion()" class="btn btn-danger btn-sm px-4 me-2">Eliminar</button>
          <button onclick="cancelarEliminacion()" class="btn btn-secondary btn-sm px-4">Cancelar</button>
        </div>
      </div>
    </div>
  `;
  modal.style.display = "block";
}

function confirmarEliminacion() {
  var url = `delete.php?id=${window.deleteId}`;
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      document.querySelector("#contenido-modal").innerHTML = `
        <div class="card">
          <div class="card-body py-2 px-3">
            <p class="text-center mb-0">${data}</p>
          </div>
        </div>
      `;
      setTimeout(() => {
        modal.style.display = "none";
        listar();
        // Limpiamos el ID guardado
        delete window.deleteId;
      }, 2000);
    });
}

function cancelarEliminacion() {
  modal.style.display = "none";
}

function listar() {
  var contenedor;
  contenedor = document.getElementById("contenido");
  fetch("read.php")
    .then((response) => response.text())
    .then((data) => {
      try {
        const objeto = JSON.parse(data);
        contenedor.innerHTML = renderizarTablaRead(objeto);
      } catch (e) {
        console.error('Error al procesar la respuesta:', e);
        contenedor.innerHTML = data;
      }
    });
}

function renderizarTablaRead(objeto) {
  let lista = objeto.datos;
  let buscar = objeto.buscar;
  let pagina = objeto.pagina;
  let orden = objeto.orden;
  let nivel = objeto.nivel;
  let nropaginas = objeto.nropaginas;

  let html = '';
  
  if(nivel == 1) {
    html += '<a class="btn btn-primary" href="javaScript:formInsertar()"> Insertar</a>';
  }
  
  html += `<div class="table-responsive">
    <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Fotografia</th>
        <th><a href="javascript:ordenar('nombres')">Nombres</a></th>
        <th><a href="javascript:ordenar('apellidos')">Apellidos</a></th>
        <th><a href="javascript:ordenar('fecha_nacimiento')">Fec.Nacimiento</a></th>
        <th><a href="javascript:ordenar('sexo')">Sexo</a></th>
        <th><a href="javascript:ordenar('correo')">Correo</a></th>
        <th><a href="javascript:ordenar('profesion')">Profesion</a></th>
        ${nivel == 1 ? '<th>Operaciones</th>' : ''}
      </tr>
    </thead>`;

  for (var i = 0; i < lista.length; i++) {
    html += `<tr>
      <td class="text-center align-middle">
        <img src="images/${lista[i].fotografia}" class="img-thumbnail rounded" style="width: 60px; height: 60px; object-fit: cover;">
      </td>
      <td>${lista[i].nombres}</td>
      <td>${lista[i].apellidos}</td>
      <td>${lista[i].fecha_nacimiento}</td>
      <td>${lista[i].sexo}</td>
      <td>${lista[i].correo}</td>
      <td>${lista[i].profesion}</td>`;
    
    if(nivel == 1) {
      html += `<td>
        <div class="d-grid gap-2 d-md-block">
          <a class="btn btn-primary btn-sm" href="javascript:editar(${lista[i].id})">Editar</a>
          <a class="btn btn-danger btn-sm" href="javascript:eliminar(${lista[i].id})">Eliminar</a>
        </div>
      </td>`;
    }
    
    html += '</tr>';
  }
  html += "</table></div>";

  if(nropaginas > 1) {
    html += '<ul class="pagination" style="display: flex; list-style: none; gap: 5px">';
    
    if(pagina > 1) {
      html += `<li class="page-item" style="margin:5px"><a class="page-link" href="javascript:cargarPagina(1,'${buscar}','${orden}','${asente}')">&lt;&lt;</a></li>
               <li class="page-item" style="margin:5px"><a class="page-link" href="javascript:cargarPagina(${pagina-1},'${buscar}','${orden}','${asente}')">&lt;</a></li>`;
    }

    for (let i = Math.max(1, pagina-2); i <= Math.min(nropaginas, pagina+2); i++) {
      html += `<li class="page-item" style="margin:5px"><a class="page-link" href="javascript:cargarPagina(${i},'${buscar}','${orden}','${asente}')" 
               ${i === pagina ? 'style="font-weight:bold"' : ''}>${i}</a></li>`;
    }

    if(pagina < nropaginas) {
      html += `<li class="page-item" style="margin:5px"><a class="page-link" href="javascript:cargarPagina(${pagina+1},'${buscar}','${orden}','${asente}')">&gt;</a></li>
               <li class="page-item" style="margin:5px"><a class="page-link" href="javascript:cargarPagina(${nropaginas},'${buscar}','${orden}','${asente}')">&gt;&gt;</a></li>`;
    }
    
    html += '</ul>';
  }

  return html;
}

function ordenar(columna) {
    if (ordenActual.columna === columna) {
        asente = asente === 'asc' ? 'desc' : 'asc';
    } else {
        ordenActual.columna = columna;
        asente = 'asc';
    }
    
    cargarPagina(1, document.getElementById('buscar')?.value || '', columna, asente);
}

// Funciones para profesiones
function formInsertarProfesion() {
    fetch('forminsertarprofesiones.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('titulo-modal').innerHTML = 'Nueva Profesión';
            document.getElementById('contenido-modal').innerHTML = data;
            modal.style.display = 'block';
        });
}

function editarProfesion(id) {
    fetch('formeditarprofesion.php?id=' + id)
        .then(response => response.text())
        .then(data => {
            document.getElementById('titulo-modal').innerHTML = 'Editar Profesión';
            document.getElementById('contenido-modal').innerHTML = data;
            modal.style.display = 'block';
        });
}

function eliminarProfesion(id) {
    document.getElementById('titulo-modal').innerHTML = 'Eliminar Profesión';
    document.getElementById('contenido-modal').innerHTML = `
        <p>¿Está seguro de que desea eliminar esta profesión?</p>
        <div class="form-buttons">
            <button onclick="confirmarEliminarProfesion(${id})" class="btn-eliminar">Sí, eliminar</button>
            <button onclick="modal.style.display='none'" class="btn-cancelar">Cancelar</button>
        </div>
    `;
    modal.style.display = 'block';
}

function confirmarEliminarProfesion(id) {
    fetch('deleteprofesiones.php?id=' + id)
        .then(response => response.text())
        .then(data => {
            document.getElementById('contenido-modal').innerHTML = data;
            setTimeout(() => {
                modal.style.display = 'none';
                cargarContenido('readprofesiones.php');
            }, 2000);
        });
}

function enviarFormularioProfesion(form, url) {
    event.preventDefault();
    var formData = new FormData(form);
    
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('contenido-modal').innerHTML = data;
        setTimeout(() => {
            modal.style.display = 'none';
            cargarContenido('readprofesiones.php');
        }, 2000);
    });
    return false;
}

function cargarProfesiones() {
    var contenedor = document.getElementById("contenido");
    fetch("readprofesiones.php")
        .then((response) => response.text())
        .then((data) => {
            try {
                const objeto = JSON.parse(data);
                contenedor.innerHTML = renderizarTablaProfesiones(objeto);
            } catch (e) {
                console.error('Error al procesar la respuesta:', e);
                contenedor.innerHTML = data;
            }
        });
}

function renderizarTablaProfesiones(objeto) {
    let lista = objeto.datos;
    let buscar = objeto.buscar;
    let pagina = objeto.pagina;
    let orden = objeto.orden;
    let nivel = objeto.nivel;
    let nropaginas = objeto.nropaginas;

    let html = '';
    
    if(nivel == 1) {
        html += '<a href="javascript:formInsertarProfesion()">Insertar</a>';
    }
    
    html += `<div class="table-responsive">
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><a href="javascript:ordenarProfesiones('nombre')">Nombre</a></th>
                ${nivel == 1 ? '<th>Operaciones</th>' : ''}
            </tr>
        </thead>`;

    for (var i = 0; i < lista.length; i++) {
        html += `<tr>
            <td>${lista[i].nombre}</td>`;
        
        if(nivel == 1) {
            html += `<td>
                <div class="d-grid gap-2 d-md-block">
                  <a class="btn btn-primary btn-sm" href="javascript:editarProfesion(${lista[i].id})">Editar</a>
                  <a class="btn btn-danger btn-sm" href="javascript:eliminarProfesion(${lista[i].id})">Eliminar</a>
                </div>
            </td>`;
        }
        
        html += '</tr>';
    }
    html += "</table></div>";

    if(nropaginas > 1) {
        html += '<ul style="display: flex; list-style: none; gap: 5px">';
        
        if(pagina > 1) {
            html += `<li style="margin:5px"><a href="javascript:cargarPaginaProfesiones(1,'${buscar}','${orden}','${asente}')">&lt;&lt;</a></li>
                     <li style="margin:5px"><a href="javascript:cargarPaginaProfesiones(${pagina-1},'${buscar}','${orden}','${asente}')">&lt;</a></li>`;
        }

        for (let i = Math.max(1, pagina-2); i <= Math.min(nropaginas, pagina+2); i++) {
            html += `<li style="margin:5px"><a href="javascript:cargarPaginaProfesiones(${i},'${buscar}','${orden}','${asente}')" 
                     ${i === pagina ? 'style="font-weight:bold"' : ''}>${i}</a></li>`;
        }

        if(pagina < nropaginas) {
            html += `<li style="margin:5px"><a href="javascript:cargarPaginaProfesiones(${pagina+1},'${buscar}','${orden}','${asente}')">&gt;</a></li>
                     <li style="margin:5px"><a href="javascript:cargarPaginaProfesiones(${nropaginas},'${buscar}','${orden}','${asente}')">&gt;&gt;</a></li>`;
        }
        
        html += '</ul>';
    }

    return html;
}

function cargarPaginaProfesiones(pagina, buscar, orden, ascendente) {
    var url = `readprofesiones.php?pagina=${pagina}&buscar=${buscar}&orden=${orden}&asendente=${ascendente}`;
    var contenedor = document.getElementById("contenido");
    fetch(url)
        .then((response) => response.text())
        .then((data) => {
            try {
                const objeto = JSON.parse(data);
                contenedor.innerHTML = renderizarTablaProfesiones(objeto);
            } catch (e) {
                console.error('Error al procesar la respuesta:', e);
                contenedor.innerHTML = data;
            }
        });
}

function ordenarProfesiones(columna) {
    if (ordenActual.columna === columna) {
        asente = asente === 'asc' ? 'desc' : 'asc';
    } else {
        ordenActual.columna = columna;
        asente = 'asc';
    }
    
    cargarPaginaProfesiones(1, document.getElementById('buscar')?.value || '', columna, asente);
}

function crearProfesion() {
    var datos = new FormData(document.getElementById("form-crear-profesion"));
    
    fetch("createprofesiones.php", {
        method: "POST",
        body: datos
    })
    .then((response) => response.text())
    .then((data) => {
        document.getElementById("contenido-modal").innerHTML = data;
        setTimeout(() => {
            modal.style.display = "none";
            cargarProfesiones();
        }, 2000);
    });
    return false;
}

function guardarEditarProfesion() {
    var datos = new FormData(document.getElementById("form-edit-profesion"));
    
    fetch("editprofesiones.php", {
        method: "POST",
        body: datos
    })
    .then((response) => response.text())
    .then((data) => {
        document.getElementById("contenido-modal").innerHTML = data;
        setTimeout(() => {
            modal.style.display = "none";
            cargarProfesiones();
        }, 2000);
    });
    return false;
}
