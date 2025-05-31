var modal = document.getElementById("myModal");
var closeBtn = document.getElementsByClassName("close")[0];


var modalEliminar = document.getElementById("modal-eliminar");
var correoIdToDelete = null;
var isBandejaSalida = false;
var isBandejaEntrada = false;
var isBorrador = false;
var isEliminarCuenta = false;

var modalEditar = document.getElementById("modal-editar");
var closeEditar = modalEditar.getElementsByClassName("close")[0];


verCorreoBandejaEntrada = function (id) {
  fetch("ver-correo-bandeja-entrada.php?id=" + id)
    .then((response) => response.text())
    .then((data) => {
      const objeto = JSON.parse(data);
      const titulo = objeto[0].asunto;
      const contenido = objeto[0].mensaje;
      const fecha = objeto[0].fecha;
      const emisor = objeto[0].emisor;
      const nombre = objeto[0].nombre;
      
      modal.style.display = "block";
      modal.style.zIndex = 30;
      
      document.getElementById("titulo-modal").innerHTML = titulo;
      document.getElementById("fecha-modal").innerHTML = fecha;
      document.getElementById("emisor-modal").innerHTML = emisor;
      document.getElementById("nombre-modal").innerHTML = nombre;
      document.getElementById("contenido-modal").innerHTML = contenido;
      listarBandejaEntrada();
    })
    .catch(error => {
      console.error('Error:', error);
    });
};

verCorreoBandejaSalida = function (id) {
  fetch("ver-correo-bandeja-salida.php?id=" + id)
    .then((response) => response.text())
    .then((data) => {
      
      const objeto = JSON.parse(data);
      console.log(objeto);
      const titulo = objeto[0].asunto;
      const contenido = objeto[0].mensaje;
      const fecha = objeto[0].fecha;
      const receptor = objeto[0].receptor;
      const nombre = objeto[0].nombre;
      
      modal.style.display = "block";
      modal.style.zIndex = 30;
      
      document.getElementById("titulo-modal").innerHTML = titulo;
      document.getElementById("fecha-modal").innerHTML = fecha;
      document.getElementById("emisor-modal").innerHTML = receptor;
      document.getElementById("nombre-modal").innerHTML = nombre;
      document.getElementById("contenido-modal").innerHTML = contenido;
      listarBandejaSalida();
    })
    .catch(error => {
      console.error('Error:', error);
    });
};

closeBtn.onclick = function () {
  modal.style.display = "none";
};

closeEditar.onclick = function() {
  modalEditar.style.display = "none";
};


window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  if (event.target == modalEliminar) {
    cerrarModalEliminar();
  }
  if (event.target == modalEditar) {
    modalEditar.style.display = "none";
  }
};

cerrarModalEliminar = function() {
  modalEliminar.style.display = "none";
  correoIdToDelete = null;
  isBandejaSalida = false;
  isBorrador = false;
  isBandejaEntrada = false;
  isEliminarCuenta = false;
};

var closeEliminar = modalEliminar.getElementsByClassName("close")[0];
closeEliminar.onclick = cerrarModalEliminar;

eliminarCorreoBandejaEntrada = function (id) {
  correoIdToDelete = id;
  isBandejaSalida = false;
  isBandejaEntrada = true;
  isBorrador = false;
  isEliminarCuenta = false;
  modalEliminar.style.display = "block";
};

eliminarCorreoBandejaSalida = function (id) {
  correoIdToDelete = id;
  isBandejaSalida = true;
  isBorrador = false;
  isBandejaEntrada = false;
  isEliminarCuenta = false;
  modalEliminar.style.display = "block";
};

eliminarCorreoBorrador = function (id) {
  correoIdToDelete = id;
  isBorrador = true;
  isBandejaSalida = false;
  isBandejaEntrada = false;
  isEliminarCuenta = false;
  modalEliminar.style.display = "block";
};

eliminarCuenta = function (id) {
  correoIdToDelete = id;
  isBandejaSalida = false;
  isBandejaEntrada = false;
  isBorrador = false;
  isEliminarCuenta = true;
  modalEliminar.style.display = "block";
  

  document.getElementById("btn-confirmar-eliminar").onclick = function() {
    fetch("eliminar-cuenta.php?id=" + id)
      .then(response => response.text())
      .then(() => {
        listarGestionarCuentas();
        cerrarModalEliminar();
      })
      .catch(error => {
        console.error('Error:', error);
        cerrarModalEliminar();
      });
  };
};

