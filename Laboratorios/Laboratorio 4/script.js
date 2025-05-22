function autenticar() {
    var url = `autenticar.php`;
    fetch(url)
       .then((response) => response.json())
       .then((data) => {
            if(data["autenticado"] == 1){
                window.location.href = "index.php";
            }else{
                document.getElementById("mensaje").innerHTML = "Usuario o contraseña incorrectos";
            }
       });
}