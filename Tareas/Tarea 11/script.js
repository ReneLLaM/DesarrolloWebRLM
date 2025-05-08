function obtenerDepartamentos() {
    fetch("departamento.php")
        .then(response => response.text())
        .then(data => {
            document.querySelector('#departamento').innerHTML = data;
            document.querySelector('#provincia').innerHTML = '';
            document.querySelector('#municipio').innerHTML = '';
        })
}

function obtenerProvincias() {
    const departamento_id = document.getElementById('departamento').value;
    fetch(`provincia.php?id=${departamento_id}`)
        .then(response => response.text())
        .then(data => {
            document.querySelector('#provincia').innerHTML = data;
            document.querySelector('#municipio').innerHTML = '';
        })
}

function obtenerMunicipios() {
    const provincia_id = document.getElementById('provincia').value;
    fetch(`municipio.php?id=${provincia_id}`)
        .then(response => response.text())
        .then(data => {
            document.querySelector('#municipio').innerHTML = data;
        })
}
