function cargarTablaHabitacionAdmin() {
    fetch('readhabitacionadmin.php')
        .then(resp => resp.text())
        .then(html => {
            document.getElementById('contenido').innerHTML = html;
        });
}

function formEditarHabitacionAdmin(id) {
    fetch('formedithabitacionadmin.php?id=' + id)
    .then(resp => resp.text())
    .then(html => {
        document.getElementById('contenido').innerHTML = html;
        if (typeof initPhotoManager === 'function') {
            initPhotoManager();
        }
        if (typeof makePhotosDraggable === 'function') {
            makePhotosDraggable();
    }
    });}

function editarHabitacionAdmin() {
    const form = document.getElementById('formEditarHabitacionAdmin');
    const datos = new FormData(form);
    datos.append('formEditarHabitacionAdmin', '1');
    const lista = document.getElementById('photoList');
    if (lista) {
        const fotosProcesadas = [];
        lista.querySelectorAll('.photo-item').forEach((el, idx) => {
            fotosProcesadas.push({
                id: el.dataset.id,
                orden: idx,
                eliminar: el.classList.contains('toDelete') ? 1 : 0
            });
        });
        datos.append('fotos_manipuladas', JSON.stringify(fotosProcesadas));
    }
    const nuevas = document.getElementById('nuevasFotos');
    if (nuevas && nuevas.files.length) {
        Array.from(nuevas.files).forEach(f => datos.append('nuevasFotos[]', f));
    }
    fetch('edithabitacionadmin.php', {
        method: 'POST',
        body: datos,
        headers: {
            'Accept': 'text/html',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(resp => resp.text())
    .then(html => {
        document.getElementById('contenido').innerHTML = html;
        cargarTablaHabitacionAdmin();
    })

}
function eliminarFotografiaAdmin(habitacion_id, idfoto) {
    if (confirm('¿Seguro de eliminar la fotografía?')) {
        const datos = new FormData();
        datos.append('id', idfoto);
        datos.append('habitacion_id', habitacion_id);
            
            fetch('deletefotografiaadmin.php', {
                method: 'POST',
                body: datos
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la petición: ' + response.status);
                }
                return response.text();
            })
            .then(() => {
                formEditarHabitacionAdmin(habitacion_id);
            })
            .catch(error => {
                console.error('Error al eliminar la fotografía:', error);
                alert('Ocurrió un error al eliminar la fotografía: ' + error.message);
            });
    }
}
function eliminarHabitacionAdmin(id) {
    if (confirm('¿Seguro de eliminar la habitación?')) {
        fetch('deletehabitacionadmin.php?id=' + id)
        .then(resp => resp.text())
        .then(() => {
            cargarTablaHabitacionAdmin();
        });
    }
}

function verFotos(id) {
    fetch('readfotografias.php?habitacion_id=' + id)
        .then(resp => resp.text())
        .then(html => {
            document.getElementById('modalContenido').innerHTML = html;
            abrirModal();
        });
}

function verFotosHabitacionAdmin(id) {
    fetch('readfotografias.php?habitacion_id=' + id)
        .then(resp => resp.text())
        .then(html => {
            document.getElementById('modalContenido').innerHTML = html;
            abrirModal();
        });
}

function abrirModal() {
    document.getElementById('modal').style.display = 'block';
}
function cerrarModal() {
    document.getElementById('modal').style.display = 'none';
}

function initPhotoManager() {
    if (typeof existingPhotos === 'undefined') return;
    const cont = document.getElementById('photoList');
    if (!cont) return;

    cont.innerHTML = '';
    existingPhotos.sort((a, b) => (a.orden || 0) - (b.orden || 0));

    existingPhotos.forEach(ph => {
        const div = document.createElement('div');
        div.className = 'photo-item';
        div.dataset.id = ph.id;
        div.innerHTML = `<img src="images/${ph.fotografia}" width="80"><br>${ph.nombre}<br><button type="button" class="btn-delete">Eliminar</button>`;
        cont.appendChild(div);
    });

    if (typeof Sortable !== 'undefined') {
        new Sortable(cont, { animation: 150 });
    } else {
        enableDragAndDrop(cont);
    }

    cont.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-delete')) {
            const item = e.target.closest('.photo-item');
            item.classList.toggle('toDelete');
            e.target.textContent = item.classList.contains('toDelete') ? 'Restaurar' : 'Eliminar';
        }
    });
}

