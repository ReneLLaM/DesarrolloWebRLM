
document.addEventListener('DOMContentLoaded', function() {
    const menuLinks = document.querySelectorAll('.menu a, .logo');
    
    menuLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            menuLinks.forEach(item => item.classList.remove('active'));
            this.classList.add('active');
        });
    });
});

// habitaciones 
function readHabitaciones(texto = "", sucursal = "", tipohabitacion = "") {
    window.modoReservaAdmin = false;
    window.usuarioSeleccionadoReserva = "";
    let contenedor = document.getElementById("contenido");
    fetch("readhabitaciones.php?texto=" + texto + "&sucursal=" + sucursal + "&tipohabitacion=" + tipohabitacion)
        .then((response) => response.json())
        .then((data) => {
            return renderizarGridHabitaciones(data, texto, sucursal, tipohabitacion);
        })
        .then(html => {
            contenedor.innerHTML = html;
            if (sucursal) document.getElementById("sucursal").value = sucursal;
            if (tipohabitacion) document.getElementById("tipohabitacion").value = tipohabitacion;
            if (texto) document.getElementById("busqueda").value = texto;
        });
}

function renderizarGridHabitaciones(objeto, texto, sucursal, tipohabitacion) {

    let grid = `
    <div id="grid">`;

    for (let i = 0; i < objeto.length; i++) {
        grid += `<div class="habitacion" onclick="javascript:readHabitacion(${objeto[i].id})">
                    <img src="images/${objeto[i].fotografia}" alt="">
                    <div class="nombre">
                        <h3 id="nombre-habitacion">${objeto[i].nombrehabitacion}</h3>
                        <p id="tipo-habitacion">${objeto[i].nombretipohabitacion}</p>
                    </div>
                    <div class="datos">
                        <p>superficie <span id="superficie">${objeto[i].superficie}</span>m<sup>2</sup></p>
                        <p>capacidad maxima <span id="capacidad">${objeto[i].capacidad_maxima}</span> personas</p>
                    </div>
                    <p><span id="precio">${objeto[i].precio}</span> Bs por noche</p>
                </div>`;
    }

    grid += `</div>`;

    return fetch("formbuscadorhabitaciones.php")
        .then((response) => response.text())
        .then((formulario) => {
            return formulario + grid;
        });
}

function readHabitacion(id) {
    const contenedor = document.getElementById("contenido");
    if (contenedor) {
        contenedor.scrollTop = 0;
    }

    fetch("readhabitacion.php?id=" + id)
        .then((response) => response.json())
        .then((data) => {
            const objeto = data;
            document.getElementById("contenido").innerHTML = renderizarHabitacion(objeto);
            initCalendarioReserva(objeto.habitacion.id, objeto.habitacion.precio);
            if (contenedor) {
                contenedor.scrollTop = 0;
            }
        });
}