document.getElementById("btn-confirmar-eliminar").onclick = function() {
  if (correoIdToDelete !== null) {
    if (isBandejaSalida) {
      fetch("eliminar-correo-bandeja-salida.php?id=" + correoIdToDelete)
        .then((response) => response.text())
        .then((data) => {
          listarBandejaSalida();
          cerrarModalEliminar();
        });
    } else if (isBandejaEntrada) {
      fetch("eliminar-correo-bandeja-entrada.php?id=" + correoIdToDelete)
        .then((response) => response.text())
        .then((data) => {
          listarBandejaEntrada();
          cerrarModalEliminar();
        });
    } else if (isBorrador) {
      fetch("eliminar-correo-borrador.php?id=" + correoIdToDelete)
        .then((response) => response.text())
        .then((data) => {
          listarBorradores();
          cerrarModalEliminar();
        });
    } else if (isEliminarCuenta) {
      fetch("eliminar-cuenta.php?id=" + correoIdToDelete)
        .then(response => response.text())
        .then(() => {
          listarGestionarCuentas();
          cerrarModalEliminar();
        })
        .catch(error => {
          console.error('Error:', error);
          cerrarModalEliminar();
        });
    }
  }
};

function resetNavStyles() {
  const navLinks = document.querySelectorAll("nav a");
  navLinks.forEach(link => {
    link.style.borderRight = "";
    link.style.backgroundColor = "";
    link.style.color = "";
  });
}

function listarBandejaEntrada() {
  let contenedor = document.getElementById("contenido");
  let titulo = document.getElementById("nav-bandeja-entrada");
  resetNavStyles();
  titulo.style.borderRight = "3px solid #6974dc";
  titulo.style.backgroundColor = "#f0f3fd";
  titulo.style.color = "#6974dc";

  fetch("listar-bandeja-de-entrada.php")
    .then((response) => response.text())
    .then((data) => {
      const texTitulo = titulo.textContent;
      const imgTitulo = titulo.firstElementChild.src;
      const objeto = JSON.parse(data);
      contenedor.innerHTML = `<h1 class="titulo"><img src="${imgTitulo}" alt="${texTitulo}">${texTitulo}</h1>` + renderizarTablaBandejaEntrada(objeto);
    });
}

function listarBandejaSalida() {
  let contenedor = document.getElementById("contenido");
  let titulo = document.getElementById("nav-bandeja-salida");
  resetNavStyles();
  titulo.style.borderRight = "3px solid #6974dc";
  titulo.style.backgroundColor = "#f0f3fd";
  titulo.style.color = "#6974dc";

  fetch("listar-bandeja-de-salida.php")
    .then((response) => response.text())
    .then((data) => {
      const texTitulo = titulo.textContent;
      const imgTitulo = titulo.firstElementChild.src;
      const objeto = JSON.parse(data);
      contenedor.innerHTML = `<h1 class="titulo"><img src="${imgTitulo}" alt="${texTitulo}">${texTitulo}</h1>` + renderizarTablaBandejaSalida(objeto);
    });
}

function listarBorradores() {
  let contenedor = document.getElementById("contenido");
  let titulo = document.getElementById("nav-borradores");
  resetNavStyles();
  titulo.style.borderRight = "3px solid #6974dc";
  titulo.style.backgroundColor = "#f0f3fd";
  titulo.style.color = "#6974dc";

  fetch("listar-borrador.php")
    .then((response) => response.text())
    .then((data) => {
      const texTitulo = titulo.textContent;
      const imgTitulo = titulo.firstElementChild.src;
      const objeto = JSON.parse(data);
      contenedor.innerHTML = `<h1 class="titulo"><img src="${imgTitulo}" alt="${texTitulo}">${texTitulo}</h1>` + renderizarTablaBorradores(objeto);
    });
}

function listarGestionarCuentas(){
  let contenedor = document.getElementById("contenido");
  let titulo = document.getElementById("nav-gestionar-cuentas");
  resetNavStyles();
  titulo.style.borderRight = "3px solid #6974dc";
  titulo.style.backgroundColor = "#f0f3fd";
  titulo.style.color = "#6974dc"; 

  fetch("listar-gestionar-cuentas.php")
    .then((response) => response.text())
    .then((data) => {

      const texTitulo = titulo.textContent;
      const imgTitulo = titulo.firstElementChild.src;
      const objeto = JSON.parse(data);
      contenedor.innerHTML = `<h1 class="titulo"><img src="${imgTitulo}" alt="${texTitulo}">${texTitulo} <a href="javascript:agregarCuenta()" class="btn-agregar-cuenta">Agregar Cuenta</a></h1> ` + renderizarTablaGestionarCuentas(objeto);
    }); 
}