function enableDragAndDrop(container) {
    let dragged = null;
    container.addEventListener('dragstart', (e) => {
        const item = e.target.closest('.photo-item');
        if (!item) return;
        dragged = item;
        item.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', '');
    });

    container.addEventListener('dragend', () => {
        if (dragged) dragged.classList.remove('dragging');
        dragged = null;
    });

    container.addEventListener('dragover', (e) => {
        e.preventDefault();
        const item = e.target.closest('.photo-item');
        if (!item || item === dragged) return;
        const rect = item.getBoundingClientRect();
        const after = (e.clientX - rect.left) / (rect.width) > 0.5;
        container.insertBefore(dragged, after ? item.nextSibling : item);
    });
}

function makePhotosDraggable() {
    const header = Array.from(document.querySelectorAll('h3')).find(h => h.textContent.includes('Fotografías actuales'));
    if (!header) return;
    const photoDivs = [];
    let el = header.nextElementSibling;
    while (el && el.tagName !== 'H3') {
        if (el.tagName === 'DIV') photoDivs.push(el);
        el = el.nextElementSibling;
    }
    if (!photoDivs.length) return;

    const cont = document.createElement('div');
    cont.id = 'photoList';
    cont.style.display = 'flex';
    cont.style.flexWrap = 'wrap';
    cont.style.gap = '5px';
    header.after(cont);

    photoDivs.forEach(div => {
        div.classList.add('photo-item');
        div.setAttribute('draggable', 'true');
        const idInput = div.querySelector("input[name='id']");
        if (idInput) div.dataset.id = idInput.value;
        cont.appendChild(div);
    });

    enableDragAndDrop(cont);
}

window.onclick = function(event) {
    var modal = document.getElementById('modal');
    if (event.target == modal) {
        cerrarModal();
    }
}







function readTipoHabitacionAdmin(){
    fetch('readtipohabitacionadmin.php')
    .then(resp => resp.json())
    .then(data => {
        const objeto = data;
        document.getElementById('contenido').innerHTML = renderizarTablaTipoHabitacionAdmin(objeto);
    });
}
function renderizarTablaTipoHabitacionAdmin(objeto){
    let html = `<button onclick="formAgregarTipoHabitacionAdmin()">Agregar Tipo de Habitación</button>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>`;
        
        for (let i = 0; i < objeto.length; i++) {
            html += `<tr>
                        <td>${objeto[i].nombre}</td>
                        <td>
                            <button onclick="formEditarTipoHabitacionAdmin(${objeto[i].id})">Editar</button>
                            <button onclick="eliminarTipoHabitacionAdmin(${objeto[i].id})">Eliminar</button>
                        </td>
                    </tr>`;
        }
        html += `</table>`;
        return html;
}

function formEditarTipoHabitacionAdmin(id){
    fetch("formeditartipohabitacionadmin.php?id=" + id)
    .then(resp => resp.json())
    .then(data => {
        const objeto = data;
        document.getElementById('titulo-modal').innerHTML = 'Editar Tipo de Habitación';
        document.getElementById('contenido-modal').innerHTML = renderizarFormEditarTipoHabitacionAdmin(objeto);
        modal.style.display = "block";
    });
}

function renderizarFormEditarTipoHabitacionAdmin(objeto){
    let html = `<form id="formEditarTipoHabitacionAdmin">
    <input type="hidden" name="id" value="${objeto[0].id}">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="${objeto[0].nombre}">
    <button type="button" onclick="editarTipoHabitacionAdmin()">Guardar</button>
</form>`;
    return html;
}


function editarTipoHabitacionAdmin(){
    const form = document.getElementById('formEditarTipoHabitacionAdmin');
    const datos = new FormData(form);
    fetch("editartipohabitacionadmin.php", {
        method: 'POST',
        body: datos
    })
    .then(resp => resp.text())
    .then(() => {
        modal.style.display = "none";
        readTipoHabitacionAdmin();
    });
   
}


function eliminarTipoHabitacionAdmin(id){
    if (confirm('¿Seguro de eliminar el tipo de habitación?')) {
        fetch("eliminartipohabitacionadmin.php?id=" + id)
        .then(() => {
            readTipoHabitacionAdmin();
        });
    }
}

function formAgregarTipoHabitacionAdmin(){
    let html = `<form id="formAgregarTipoHabitacionAdmin">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre">
    <button type="button" onclick="crearTipoHabitacionAdmin()">Guardar</button>
</form>`;
    document.getElementById('titulo-modal').innerHTML = 'Agregar Tipo de Habitación';
    document.getElementById('contenido-modal').innerHTML = html;
    modal.style.display = "block";
}