function renderizarHabitacion(objeto) {
    let html = `<div class="container-habitacion">
        <header class="header">
            <div class="hotel-info">
                <div class="hotel-details">
                    <div>🏢 Sucursal:</div>
                    <h1>${objeto.habitacion.nombresucursal}</h1>
                    <div class="hotel-contact">
                        <div>📍 ${objeto.habitacion.direccion}</div>
                        <div>📞 ${objeto.habitacion.telefono}</div>
                        <div>✉️ ${objeto.habitacion.email}</div>
                    </div>
                </div>
            </div>
        </header>

        <section class="photos-section">
            <h2 class="photos-title">Galería de Fotografías</h2>
            ${carousel(objeto.fotografias, objeto.habitacion.nombrehabitacion)}
        </section>

        
           

            
            


        <main class="room-section">
            <div class="room-header">
                <h2 class="room-title">${objeto.habitacion.nombrehabitacion} (Tipo: ${objeto.habitacion.nombretipohabitacion})</h2>
                <div class="room-number">Nº de habitación: ${objeto.habitacion.numero}</div>
            </div>

            <div class="room-details">
                <div class="detail-card">
                    <div class="detail-icon">🏢</div>
                    <div class="detail-value">${objeto.habitacion.piso}</div>
                    <div class="detail-label">Piso</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-icon">📐</div>
                    <div class="detail-value">${objeto.habitacion.superficie} m²</div>
                    <div class="detail-label">Superficie</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-icon">🛏️</div>
                    <div class="detail-value">${objeto.habitacion.nro_camas} Cama</div>
                    <div class="detail-label">Camas</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-icon">👤</div>
                    <div class="detail-value">${objeto.habitacion.capacidad_maxima} Persona</div>
                    <div class="detail-label">Capacidad</div>
                </div>
            </div>

            <div class="description">
                <strong>Descripción:</strong> ${objeto.habitacion.descripcion}
            </div>
        </main>


         <div class="seccion-reserva-ticket">
                <div>
                    Bs.${objeto.habitacion.precio} / noche
                </div>
                <h2 class="titulo-reserva-ticket">Reserva</h2>
                <div class="grupo-fecha">
                    <label class="etiqueta-fecha" for="fecha-entrada">Fecha de entrada:</label>
                    <input class="campo-fecha" type="text" id="fecha-entrada" placeholder="Seleccionar">
                </div>
                <div class="grupo-fecha">
                    <label class="etiqueta-fecha" for="fecha-salida">Fecha de salida:</label>
                    <input class="campo-fecha" type="text" id="fecha-salida" placeholder="Seleccionar">
                </div>
                <div>
                    <label class="etiqueta-fecha" for="huespedes">Huespedes</label>
                    <input class="campo-fecha" type="number" id="huespedes" value="1" min="1" max="${objeto.habitacion.capacidad_maxima}">
                </div>
                <p id="dias" class="texto-dias"></p>
                <p id="precio-total" class="texto-precio-total"></p>
                <button class="boton-reservar-ticket"
        onclick="reservarHabitacion(${objeto.habitacion.id}, window.modoReservaAdmin ? (window.usuarioSeleccionadoReserva || '') : '')">
    Reservar
</button>
            </div>


            <div class="payment-section" id="payment-section">
                <h3>Realizar Pago</h3>
                <div class="payment-options">
                    <button type="button" class="btn-payment" id="boton-pagar">Pagar con Tarjeta</button>
                    <div class="payment-info">
                        <p><small>Se le pedirán los últimos 4 dígitos de su tarjeta para confirmar el pago.</small></p>
                    </div>
                </div>
            </div>
        

        
    </div>
    
    

    
    `;
    return html;
}


function carousel(images, title) {
    const carouselHTML = `
        <div class="carousel-fullscreen" style="display: none;">
            <div class="carousel-slide active">
                <img src="images/${images[0].fotografia}" alt="${images[0].nombre || title}">
                <div class="slide-caption">
                    <div class="slide-title">${images[0].nombre || title}</div>
                    <div class="slide-type">${images[0].tipo || ''}</div>
                </div>
            </div>
            <button class="carousel-close" onclick="closeCarousel()">&times;</button>
            <button class="carousel-control prev" onclick="changeCarouselSlide(-1)">
                <span>&#10094;</span>
            </button>
            <button class="carousel-control next" onclick="changeCarouselSlide(1)">
                <span>&#10095;</span>
            </button>
        </div>
        <div class="carousel-thumbnails">
            ${images.map((img, index) => `
                <div class="thumbnail" onclick="openCarousel(${index})">
                    <img src="images/${img.fotografia}" alt="${img.nombre || title}">
                    <div class="slide-caption">
                        <div class="slide-title">${img.nombre || title}</div>
                        <div class="slide-type">${img.tipo || ''}</div>
                    </div>
                </div>
            `).join('')}
        </div>
    `;

    if (!document.getElementById('carousel-styles')) {
        const style = document.createElement('style');
        style.id = 'carousel-styles';
        document.head.appendChild(style);
    }

    setTimeout(() => {
        let currentIndex = 0;
        let slides = [];

        window.openCarousel = (index) => {
            currentIndex = index;
            const carousel = document.querySelector('.carousel-fullscreen');
            carousel.style.display = 'flex';
            updateCarousel();
        };

        window.closeCarousel = () => {
            const carousel = document.querySelector('.carousel-fullscreen');
            carousel.style.display = 'none';
        };

        window.changeCarouselSlide = (n) => {
            currentIndex = (currentIndex + n + images.length) % images.length;
            updateCarousel();
        };

        function updateCarousel() {
            const carousel = document.querySelector('.carousel-fullscreen');
            if (!carousel) return;

            // Update the active slide
            const slide = carousel.querySelector('.carousel-slide');
            slide.innerHTML = `
                <img src="images/${images[currentIndex].fotografia}" alt="${images[currentIndex].nombre || title}">
                <div class="slide-caption">
                    <div class="slide-title">${images[currentIndex].nombre || title}</div>
                    <div class="slide-type">${images[currentIndex].tipo || ''}</div>
                </div>
            `;
        }

        document.addEventListener('keydown', (e) => {
            const carousel = document.querySelector('.carousel-fullscreen');
            if (carousel && carousel.style && carousel.style.display !== 'none') {
                if (e.key === 'ArrowLeft') {
                    changeCarouselSlide(-1);
                } else if (e.key === 'ArrowRight') {
                    changeCarouselSlide(1);
                } else if (e.key === 'Escape') {
                    closeCarousel();
                }
            }
        });
    }, 0);

    return carouselHTML;
}





