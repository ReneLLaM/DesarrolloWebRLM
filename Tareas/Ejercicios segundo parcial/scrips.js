function cargarContenido(abrir) {

    let contenido = document.getElementById("contenido");
    let mensaje = document.getElementById("mensaje");

    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    ajax.open("get", abrir, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            contenido.innerHTML = ajax.responseText;
            mensaje.innerHTML = `<div class="turno">Turno <span id='turno-jugador'>x</span></div>`;

        }
    }
    ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    ajax.send();

}




function turnoJugador(item) {
    let turno = document.getElementById("turno-jugador");

    if (item.innerHTML == "") {
        item.innerHTML = turno.innerHTML;


        if (turno.innerHTML == "x") {
            turno.innerHTML = "o";
        } else {
            turno.innerHTML = "x";
        }
    }


}



function pregunta2(abrir) {

    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    ajax.open("get", abrir, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
            document.querySelector('#mensaje').innerHTML = "";
        }
    }
    ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    ajax.send();

}


function tabla() {
    let tablaDel = document.getElementById("tabla-del").value;
    let hasta = document.getElementById("hasta").value;
    let operacion = document.querySelector('input[name="operacion"]:checked').value;

    if (!(tablaDel > 0 && tablaDel <= 10)) {
        alert("Ingrese un numero entre 1 y 10");
        return;
    }

    if (!(hasta > 1)) {

        alert("Ingrese un numero mayor a 1");
        return;
    }

    let html = "";
    for (let i = 1; i <= hasta; i++) {
        html = html + `${i} ${operacion} ${tablaDel} = ${eval(i + operacion + tablaDel)}<br>`;
    }

    document.getElementById("resultado").innerHTML = html;
}




function pregunta3(abrir) {

    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    ajax.open("get", abrir, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    ajax.send();

}


function cambiarNivel(id, nivel) {
    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    ajax.open("GET", `cambiarNivel.php?id=${id}&nivel=${nivel}`, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            pregunta3("listar.php");
        }
    }
    ajax.send();
}

function pregunta4(abrir, boton) {
    var ajax = new XMLHttpRequest();
    var separator = abrir.includes('?') ? '&' : '?';
    ajax.open("get", abrir + separator + "boton=" + boton, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    ajax.send();
}



function pregunta5() {
    var contenedor = document.getElementById("contenido");
    contenedor.innerHTML = "";
    fetch("datos.php")
        .then((response) => response.json())  
        .then((data) => {
            contenedor.appendChild(renderizarSeccion(data));
        })
        .catch(error => console.error('Error:', error));
}

function renderizarSeccion(objeto) {
    
    const select = document.createElement('select');
    select.id = 'select';
    
    objeto.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.textContent = item.titulo;
        select.appendChild(option);
    });

    select.addEventListener('change', (e) => {
        const selectedObject = objeto.find(item => item.id === e.target.value);
        mostrarImagen(selectedObject);
    });
    
    return select;
}

function mostrarImagen(objeto) {
    console.log(objeto);

    // Limpiar el contenedor si ya hay algo
    const contenedor = document.getElementById("contenido");
    
    // Eliminar imagen anterior si existe
    const imagenAnterior = contenedor.querySelector('img');
    if (imagenAnterior) {
        imagenAnterior.remove();
    }

    // Crear la imagen
    const imagen = document.createElement('img');
    imagen.src = `images/${objeto.imagen}`;
    imagen.style.maxWidth = '300px';
    imagen.style.marginTop = '10px';

    // Insertar la imagen en el contenedor
    contenedor.appendChild(imagen);
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


function abrirModal(){
    fetch("tresenraya.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("titulo-modal").textContent = "titulo modificado";
        document.getElementById("contenido-modal").innerHTML = data;
        modal.style.display = "block";
    })
}