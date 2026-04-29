<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Sesiones</title>
    <link rel="stylesheet" href="/MyPsiqueTFG/public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/MyPsiqueTFG/public/styles/custom/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
    #calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }

    .day {
        border: 1px solid #ccc;
        padding: 10px;
        min-height: 80px;
    }

    .day:hover {
        background-color: #f0f0f0;
        cursor: pointer;
    }

    .header {
        font-weight: bold;
        text-align: center;
    }
</style>
<body>
    <?php include '../layouts/header.php';  
        $psicologoId = $_GET['id'] ?? null;
        
    ?>
    
    <div class="m-5 p-5">
        <!-- BOTONES DE NAVEGACIÓN DE MES -->
        <div class="d-flex justify-content-between mb-3">
            <button id="MesAntes" class="btn btn-primary">Mes Anterior</button>
            <h2 id="currentMonth" class="text-center"></h2>
            <button id="MesDespues" class="btn btn-primary">Mes Siguiente</button>
        </div>
        <!-- CALENDARIO -->
        <div id="calendar"></div>
    </div>
    <!-- CONTENIDO AL SELECCIONAR UN DIA -->
    <div style="display: none;" id="SeleccionarDia" class="modal fade" tabindex="-1" aria-labelledby="SeleccionarDiaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <div>
                        <h5 class="modal-title" id="SeleccionarDiaLabel">Selecciona una hora</h5>
                        <small class="text-white-50" id="fechaHeaderModal"></small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                
                <div class="modal-body">
                    
                    <div class="alert alert-info mb-4" role="alert">
                        <div class="row">
                            <div class="col-md-4">
                                <span class="badge bg-success me-2">Libre</span> Hora sin sesiones
                            </div>
                            <div class="col-md-4">
                                <span class="badge bg-secondary me-2">Ocupada</span> Hora con sesión
                            </div>
                            <div class="col-md-4">
                                <span class="badge bg-secondary me-2 disabled">No disponible</span> No seleccionable
                            </div>
                        </div>
                    </div>

                    
                    <div class="row g-2" id="horasGrid">
                        
                    </div>
                </div>

                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    
    <div style="display: none;" id="EditarSesionModal" class="modal fade" tabindex="-1" aria-labelledby="EditarSesionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="EditarSesionLabel">Editar sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div id="infoSesion"></div>
                <hr>
                <button id="btnEliminarPaciente" class="btn btn-danger mb-2 w-100">Eliminar paciente</button>
                <button id="btnMarcarDisponible" class="btn btn-success mb-2 w-100">Marcar hora como disponible</button>
                <button id="btnMarcarNoDisponible" class="btn btn-secondary w-100">Marcar como no disponible</button>
                <button id="btnAutoasignacion" class="btn btn-secondary mb-2 w-100">Elegir esta sesión</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
    <?php include '../layouts/footer.php';  ?>
</body>