function renderizarTablaBandejaEntrada(objeto) {
  let html = "";
  html += `<table>
      <tr>
        <th>De</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Asunto</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>`;

  for(let i = 0; i < objeto.length; i++) {
    html += `
      <tr class="${objeto[i].leido == 1 ? 'correo-leido' : 'correo-no-leido'}">
        <td>${objeto[i].emisor}</td>
        <td>${objeto[i].nombre}</td>
        <td>${objeto[i].fecha}</td>
        <td class="asunto">${objeto[i].asunto}</td>
        <td class="${objeto[i].leido == 1 ? 'correo-leido' : 'correo-no-leido'}">${objeto[i].leido == 1 ? "<span class='leido'>Leído</span>" : "<span>No leído</span>"}</td>
        <td class="acciones-correo">    
          <a class="btn-ver" href="javascript:verCorreoBandejaEntrada(${objeto[i].id})">Ver</a>
          <a class="btn-eliminar" href="javascript:eliminarCorreoBandejaEntrada(${objeto[i].id})">Eliminar</a>
        </td>
      </tr>`;
  }

  html += `</table>`;
  return html;
}

function renderizarTablaBandejaSalida(objeto) {
  let html = "";
  html += `<table>
      <tr>
        <th>Para</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Asunto</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>`;

  for(let i = 0; i < objeto.length; i++) {
    html += `
      <tr class="${objeto[i].leido == 1 ? 'correo-leido' : 'correo-no-leido'}">
        <td>${objeto[i].receptor}</td>
        <td>${objeto[i].nombre_receptor}</td>
        <td>${objeto[i].fecha}</td>
        <td class="asunto">${objeto[i].asunto}</td>
        <td class="${objeto[i].leido == 1 ? 'correo-leido' : 'correo-no-leido'}">${objeto[i].leido == 1 ? "<span class='leido'>Leído</span>" : "<span>No leído</span>"}</td>
        <td class="acciones-correo">    
          <a class="btn-ver" href="javascript:verCorreoBandejaSalida(${objeto[i].id})">Ver</a>
          <a class="btn-eliminar" href="javascript:eliminarCorreoBandejaSalida(${objeto[i].id})">Eliminar</a>
        </td>
      </tr>`;
  }

  html += `</table>`;
  return html;
}

function renderizarTablaBorradores(objeto) {
  let html = "";
  html += `<table>
      <tr>
        <th>Para</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Asunto</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>`;

  for(let i = 0; i < objeto.length; i++) {
    html += `
      <tr class="tr-borrador">
        <td>${objeto[i].receptor}</td>
        <td>${objeto[i].nombre_receptor}</td>
        <td>${objeto[i].fecha}</td>
        <td class="asunto">${objeto[i].asunto}</td>
        <td>${objeto[i].estado}</td>  
        <td class="acciones-cuenta">    
        <a class="btn-enviar" href="javascript:enviarBorrador(${objeto[i].id})">Enviar</a>
          <a class="btn-editar btn-ver" href="javascript:editarBorrador(${objeto[i].id})">Editar</a>
          <a class="btn-eliminar" href="javascript:eliminarCorreoBorrador(${objeto[i].id})">Eliminar</a>
        </td>
      </tr>`;
  }

  html += `</table>`;
  return html;
}

function renderizarTablaGestionarCuentas(objeto) {
  let html = "";
  html += `<table>
      <tr>
        <th>Correo</th>
        <th>Nombre</th>
        <th>Nivel</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>`;

  for(let i = 0; i < objeto.length; i++) {
    html += `
      <tr class="tr-borrador">
        <td>${objeto[i].correo}</td>
        <td>${objeto[i].nombre}</td>
        <td>${objeto[i].nivel == 1 ? 'Admin' : 'Usuario'}</td>
        <td class="${objeto[i].estado == 1 ? 'activo' : 'inactivo'}">${objeto[i].estado == 1 ? 'Activo' : 'Inactivo'}</td>
        <td class="acciones-cuenta">
          <a class="btn-editar btn-ver" href="javascript:editarCuenta(${objeto[i].id})">Editar</a>
          <a class="btn-enviar" href="javascript:activarSuspenderCuenta(${objeto[i].id})">${objeto[i].estado == 1 ? 'Suspender' : 'Activar'}</a>
          <a class="btn-eliminar" href="javascript:eliminarCuenta(${objeto[i].id})">Eliminar</a>
        </td>
      </tr>`;
  }

  html += `</table>`;
  return html;
}