function initCalendarioReserva(habitacionId, precioNoche) {
    let precioUnitario = parseFloat(String(precioNoche).replace(/[^0-9.]/g, '')) || 0;
    
    

    
    fetch(`fechasreservadashabitacion.php?id=${habitacionId}`)
        .then(r => r.json())
        .then(rangos => {
            flatpickr("#fecha-entrada", {
                locale: "es",
                plugins: [new rangePlugin({ input: "#fecha-salida" })],
                minDate: "today",
                disable: rangos,        // bloquea rangos ya reservados
                onChange: function (sel) {
                    if (sel.length === 2) {
                        const diff = Math.ceil(
                            (sel[1] - sel[0]) / 86400000
                        );
                        document.getElementById("dias").textContent =
                            diff + " noches";
                        const total = (diff * precioUnitario).toFixed(2);
                        document.getElementById("precio-total").textContent =
                            "Total: Bs. " + total;
                        
                        const precioTotalInput = document.getElementById("precio-total-numero") || 
                            (() => {
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.id = 'precio-total-numero';
                                document.body.appendChild(input);
                                return input;
                            })();
                        precioTotalInput.value = total;
                    } else {
                        document.getElementById("dias").textContent = "";
                        document.getElementById("precio-total").textContent = "";
                    }
                }
            });
        });
}


function reservarHabitacion(habitacionId, idUsuario="") {
    window.habitacionActualId = habitacionId;
    const fechaEntrada = document.getElementById("fecha-entrada").value;
    const fechaSalida = document.getElementById("fecha-salida").value;
    const dias = document.getElementById("dias").textContent;
    const precioTotalInput = document.getElementById("precio-total-numero");
    const precioTotal = precioTotalInput ? parseFloat(precioTotalInput.value) : 0;
    const huespedes = document.getElementById("huespedes").value;

    if (!fechaEntrada || !fechaSalida || !dias || !precioTotal || !huespedes) {
        alert("Por favor, complete todos los campos.");
        return;
    }
    if (isNaN(huespedes) || huespedes < 1) {
        alert("Por favor, ingrese un número válido de huéspedes.");
        return;
    }
    const datosReserva = {
        id: habitacionId,
        fechaEntrada: fechaEntrada,
        fechaSalida: fechaSalida,
        dias: dias,
        precioTotal: precioTotal,
        huespedes: huespedes,
        idUsuario: idUsuario
    };


    fetch("reservarhabitacion.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(datosReserva)
    })
        .then(response => response.text())
        .then(r => {
            if (!isNaN(r)) {                 // r ahora es el id de la reserva
                alert("Reserva registrada con éxito. Procedamos al pago.");
                simularPago(r, precioTotal); 
            } else {
                console.error("Error del servidor:", r);
                alert("Error al realizar la reserva.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Ocurrió un error al procesar la solicitud.");
        });
}