<script>
    // OBTENEMOS EL CALENADRIO Y LOS BOTONES DE LOS MESES
    const calendarEl = document.getElementById('calendar');
    const currentMonthEl = document.getElementById('currentMonth');
    const MesAntesBtn = document.getElementById('MesAntes');
    const MesDespuesBtn = document.getElementById('MesDespues');
    // VARIABLES PARA CONTROLAR EL MES Y AÑO ACTUAL
    let currentYear = new Date().getFullYear();
    let currentMonth = new Date().getMonth();
    let sesionPorFecha = {};
    function updateMonthDisplay() {
        const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        currentMonthEl.textContent = `${monthNames[currentMonth]} ${currentYear}`;
    }
    <?php $psicologoId = $_GET['id']; ?>
    const user_id = <?php echo json_encode($_SESSION['user_id']); ?>;
    const psicologoId = <?php echo json_encode($psicologoId); ?>;
    

    // GENERAMOS EL CALENDARIO

    async function generateCalendar(year, month) {
        calendarEl.innerHTML = '';

        const daysOfWeek = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];

        daysOfWeek.forEach(day => {
            const el = document.createElement('div');
            el.classList.add('header');
            el.textContent = day;
            calendarEl.appendChild(el);
        });

        
        const now = new Date();
        const fechaCompleta = 
        now.getFullYear() + '-' +
        String(now.getMonth() + 1).padStart(2, '0') + '-' +
        String(now.getDate()).padStart(2, '0') + ' ' +
        String(now.getHours()).padStart(2, '0') + ':' +
        String(now.getMinutes()).padStart(2, '0') + ':' +
        String(now.getSeconds()).padStart(2, '0');


        
        

        // OBTENERMOS LAS SESIONES DEL MES PARA EL PSICÓLOGO

        const response = await fetch(
            `/MyPsiqueTFG/app/controllers/CalendarioSesionesController.php?Accion=obtenerDiasMes&fecha=${fechaCompleta}&id_psicologo=${<?php echo $psicologoId; ?>}`
        );
        
        const sesiones = await response.json();

        
        sesionPorFecha = {};

        // POR CADA SESIÓN, AGRUPAMOS POR FECHA PARA SABER QUÉ DÍAS TIENEN SESIONES Y CUÁNTAS
        sesiones.forEach(sesion => {
            const fechaSesion = sesion.fecha_sesion.split(' ')[0];
            // CREAMOS ARRAY DE SESIONES POR FECHA
            if (!sesionPorFecha[fechaSesion]) {
                sesionPorFecha[fechaSesion] = [];
            }

            sesionPorFecha[fechaSesion].push(sesion);
        });

        // CALCULAMOS EL PRIMER DÍA DEL MES Y CUÁNTOS DÍAS TIENE EL MES

        const firstDay = new Date(year, month, 1).getDay();
        const totalDays = new Date(year, month + 1, 0).getDate();

        const startDay = (firstDay === 0) ? 6 : firstDay - 1;

        

        for (let i = 0; i < startDay; i++) {
            calendarEl.appendChild(document.createElement('div'));
        }
        // SE GENERAN LOS DIAS 
        for (let day = 1; day <= totalDays; day++) {
            const el = document.createElement('div');
            el.classList.add('day');
            el.textContent = day;
            // DIA CORRESPONDIENTE
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

            if (sesionPorFecha[dateStr]) {
                el.classList.add('has-session');
                el.style.backgroundColor = '#9bc9b4';
            } else {
                el.style.backgroundColor = '#f8f9fa';
            }

            el.addEventListener('click', () => {
                abrirModalHoras(dateStr, sesionPorFecha[dateStr] || []);
            });

            calendarEl.appendChild(el);
        }
    }
    
    
    
    // FUNCION PARA ABRIR EL MODAL DE HORAS DISPONIBLES CUANDO SE HACE CLICK EN UN DIA
    async function abrirModalHoras(fecha, sesionesDelDia) {
        
        

        

        const horasGrid = document.getElementById('horasGrid');
        const fechaHeader = document.getElementById('fechaHeaderModal');
        
        const dateObj = new Date(fecha);
        const opcionesFormato = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const fechaFormato = dateObj.toLocaleDateString('es-ES', opcionesFormato);

        const user_id = <?php echo json_encode($_SESSION['user_id']); ?>;
        const psicologoId = <?php echo json_encode($psicologoId); ?>;

        fechaHeader.textContent = fechaFormato.charAt(0).toUpperCase() + fechaFormato.slice(1);
        var formData = new FormData();
        
        

        await fetch(`/MyPsiqueTFG/app/controllers/CalendarioSesionesController.php?fecha=${fecha}&id_psicologo=${psicologoId}&Accion=obtenerHorasDia`, { method: 'GET'}  )
            .then(response => {
                
                return response.json();
            })
            .then(data => {
                sesionPorFecha[fecha] = data;
            })
            .catch(error => console.error('Error al cargar sesiones:', error));

        
        

        
        const horasOcupadas = new Set();
        const horasDisponibles = new Set();
        sesionesDelDia.forEach(sesion => {
            
            if (sesion.fecha_sesion) {
                if(sesion.id_paciente) {
                    
                    horasOcupadas.add(new Date(sesion.fecha_sesion).getHours());
                } else {
                    horasDisponibles.add(new Date(sesion.fecha_sesion).getHours());
                }
                
            }
        });
    
        horasGrid.innerHTML = '';
        for (let hora = 0; hora < 24; hora++) {
            const col = document.createElement('div');
            col.classList.add('col-6', 'col-md-4', 'col-lg-2');

            const estaOcupada = horasOcupadas.has(hora);
            const estaDisponible = horasDisponibles.has(hora);
            const horaNumero = String(hora).padStart(2, '0');

            

            if (estaOcupada) {
                
                if (psicologoId == user_id) {
                    col.innerHTML = `
                        <button class="btn btn-secondary w-100" onclick="seleccionarHora('${fecha}', ${hora})" style="background-color: #cc9d4c; border-color: #956a20; font-weight: 600;">
                            <strong>${horaNumero}:00</strong>
                            <small class="d-block">Ocupada</small>
                        </button>
                    `;
                } else {
                    col.innerHTML = `
                        <button class="btn btn-secondary w-100" disabled style="background-color: #cc9d4c; border-color: #956a20; font-weight: 600;">
                            <strong>${horaNumero}:00</strong>
                            <small class="d-block">Ocupada</small>
                        </button>
                    `;
                }       

            }  else if (estaDisponible) {
                col.innerHTML = `
                    <button class="btn btn-success w-100" onclick="seleccionarHora('${fecha}', ${hora})" style="background-color: #28a745; border-color: #28a745; font-weight: 600;">
                        <strong>${horaNumero}:00</strong>
                        <small class="d-block">Disponible</small>
                    </button>
                `;

            } else {

                if (psicologoId == user_id) {
                    col.innerHTML = `
                        <button class="btn btn-secondary w-100" onclick="seleccionarHora('${fecha}', ${hora})" style="background-color: #6c757d; border-color: #6c757d; font-weight: 600;">
                            <strong>${horaNumero}:00</strong>
                            <small class="d-block">No disponible</small>
                        </button>
                    `;
                } else {

                    col.innerHTML = `
                        <button class="btn btn-secondary w-100" disabled style="background-color: #6c757d; border-color: #6c757d; font-weight: 600;">
                            <strong>${horaNumero}:00</strong>
                            <small class="d-block">No disponible</small>
                        </button>
                    `;
                }

            }

            horasGrid.appendChild(col);
        }

        // Mostrar modal
        const modal = new bootstrap.Modal(document.getElementById('SeleccionarDia'));
        modal.show();
    }

    
    
    // EVENTOS PARA NAVEGAR ENTRE MESES
    MesAntesBtn.addEventListener('click',async () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        updateMonthDisplay();
        generateCalendar(currentYear, currentMonth);
        await fetch(`/MyPsiqueTFG/app/controllers/CalendarioSesionesController.php?fecha=${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-01&id_psicologo=${psicologoId}&Accion=obtenerDiasMes`, { method: 'GET'}  )
            .then(response => {
                return response.json();
            })
            .then(data => {
                sesionPorFecha = {};
                data.forEach(sesion => {
                    const fechaSesion = sesion.fecha_sesion.split(' ')[0];
                    if (!sesionPorFecha[fechaSesion]) {
                        sesionPorFecha[fechaSesion] = [];
                    }
                    sesionPorFecha[fechaSesion].push(sesion);
                });
            })
            .catch(error => console.error('Error al cargar sesiones:', error));
    });
    
    MesDespuesBtn.addEventListener('click',async () =>  {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        updateMonthDisplay();
        generateCalendar(currentYear, currentMonth);
        await fetch(`/MyPsiqueTFG/app/controllers/CalendarioSesionesController.php?fecha=${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-01&id_psicologo=${psicologoId}&Accion=obtenerDiasMes`, { method: 'GET'}  )
            .then(response => {
                return response.json();
            })
            .then(data => {
                sesionPorFecha = {};
                data.forEach(sesion => {
                    const fechaSesion = sesion.fecha_sesion.split(' ')[0];
                    if (!sesionPorFecha[fechaSesion]) {
                        sesionPorFecha[fechaSesion] = [];
                    }
                    sesionPorFecha[fechaSesion].push(sesion);
                });
            })
            .catch(error => console.error('Error al cargar sesiones:', error));
    });
    // CARGA INICIAL
    updateMonthDisplay();
    generateCalendar(currentYear, currentMonth);

    function seleccionarHora(fecha, hora) {

        

        const infoSesion = document.getElementById('infoSesion');
        const horaFormateada = String(hora).padStart(2, '0') + ':00';
        
        

        const sesionesDelDia = sesionPorFecha[fecha] || [];
        const sesionExistente = sesionesDelDia.find(sesion => {
            const inicioHora = new Date(sesion.fecha_sesion).getHours();
            
            return inicioHora === hora;
        });
        
        if (sesionExistente ) {
            // Si existe sesión, mostrar datos para editar
            console.log("EDITAR LA SESION EXISTENTE ", sesionExistente);
            infoSesion.innerHTML = `
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"> ${fecha} - ${horaFormateada}</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>Paciente:</strong> ${sesionExistente.id_paciente || 'No especificado'}</p>
                                <p><strong>Duración:</strong> 1 Hora</p>
                            </div>
                            <div class="col-sm-6">
                                
                                <p><strong>Notas:</strong> ${sesionExistente.notas || 'Sin notas'}</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Configurar botones para sesión existente
            configurarBotonesEdicion(sesionExistente, fecha, hora);
        } else {
            // Si no existe sesión, mostrar para crear nueva
            infoSesion.innerHTML = `
                <div class="alert alert-success">
                    <h6>✅ Hora disponible</h6>
                    <p><strong>Fecha:</strong> ${fecha}</p>
                    <p><strong>Hora:</strong> ${horaFormateada}</p>
                    <p>Esta hora está libre para agendar una nueva sesión.</p>
                </div>
            `;
            
            // Configurar botones para crear sesión
            configurarBotonesCreacion(fecha, hora);
        }
        
        // Mostrar modal de edición
        const modalEdicion = new bootstrap.Modal(document.getElementById('EditarSesionModal'));
        modalEdicion.show();
        
        // Cerrar modal anterior
        const modalSeleccion = bootstrap.Modal.getInstance(document.getElementById('SeleccionarDia'));
        if (modalSeleccion) modalSeleccion.hide();
    }


    // Configurar botones para sesión existente
    function configurarBotonesEdicion(sesion, fecha, hora) {
        console.log("Configurar  sesión existente:", sesion);

        const btnEliminar = document.getElementById('btnEliminarPaciente');
        const btnDisponible = document.getElementById('btnMarcarDisponible');
        const btnNoDisponible = document.getElementById('btnMarcarNoDisponible');
        const btnAutoasignacion = document.getElementById('btnAutoasignacion');
        // BOTONES DE PACIENTE
        if ( psicologoId != user_id) {
            btnEliminar.style.display = 'none';
            btnDisponible.style.display = 'none';
            btnNoDisponible.style.display = 'none';
            btnAutoasignacion.style.display = 'block';
            
            
        } else {
            // BOTONES DE PSICOLOGO
            btnEliminar.style.display = 'block';
            btnDisponible.style.display = 'block';
            btnNoDisponible.style.display = 'block';
            btnAutoasignacion.style.display = 'none';
        }
        
        // Configurar eventos
        btnEliminar.onclick = () => eliminarPacienteSesion(sesion.id, fecha, hora);
        btnDisponible.onclick = () => marcarDisponible(fecha, hora);
        btnNoDisponible.onclick = () => eliminarSesion(fecha, hora);
        btnAutoasignacion.onclick = () => reservarSesion(sesion.id, fecha, hora);
    }

    // Configurar botones para crear sesión

    // CAMBIAR CUANDO EL USUARIO ES PACIENTE O PSICOLOGO 
    function configurarBotonesCreacion(fecha, hora) {

        console.log("Botones Crear ")
        
        const btnEliminar = document.getElementById('btnEliminarPaciente');
        const btnDisponible = document.getElementById('btnMarcarDisponible');
        const btnNoDisponible = document.getElementById('btnMarcarNoDisponible');
        const btnAutoasignacion = document.getElementById('btnAutoasignacion');

        if (psicologoId == user_id) {
            console.log("ERES PSICOLOGO PARA CREAR SESION")
            
            btnAutoasignacion.style.display = 'none';
            btnEliminar.style.display = 'none';
            btnDisponible.style.display = 'block';
            btnNoDisponible.style.display = 'block';
            
            // Cambiar textos
            btnDisponible.innerHTML = '➕ Crear nueva sesión';
            btnNoDisponible.innerHTML = '🚫 Marcar como no disponible';
            
            // Configurar eventos
            btnDisponible.onclick = () => crearSesion(fecha, hora);
            btnNoDisponible.onclick = () => marcarNoDisponible(fecha, hora);


        } else {
            console.log("ERES PACIENTE PARA RESERVAR")
            



        }
        
        // Ocultar botón eliminar, mostrar otros
        
    }

    function crearSesion(fecha, hora) {
        fetch('/MyPsiqueTFG/app/controllers/CalendarioSesionesController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id_psicologo: psicologoId,
                id_paciente: null,
                fecha_sesion: `${fecha.split(' ')[0]} ${String(hora).padStart(2, '0')}:00:00`,
                fecha_fin: `${fecha.split(' ')[0]} ${String(hora + 1).padStart(2, '0')}:00:00`,
                resumen: '',
                titulo: 'Sesión programada'
            })
        })

        alert("SESION CREADA " )
    }

    function reservarSesion(sesionId, fecha, hora){
        fetch('/MyPsiqueTFG/app/controllers/CalendarioSesionesController.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: sesionId,
                id_psicologo: psicologoId,
                id_paciente: user_id,
                fecha_sesion: `${fecha.split(' ')[0]} ${String(hora).padStart(2, '0')}:00:00`,
                fecha_fin: `${fecha.split(' ')[0]} ${String(hora + 1).padStart(2, '0')}:00:00`,
                resumen: '',
                titulo: 'Sesión reservada'
            })
        })

        alert("SESION RESERVADA " )
    }

    function eliminarPacienteSesion(sesionId, fecha, hora){
        fetch('/MyPsiqueTFG/app/controllers/CalendarioSesionesController.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: sesionId,
                id_psicologo: psicologoId,
                id_paciente: null,
                fecha_sesion: `${fecha.split(' ')[0]} ${String(hora).padStart(2, '0')}:00:00`,
                fecha_fin: `${fecha.split(' ')[0]} ${String(hora + 1).padStart(2, '0')}:00:00`,
                resumen: '',
                titulo: 'Sesión disponible'
            })
        })

        
    }
    
    function eliminarSesion(fecha, hora){
        fetch('/MyPsiqueTFG/app/controllers/CalendarioSesionesController.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id_psicologo: psicologoId,
                
                fecha_sesion: `${fecha.split(' ')[0]} ${String(hora).padStart(2, '0')}:00:00`,
                
                
            })
        })

        alert("SESION ELIMINADA " )
    }
</script>
</html>