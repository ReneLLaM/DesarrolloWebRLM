function inicio() {
    let html = `<h1 >Segundo Examen Parcial de SIS-256</h1>
            <p >Nombre Estudiante: <span id="nombre">.....</span> </p>
            <p >CU: <span id="cu">.....</span> </p>
            <p >Fecha: <span id="fecha">.....</span> </p>
            <p >Numero Visitas: <span id="numero">.....</span> </p>.`;
    let contenido = document.querySelector("#contenido");
    contenido.innerHTML = html;

    contador();
    let nombre = document.getElementById("nombre");
    let cu = document.getElementById("cu");
    let fecha = document.getElementById("fecha");



    nombre.textContent = "Llanos Machuca Rene";
    cu.textContent = "35-5051";
    fecha.textContent = "31/5/2025";
    numero.textContent = "1";

}

function contador() {
    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    ajax.open("get", "contador.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#numero').innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    ajax.send();
}

function cerrarMenu() {
    barra = document.querySelectorAll(".boton");
    console.log(barra);
    if (barra[0].style.display == "none") {
        for (let i = 0; i < 5; i++) {
            barra[i].style.display = "block";
        }

    } else {
        for (let i = 0; i < 5; i++) {
            barra[i].style.display = "none";
        }
    }
}

function mostrarBoton() {
    let boton = document.querySelectorAll(".boton");

}






function pregunta1(abrir) {
    var contenedor;
  contenedor = document.getElementById("contenido");
  fetch(abrir)
    .then((response) => response.text())
    .then((data) => (contenedor.innerHTML = data));

}
function mostrarImagen(abrir){
    var contenedor;
    contenedor = document.getElementById("contenido-modal");
    let tituloModal = document.getElementById("titulo-modal");

    let close = document.querySelector(".close");

    close.innerHTML = "aceptar"

    tituloModal.innerHTML = "";

    let html = `<img width="200px" height="600px" src="${abrir}" alt=""></img>`

    contenedor.innerHTML=html;

        modal.style.display = "block";
}




function pregunta2() {

    let html = `<table class="tabla">
                <tr>
                    <td onclick="javaScript:cambiacolor(this)" class="cFF0000">#FF0000</td>
                    <td onclick="javaScript:cambiacolor(this)" class="c00FF00">#00FF00</td>
                    <td class="c0000FF">#0000FF</td>
                </tr>
                <tr>
                    <td onclick="javaScript:cambiacolor(this)" class="cFFA500">#FFA500</td>
                    <td onclick="javaScript:cambiacolor(this)" class="c800080">#800080</td>
                    <td onclick="javaScript:cambiacolor(this)" class="cFFC0CB">#FFC0CB</td>
                </tr>
                <tr>
                    <td onclick="javaScript:cambiacolor(this)" class="c808080">#808080</td>
                    <td onclick="javaScript:cambiacolor(this)" class="c00FFFF">#00FFFF</td>
                    <td onclick="javaScript:cambiacolor(this)" class="c00FF00">#00FF00</td>
                </tr>
            </table>
            <label for="cambiarcolor">seccion</label>
            <select onChange="javaScript:cambiacolor(this)" name="cambiarcolor" id="cambiarcolor">
                
                <option value="barra">barra</option>
                <option value="menu">menu</option>
                <option value="contenido">contenido</option>
                <option value="historial">historial</option>
            </select>`


    let contenido = document.querySelector("#contenido");

    contenido.innerHTML = html;

}

function cambiacolor(color) {
    let elementoCambiarColor = document.getElementById("cambiarcolor").value;
    // console.log(elementoCambiarColor);
    // console.log(color.textContent);
    let elemento = document.getElementById(elementoCambiarColor);


    elemento.style.backgroundColor = color.textContent;
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


function pregunta3(abrir) {
    var contenedor;
    contenedor = document.getElementById("contenido-modal");
    let tituloModal = document.getElementById("titulo-modal");
    tituloModal.innerHTML = "Login";
    let close = document.querySelector(".close");

    close.innerHTML = "x"
    fetch(abrir)
        .then((response) => response.text())
        .then((data) => (contenedor.innerHTML = data));

        modal.style.display = "block";
}




function pregunta4(abrir){
    var contenedor;
  contenedor = document.getElementById("contenido");
  fetch(abrir)
    .then((response) => response.text())
    .then((data) => (contenedor.innerHTML = data));
}


function editar(id){
    var contenedor;
  contenedor = document.getElementById("contenido-modal");
  fetch("formeditar.php?id=" + id)
    .then((response) => response.text())
    .then((data) => (contenedor.innerHTML = data));
    modal.style.display = "block";
}

