<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <div class="d-flex justify-content-between mb-3">
            <button id="MesAntes" class="btn btn-primary">Mes Anterior</button>
            <h2 id="currentMonth" class="text-center"></h2>
            <button id="MesDespues" class="btn btn-primary">Mes Siguiente</button>
        </div>
        <div id="calendar"></div>
    </div>

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
    <?php include '../layouts/footer.php';  ?>
</body>

<script>
    const calendarEl = document.getElementById('calendar');
    const currentMonthEl = document.getElementById('currentMonth');
    const MesAntesBtn = document.getElementById('MesAntes');
    const MesDespuesBtn = document.getElementById('MesDespues');

    let currentYear = new Date().getFullYear();
    let currentMonth = new Date().getMonth();

    function updateMonthDisplay() {
        const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        currentMonthEl.textContent = `${monthNames[currentMonth]} ${currentYear}`;
    }
    let sesionPorFecha = {};
    function generateCalendar(year, month) {
        calendarEl.innerHTML = '';

        const daysOfWeek = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];

        daysOfWeek.forEach(day => {
            const el = document.createElement('div');
            el.classList.add('header');
            el.textContent = day;
            calendarEl.appendChild(el);
        });

        const firstDay = new Date(year, month, 1).getDay();
        const totalDays = new Date(year, month + 1, 0).getDate();

        const startDay = (firstDay === 0) ? 6 : firstDay - 1;

        for (let i = 0; i < startDay; i++) {
            calendarEl.appendChild(document.createElement('div'));
        }

        for (let day = 1; day <= totalDays; day++) {
            const el = document.createElement('div');
            el.classList.add('day');
            el.textContent = day;
            calendarEl.appendChild(el);

            
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

            el.addEventListener('click', () => {
                abrirModalHoras(dateStr, sesionPorFecha[dateStr] || []);
            });
        }
    }

    function abrirModalHoras(fecha, sesionesDelDia) {
        const horasGrid = document.getElementById('horasGrid');
        const fechaHeader = document.getElementById('fechaHeaderModal');
        
        
        const dateObj = new Date(fecha + 'T00:00:00');
        const opcionesFormato = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const fechaFormato = dateObj.toLocaleDateString('es-ES', opcionesFormato);
        fechaHeader.textContent = fechaFormato.charAt(0).toUpperCase() + fechaFormato.slice(1);

        
        const horasOcupadas = new Set();
        sesionesDelDia.forEach(sesion => {
            const inicio = new Date(sesion.fecha_inicio);
            const fin = new Date(sesion.fecha_fin);
            
            for (let hora = inicio.getHours(); hora < fin.getHours(); hora++) {
                horasOcupadas.add(hora);
            }
        });

        
        horasGrid.innerHTML = '';
        for (let hora = 0; hora < 24; hora++) {
            const col = document.createElement('div');
            col.classList.add('col-6', 'col-md-4', 'col-lg-2');

            const estaOcupada = horasOcupadas.has(hora);
            const horaNumero = String(hora).padStart(2, '0');

            if (estaOcupada) {
                col.innerHTML = `
                    <button class="btn btn-secondary w-100 disabled" disabled>
                        <strong>${horaNumero}:00</strong>
                        <small class="d-block">Ocupada</small>
                    </button>
                `;
            } else {
                col.innerHTML = `
                    <button class="btn btn-outline-success w-100" onclick="seleccionarHora('${fecha}', ${hora})">
                        <strong>${horaNumero}:00</strong>
                        <small class="d-block">Disponible</small>
                    </button>
                `;
            }

            horasGrid.appendChild(col);
        }

        
        const modal = new bootstrap.Modal(document.getElementById('SeleccionarDia'));
        modal.show();
    }

    
    function seleccionarHora(fecha, hora) {
        const horaFormato = String(hora).padStart(2, '0');
        alert(`Hora seleccionada: ${fecha} a las ${horaFormato}:00`);
        
        
        const modal = bootstrap.Modal.getInstance(document.getElementById('SeleccionarDia'));
        modal.hide();
    }


    MesAntesBtn.addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        updateMonthDisplay();
        generateCalendar(currentYear, currentMonth);
    });

    MesDespuesBtn.addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        updateMonthDisplay();
        generateCalendar(currentYear, currentMonth);
    });

    updateMonthDisplay();
    generateCalendar(currentYear, currentMonth);
</script>
</html>