function enviarBorrador(id) {
  fetch("enviar-borrador.php?id=" + id)
    .then(response => response.text())
    .then(data => {
      listarBandejaSalida();
    });
}

function editarBorrador(id) {
  fetch("form-editar.php?id=" + id)
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("contenido-modal-editar").innerHTML = data;
      document.getElementById("modal-editar").style.display = "block";
    });
}

function guardarBorrador() {
  const para = document.getElementById('para').value;
  const asunto = document.getElementById('asunto').value;
  const mensaje = document.getElementById('mensaje').value;
  const id = document.getElementById('id').value;

  const formData = new FormData();
  formData.append('para', para);
  formData.append('asunto', asunto);
  formData.append('mensaje', mensaje);
  formData.append('id', id);

  fetch('guardar-borrador-editado.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(() => {
    modalEditar.style.display = "none";
    listarBorradores();
  })
  .catch(error => {
    console.error('Error:', error);
  });
}

function enviarCorreoBorrador() {
  const para = document.getElementById('para').value;
  const asunto = document.getElementById('asunto').value;
  const mensaje = document.getElementById('mensaje').value;
  const id = document.getElementById('id').value;

  const formData = new FormData();
  formData.append('para', para);
  formData.append('asunto', asunto);
  formData.append('mensaje', mensaje);
  formData.append('id', id);

  fetch('enviar-correo-borrador.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(() => {
    modalEditar.style.display = "none";
    listarBandejaSalida();
  })
  .catch(error => {
    console.error('Error:', error);
  });
}

function redactarCorreo() {
  fetch("form-insertar.php")
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("contenido-modal-editar").innerHTML = data;
      modalEditar.style.display = "block";
    });
}

function guardarBorradorInsertar() {
  const para = document.getElementById('para').value;
  const asunto = document.getElementById('asunto').value;
  const mensaje = document.getElementById('mensaje').value;

  const formData = new FormData();
  formData.append('para', para);
  formData.append('asunto', asunto);
  formData.append('mensaje', mensaje);

  fetch('guardar-borrador-insertar.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(() => {
    modalEditar.style.display = "none";
    listarBorradores();
  })
  .catch(error => {
    console.error('Error:', error);
  });
}

function enviarCorreoInsertar() {
  const para = document.getElementById('para').value;
  const asunto = document.getElementById('asunto').value;
  const mensaje = document.getElementById('mensaje').value;

  const formData = new FormData();
  formData.append('para', para);
  formData.append('asunto', asunto);
  formData.append('mensaje', mensaje);

  fetch('enviar-correo-insertar.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(() => {
    modalEditar.style.display = "none";
    listarBandejaSalida();
  })
  .catch(error => {
    console.error('Error:', error);
  });
}

function activarSuspenderCuenta(id) {
  fetch("activar-suspender-cuenta.php?id=" + id)
    .then(response => response.text())
    .then(() => {
      listarGestionarCuentas();
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

function eliminarCuenta(id) {
  correoIdToDelete = id;
  isBandejaSalida = false;
  isBandejaEntrada = false;
  isBorrador = false;
  isEliminarCuenta = true;
  modalEliminar.style.display = "block";
  

  document.getElementById("btn-confirmar-eliminar").onclick = function() {
    fetch("eliminar-cuenta.php?id=" + id)
      .then(response => response.text())
      .then(() => {
        listarGestionarCuentas();
        cerrarModalEliminar();
      })
      .catch(error => {
        console.error('Error:', error);
        cerrarModalEliminar();
      });
  };
}

function editarCuenta(id) {
  fetch("form-editar-cuenta.php?id=" + id)
    .then((response) => response.text())
    .then((data) => {
      // titulo modal editar cuenta
      document.getElementById("titulo-modal-editar").innerHTML = "Editar Cuenta";
      document.getElementById("contenido-modal-editar").innerHTML = data;
      modalEditar.style.display = "block";
    });
}


function agregarCuenta() {
  fetch("form-agregar-cuenta.php")
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("titulo-modal-editar").innerHTML = "Agregar Cuenta";
      document.getElementById("contenido-modal-editar").innerHTML = data;
      modalEditar.style.display = "block";
    });
}

function guardarAgregarCuenta() {
  const correo = document.getElementById('correo').value;
  const nombre = document.getElementById('nombre').value;
  const nivel = document.getElementById('nivel').value;
  const password = document.getElementById('password').value;

  const formData = new FormData();
  formData.append('correo', correo);
  formData.append('nombre', nombre);
  formData.append('nivel', nivel);
  formData.append('password', password);

  fetch('guardar-agregar-cuenta.php', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      modalEditar.style.display = "none";
      listarGestionarCuentas();

      document.getElementById('correo').value = '';
      document.getElementById('nombre').value = '';
      document.getElementById('password').value = '';
      document.getElementById('nivel').value = '0';
    } else {
      alert('Error al guardar la cuenta: ' + data.error);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Error al guardar la cuenta. Por favor, intente nuevamente.');
  });
}