function crearTipoHabitacionAdmin(){
    const form = document.getElementById('formAgregarTipoHabitacionAdmin');
    const datos = new FormData(form);
    fetch("agregartipohabitacionadmin.php", {
        method: 'POST',
        body: datos
    })
    .then(resp => resp.text())
    .then(() => {
        modal.style.display = "none";
        readTipoHabitacionAdmin();
    });
   
}

    




function formAgregarHabitacionAdmin(){
    fetch('formagregarhabitacionadmin.php')
        .then(resp => resp.text())
        .then(html => {
            document.getElementById('contenido').innerHTML = html;
            nuevasFotosData = [];
            const existing = document.getElementById('photoList');
            if (existing) existing.remove();
            if (typeof initPhotoManager === 'function') {
                initPhotoManager();
            }
        });
}

let nuevasFotosData = [];

function addPhotoToList(){
    const nombreInput = document.getElementById('tmpNombre');
    const tipoInput   = document.getElementById('tmpTipo');
    const archivoInput= document.getElementById('tmpArchivo');

    if(!nombreInput.value || !tipoInput.value || !archivoInput.files.length){
        alert('Completa nombre, tipo y selecciona la fotografía');
        return;
    }
    const file = archivoInput.files[0];
    nuevasFotosData.push({
        nombre: nombreInput.value,
        tipo: tipoInput.value,
        file: file
    });

    renderPhotoList();

    nombreInput.value='';
    tipoInput.value='';
    archivoInput.value='';
}

function renderPhotoList(){
    let cont = document.getElementById('photoList');
    if(!cont){
        cont = document.createElement('div');
        cont.id = 'photoList';
        cont.style.display='flex';
        cont.style.flexWrap='wrap';
        cont.style.gap='5px';
        document.getElementById('photoSection').appendChild(cont);
    }
    cont.innerHTML='';
    nuevasFotosData.forEach((photo, idx)=>{
        const div = document.createElement('div');
        div.className='photo-item';
        div.setAttribute('draggable','true');
        div.dataset.idx=idx;
        div.innerHTML=`<img src="${URL.createObjectURL(photo.file)}" width="80"><br>${photo.nombre}<br><button type='button' class='btn-delete'>Eliminar</button>`;
        cont.appendChild(div);
    });
    enableDragAndDrop(cont);
    cont.querySelectorAll('.btn-delete').forEach(btn=>{
        btn.onclick = function(){
            const idx = parseInt(this.parentElement.dataset.idx);
            nuevasFotosData.splice(idx,1);
            renderPhotoList();
        }
    });
}

function crearHabitacionAdmin(){
    const form = document.getElementById('formAgregarHabitacionAdmin');
    if(!form){
        alert('Formulario no encontrado');
        return;
    }
    const datos = new FormData(form);
    datos.append('formAgregarHabitacionAdmin', '1');

    const list = document.getElementById('photoList');
    if(list){
        const items = Array.from(list.querySelectorAll('.photo-item'));
        items.forEach((item, idx)=>{
            const foto = nuevasFotosData[parseInt(item.dataset.idx)];
            if(foto){
                datos.append('nuevasFotos[]', foto.file);
                datos.append('foto_nombres[]', foto.nombre);
                datos.append('foto_tipos[]', foto.tipo);
                datos.append('foto_ordenes[]', idx);
            }
        });
    }


    fetch('agregarhabitacionadmin.php', {
        method: 'POST',
        body: datos,
        headers: {
            'Accept': 'text/html',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(resp => resp.text())
    .then(html => {
        document.getElementById('contenido').innerHTML = html;
        cargarTablaHabitacionAdmin();
        nuevasFotosData = [];
    })
    .catch(err => console.error('Error al crear la habitación:', err));
}

function crearFotografiaAdmin(){
    const form = document.getElementById('formAgregarFotografiaAdmin');
    if(!form){
        alert('Formulario no encontrado');
        return;
    }
    const datos = new FormData(form);
    datos.append('formAgregarFotografiaAdmin', '1');
    fetch('createfotografiaadmin.php', {
        method: 'POST',
        body: datos
    })
    .then(resp => resp.text())
    .then(html => {
        document.getElementById('contenido').innerHTML = html;
    })
}
        