function simularPago(reservaId, montoTexto) {

    const paymentSection = document.getElementById("payment-section");
    if (paymentSection) {
        paymentSection.style.display = "block";
    }


    let botonCancelar = document.querySelector("button.boton-reservar-ticket");
    if (!botonCancelar) {
        botonCancelar = document.createElement('button');
        botonCancelar.className = 'boton-reservar-ticket';
        document.body.appendChild(botonCancelar);
    }
    botonCancelar.textContent = "Cancelar Reserva";


    let botonPagar = document.getElementById('boton-pagar');
    if (!botonPagar) {
        botonPagar = document.createElement('button');
        botonPagar.id = 'boton-pagar';
        botonPagar.className = 'boton-pagar-ticket';
        botonPagar.textContent = 'Pagar ahora';
        paymentSection?.appendChild(botonPagar);
    }
    botonPagar.style.display = 'inline-block';


    const habitacionId = window.habitacionActualId;


    botonCancelar.onclick = async () => {
        if (!confirm("¿Está seguro que desea cancelar esta reserva?")) return;
        try {
            const resp = await fetch("cancelarreserva.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded", "Accept": "application/json" },
                body: new URLSearchParams({ reserva_id: reservaId })
            });
            const data = await resp.json();
            if (!data.success) throw new Error(data.message || 'Error al cancelar');

            alert(data.message || 'Reserva cancelada');
            botonCancelar.textContent = 'Reservar Habitación';
            botonCancelar.onclick   = () => reservarHabitacion(habitacionId);
            botonPagar.style.display = 'none';
            paymentSection && (paymentSection.style.display = 'none');
        } catch (e) {
            alert(`Error al cancelar la reserva: ${e.message}`);
        }
    };


    botonPagar.onclick = async () => {
        try {
            // Mostrar diálogo para ingresar los últimos 4 dígitos de la tarjeta
            const ultimosDigitos = prompt("Ingrese los últimos 4 dígitos de su tarjeta:");
            
            if (!ultimosDigitos || ultimosDigitos.length !== 4 || isNaN(ultimosDigitos)) {
                alert("Por favor ingrese los últimos 4 dígitos de su tarjeta");
                return;
            }

            const resp = await fetch('crearpago.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'Accept': 'application/json' },
                body: new URLSearchParams({ 
                    reserva_id: reservaId, 
                    metodo: 'tarjeta-simulada',
                    ultimos_digitos: ultimosDigitos,
                    monto: montoTexto
                })
            });
            
            const data = await resp.json();
            if (!data.success) throw new Error(data.error || 'No se pudo procesar el pago');

            alert('Pago realizado correctamente. ¡Gracias por su compra!');
            botonPagar.style.display = 'none';
            botonCancelar.style.display = 'none';
            
            readDetalleReserva(reservaId);
        } catch (e) {
            console.error('Error en el pago:', e);
            alert(`Error al procesar el pago: ${e.message}`);
        }
    };
}

function formReserva() {
    window.modoReservaAdmin = true;
    window.usuarioSeleccionadoReserva = "";
    document.getElementById("contenido").innerHTML = `
        <h2>Nueva reserva</h2>
        <div id="usuariosContainer" class="mb-3"></div>
        <div id="habitacionesContainer"></div>
    `;
    cargarUsuariosParaReserva();
}

function cargarUsuariosParaReserva() {
    fetch("readusuarios.php")
        .then(r => r.json())
        .then(usuarios => {
            const div = document.getElementById("usuariosContainer");
            let html = `<label>Seleccionar usuario: </label>
                        <select id="selectUsuario" class="form-control w-auto d-inline">
                            <option value="">-- Elija uno --</option>`;
            usuarios.forEach(u => {
                html += `<option value="${u.id}">${u.nombre_completo}</option>`;
            });
            html += `</select>`;
            div.innerHTML = html;

            document.getElementById("selectUsuario").addEventListener("change", e => {
                const id = e.target.value;
                window.usuarioSeleccionadoReserva = id || "";   // ← guardamos global
                document.getElementById("habitacionesContainer").innerHTML = "";
                if (id) mostrarHabitacionesParaUsuario();
            });
        });
}

function mostrarHabitacionesParaUsuario() {
    fetch("readhabitaciones.php")
        .then(r => r.json())
        .then(data => renderizarGridHabitaciones(data, "", "", ""))
        .then(html => {
            document.getElementById("habitacionesContainer").innerHTML = html;
        });
}

function readReservasUser(id) {
    fetch("readreservasuser.php?id=" + id)
        .then((response) => response.json())
        .then((data) => {
            const objeto = data;
            document.getElementById("contenido").innerHTML = renderizarTablaReservasUser(objeto);
        });
}


function renderizarTablaReservasUser(objeto) {
    let html = `
        <table>
            <tr>
                <th>Habitación</th>
                <th>Número</th>
                <th>Precio</th>
                <th>Fecha Reserva</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Salida</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>`;
    
    for (let i = 0; i < objeto.length; i++) {
        html += `
            <tr>
                <td>${objeto[i].habitacion_nombre}</td>
                <td>${objeto[i].habitacion_numero}</td>
                <td>${objeto[i].precio} Bs</td>
                <td>${objeto[i].fecha_reserva}</td>
                <td>${objeto[i].fecha_ingreso}</td>
                <td>${objeto[i].fecha_salida}</td>
                <td>${objeto[i].finalizada ? "Pendiente" : "Pagado"}</td>
                <td>
                    <button class="btn-ver" onclick="readDetalleReserva(${objeto[i].reserva_id})">
                        <i class="fa-solid fa-eye"></i> Ver
                    </button>
                    ${!objeto[i].finalizada ? "" : `<button class="btn-cancelar" onclick="eliminarReservaUser(${objeto[i].reserva_id}, ${objeto[i].usuario_id})">
                        <i class="fa-solid fa-trash"></i> Eliminar
                    </button>`}
                </td>
            </tr>`;
    }
    return html + "</table>";
}