function guardarEditarCuenta() {
  const correo = document.getElementById('correo').value;
  const nombre = document.getElementById('nombre').value;
  const nivel = document.getElementById('nivel').value;
  const password = document.getElementById('password').value;
  const id = document.getElementById('id').value;

  const formData = new FormData();
  formData.append('correo', correo);
  formData.append('nombre', nombre);
  formData.append('nivel', nivel);
  formData.append('password', password);
  formData.append('id', id);

  fetch('guardar-editar-cuenta.php', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      modalEditar.style.display = "none";
      listarGestionarCuentas();
      // Clear the form
      document.getElementById('correo').value = '';
      document.getElementById('nombre').value = '';
      document.getElementById('password').value = '';
      document.getElementById('nivel').value = '0';
      document.getElementById('id').value = '';
    } else {
      alert('Error al editar la cuenta: ' + data.error);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Error al editar la cuenta. Por favor, intente nuevamente.');
  });
}

function listarRevisarCorreos() {
  let contenedor = document.getElementById("contenido");
  let titulo = document.getElementById("nav-revisar-correos");
  resetNavStyles();
  titulo.style.borderRight = "3px solid #6974dc";
  titulo.style.backgroundColor = "#f0f3fd";
  titulo.style.color = "#6974dc";

  fetch("listar-revisar-correos.php")
    .then(response => response.text())
    .then(data => {
      const objeto = JSON.parse(data);
      document.getElementById("contenido").innerHTML = renderizarTablaRevisarCorreos(objeto);
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

function renderizarTablaRevisarCorreos(objeto) {
  let html = "";
  html += `<table>
  <tr>
    <th>ID</th>
    <th>Correo Emisor</th>
    <th>Correo Receptor</th>
    <th>Asunto</th>
    <th>Fecha</th>
    <th>Leido</th>
    <th>Acciones</th>
  </tr>`;
  for (let i = 0; i < objeto.length; i++) {
    html += `<tr class="tr-borrador">
    <td>${objeto[i].id}</td>
    <td>${objeto[i].correo_emisor}</td>
    <td>${objeto[i].correo_receptor}</td>
    <td class="asunto">${objeto[i].asunto}</td>
    <td>${objeto[i].fecha}</td>
    <td>${objeto[i].leido == 1 ? 'Leido' : 'No leido'}</td>
    <td>
      <a class="btn-ver" href="javascript:verCorreoRevisarCorreos(${objeto[i].id})">Ver</a>
    </td>
  </tr>`;
  }
  html += `</table>`;
  return html;
}

function verCorreoRevisarCorreos(id) {
  fetch("ver-correo-revisar-correos.php?id=" + id)
    .then(response => response.text())
    .then(data => {
      document.getElementById("contenido-modal-editar").innerHTML = data;
      document.getElementById("titulo-modal-editar").textContent = "Correo";
      modalEditar.style.display = "block";
    })
    .catch(error => {
      console.error('Error:', error);
    });
}


function enviarAviso() {
  fetch("form-enviar-aviso.php")
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("contenido-modal-editar").innerHTML = data;
      document.getElementById("titulo-modal-editar").textContent = "Enviar Aviso";
      modalEditar.style.display = "block";
    });
}


function guardarEnviarAviso() {
    const asunto = document.getElementById('asunto').value;
    const mensaje = document.getElementById('mensaje').value;

    const formData = new FormData();
    formData.append('asunto', asunto);
    formData.append('mensaje', mensaje);

    fetch('guardar-enviar-aviso.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(() => {
        modalEditar.style.display = "none";
        listarBandejaSalida();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}