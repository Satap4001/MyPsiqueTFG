<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/styles/custom/css/styles.css">
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
        $psicologoId = $_GET['psicologo_id'];
        var_dump($_GET);
    ?>
    
    <div class="m-5 p-5">
        <div class="d-flex justify-content-between mb-3">
            <button id="MesAntes" class="btn btn-primary">Mes Anterior</button>
            <h2 id="currentMonth" class="text-center"></h2>
            <button id="MesDespues" class="btn btn-primary">Mes Siguiente</button>
        </div>
        <div id="calendar"></div>
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
        }
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