function readDetalleReserva(reservaId) {
    fetch("readreserva.php?id=" + reservaId)
        .then((response) => response.json())
        .then((data) => {
            const objeto = data;
            document.getElementById("contenido").innerHTML = renderizarDetalleReserva(objeto);
        });
}


function renderizarDetalleReserva(objeto) {
    const h   = objeto.habitacion;
    console.log('Estado de la reserva:', h.estado, 'Tipo:', typeof h.estado); // Debug log
    const pagado = (h.estado == 1);          // 1 = pagado, 0 = pendiente
    const badge = pagado ? `<span class="badge-paid">Pagado</span>`
                         : `<span class="badge-pend">Pendiente</span>`;

    let html = `<div class="container-habitacion">
        <header class="header">
            <div class="hotel-info">
                <div class="hotel-details">
                    <div>🏢 Sucursal:</div>
                    <h1>${h.nombresucursal}</h1>
                    <div class="hotel-contact">
                        <div>📍 ${h.direccion}</div>
                        <div>📞 ${h.telefono}</div>
                        <div>✉️ ${h.email}</div>
                    </div>
                </div>
            </div>
        </header>

        <section class="photos-section">
            <h2 class="photos-title">Galería de Fotografías</h2>
            ${carousel(objeto.fotografias, h.nombrehabitacion)}
        </section>

        <main class="room-section">
            <div class="room-header">
                <h2 class="room-title">${h.nombrehabitacion} (${h.nombretipohabitacion}) ${badge}</h2>
                <div class="room-number">Reserva #${h.reserva_id} – Hab. ${h.numero}</div>
            </div>

            <div class="room-details">
                <div class="detail-card">
                    <div class="detail-icon">🏢</div>
                    <div class="detail-value">${h.piso}</div>
                    <div class="detail-label">Piso</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-icon">📐</div>
                    <div class="detail-value">${h.superficie} m²</div>
                    <div class="detail-label">Superficie</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-icon">🛏️</div>
                    <div class="detail-value">${h.nro_camas} Cama</div>
                    <div class="detail-label">Camas</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-icon">👤</div>
                    <div class="detail-value">${h.capacidad_maxima} Persona</div>
                    <div class="detail-label">Capacidad</div>
                </div>
            </div>

            <div class="description">
                <strong>Descripción:</strong> ${h.descripcion}
            </div>
        </main>
        <div class="room-details">
        
        <div class="detail-card">
            <div class="detail-icon">📅</div>
            <div class="detail-value">${h.precio_total}</div>
            <div class="detail-label">Precio Total</div>
        </div>
            <div class="detail-card">
                <div class="detail-icon">📅</div>
                <div class="detail-value">${h.fecha_ingreso}</div>
                <div class="detail-label">Fecha Ingreso</div>
            </div>
            <div class="detail-card">
                <div class="detail-icon">📅</div>
                <div class="detail-value">${h.fecha_salida}</div>
                <div class="detail-label">Fecha Salida</div>
            </div>
        </div>
        `;

    if (pagado) {
        html += `
        <div class="ticket-container">
            <div class="ticket">
                <div class="ticket-header">
                    <div class="ticket-status">
                        <i class="fas fa-check-circle"></i>
                        <span>Pago Confirmado</span>
                    </div>
                    <div class="ticket-code">habitacion #${h.numero}</div>
                </div>
                <div class="ticket-body">
                    <div class="ticket-info">
                        <div class="info-row">
                            <span class="info-label">Usuario:</span>
                            <span class="info-value">${h.nombre_usuario}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Fecha de Reserva:</span>
                            <span class="info-value">${h.fecha_reserva}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Fecha Ingreso:</span>
                            <span class="info-value">${h.fecha_ingreso}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Fecha Salida:</span>
                            <span class="info-value">${h.fecha_salida}</span>
                        </div>
                        <div class="info-total">
                            <span>Total Pagado:</span>
                            <span class="amount">Bs. ${h.precio_total}</span>
                        </div>
                    </div>
                </div>
                <div class="ticket-footer">
                    <div class="thank-you">¡Gracias por su preferencia!</div>
                    <div class="hotel-name">${h.nombresucursal || 'Hotel'}</div>
                </div>
            </div>
        </div>`;
    } else {
            html += `<div class="payment-section" id="payment-section">
                        <h3>Realizar Pago</h3>
                        <div class="payment-options">
                            <button type="button" class="btn-payment" onclick="simularPago(${h.reserva_id}, '${h.precio_total}')">Pagar con Tarjeta</button>
                            <div class="payment-info">
                                <p><small>Se le pedirán los últimos 4 dígitos de su tarjeta para confirmar el pago.</small></p>
                            </div>
                        </div>
                    </div>
                    <style>
                        .payment-section {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            margin-top: 20px;
                        }
                        .payment-options {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                        }
                        .btn-payment {
                            margin-top: 10px;
                        }
                        .payment-info {
                            margin-top: 5px;
                        }
                    </style>`;
    }

    html += `</div>`;
    return html;
}


