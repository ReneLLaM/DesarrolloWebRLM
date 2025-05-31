// function cargarContenido(abrir) {

//     var contenedor = document.getElementById("menu");
//     var mensaje = document.getElementById("mensaje");

//     fetch(abrir)
//         .then((response) => response.text())
//         .then((data) => (
//             contenedor.innerHTML = data,
//             mensaje.innerHTML = `<h1>Nombre: Rene</h1>`
//         ))
// }

function cargarContenido(abrir) {

    var contenedor = document.querySelector('#menu')
    var mensaje = document.querySelector('#mensaje')

    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    ajax.open("get", abrir, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            contenedor.innerHTML = ajax.responseText;
            mensaje.innerHTML = `<h1>Nombre: Rene Llanos </h1>`
        }
    }
    ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    ajax.send();
    
}


function cargarContenidoPrincipal(abrir) {

    var contenedor = document.querySelector('#principal')

    var ajax = new XMLHttpRequest( ); //crea el objeto ajax
    ajax.open("get", abrir, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    ajax.send();
    
}