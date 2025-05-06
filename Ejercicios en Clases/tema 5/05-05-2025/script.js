function obtenerDepartamentos() {
    fetch('departamento.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la red');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById("departamentos").innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById("departamentos").innerHTML = 'Error al cargar los departamentos';
        });
}

// ahora cuando exista cmbio change 
document.getElementById("departamentos").addEventListener("change", function() {
    
    const departamentoSelect = document.getElementById("departamentos");
    const provinciasSelect = document.getElementById("provincias");
    
    const id = this.value;
    
    // Validar que haya un id seleccionado
    if (!id) {
        provinciasSelect.innerHTML = '<option value="">Seleccione un departamento primero</option>';
        return;
    }

    // Mostrar estado de carga
    provinciasSelect.innerHTML = '<option>Cargando...</option>';
    
    fetch('provincia.php?id=' + encodeURIComponent(id))
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            if (!data.trim()) {
                provinciasSelect.innerHTML = '<option value="">No hay provincias disponibles</option>';
            } else {
                provinciasSelect.innerHTML = data;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            provinciasSelect.innerHTML = '<option value="">Error al cargar las provincias</option>';
        });
});