function readPagos() {
    fetch("readpagos.php")
        .then((response) => response.json())
        .then((data) => {
            const objeto = data;
            document.getElementById("contenido").innerHTML = renderizarTablaPagos(objeto);
        });
}

function renderizarTablaPagos(objeto) {
    let html = `<table>
        <tr>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Habitación</th>
            <th>Sucursal</th>
            <th>Monto</th>
            <th>Método de Pago</th>
            <th>Referencia</th>
            <th>Estado</th>
        </tr>`;
        
    for (let i = 0; i < objeto.length; i++) {
        html += `
            <tr>
                <td>${objeto[i].fecha}</td>
                <td>${objeto[i].cliente}</td>
                <td>${objeto[i].habitacion}</td>
                <td>${objeto[i].sucursal}</td>
                <td>${objeto[i].monto}</td>
                <td>${objeto[i].metodo_pago}</td>
                <td>${objeto[i].referencia}</td>
                <td>${objeto[i].estado}</td>
            </tr>`;
        }
    return html + "</table>";
}


function readReservas() {
    fetch("readreservas.php")
        .then((response) => response.json())
        .then((data) => {
            const objeto = data;
            document.getElementById("contenido").innerHTML = renderizarTablaReservas(objeto);
        });
}


function renderizarTablaReservas(objeto) {
    let html = `<button onclick="javascript:formReserva();">Nueva Reserva</button>
    <table>
        <tr>            
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Habitación</th>
            <th>Sucursal</th>
            <th>Fecha Ingreso</th>
            <th>Fecha Salida</th>
            <th>Precio Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>`;
        
    for (let i = 0; i < objeto.length; i++) {
        html += `
            <tr>
                <td>${objeto[i].fecha_reserva}</td>
                <td>${objeto[i].cliente}</td>
                <td>${objeto[i].habitacion}</td>
                <td>${objeto[i].sucursal}</td>
                <td>${objeto[i].ingreso}</td>
                <td>${objeto[i].salida}</td>
                <td>${objeto[i].precio_total}</td>
                <td>${objeto[i].estado}</td>
                <td class="text-center">
                    ${objeto[i].estado === 'pagada' ? 
                        `<button class="btn btn-sm btn-info" onclick="readDetalleReserva('${objeto[i].id}')">
                            <i class="fas fa-eye"></i> Ver
                        </button>` 
                        : 
                        `
                        <button class="btn btn-sm btn-warning mr-1" onclick="formEditarReserva('${objeto[i].id}')">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarReserva('${objeto[i].id}')">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                        `
                    }
                </td>
            </tr>`;
        }
    return html + "</table>";
}


function formEditarReserva(id) {
    fetch("formeditarreserva.php?id=" + id)
        .then((response) => response.json())
        .then((data) => {
            const objeto = data;
            document.getElementById("contenido").innerHTML = readDetalleReserva(objeto.reserva.id);
        });
}

function eliminarReserva(id) {
    if (!confirm("¿Está seguro que desea cancelar esta reserva?")) return;
    
    fetch("cancelarreserva.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ reserva_id: id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message || 'Reserva cancelada con éxito');
            readReservas(); // Actualizar la lista de reservas
        } else {
            throw new Error(data.message || 'Error al cancelar la reserva');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message);
    });
}

function eliminarReservaUser(id, userId) {
    if (!confirm("¿Está seguro que desea cancelar esta reserva?")) return;
    
    fetch("cancelarreserva.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ reserva_id: id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message || 'Reserva cancelada con éxito');
            readReservasUser(userId); // Recargar la lista de reservas del usuario
        } else {
            throw new Error(data.message || 'Error al cancelar la reserva');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message);
    });
}
