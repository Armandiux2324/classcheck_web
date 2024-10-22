document.addEventListener('DOMContentLoaded', function() {
    const daysContainer = document.querySelector('.container_days');
    const textMonth = document.getElementById('text_month');
    const textDay = document.getElementById('text_day');
    const textMonth02 = document.getElementById('text_month_02');
    const textYear = document.getElementById('text_year');

    const today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    function renderCalendar() {
        daysContainer.innerHTML = ''; // Limpiar los días
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const lastDay = new Date(currentYear, currentMonth + 1, 0).getDate();

        textMonth.innerHTML = new Intl.DateTimeFormat('es', { month: 'long' }).format(new Date(currentYear, currentMonth));
        textMonth02.innerHTML = new Intl.DateTimeFormat('es', { month: 'long' }).format(new Date(currentYear, currentMonth));
        textYear.innerHTML = currentYear;

        let dayToday = null; // Variable para almacenar el día actual

        for (let i = 0; i < firstDay; i++) {
            daysContainer.innerHTML += `<span class="week_days_item"></span>`;
        }

        for (let day = 1; day <= lastDay; day++) {
            const isToday = day === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear();
            daysContainer.innerHTML += `<span class="week_days_item ${isToday ? 'today' : 'item_day'}">${day}</span>`;

            if (isToday) {
                dayToday = day; // Guardar el día actual
            }
        }

        if (dayToday) {
            textDay.innerHTML = dayToday; // Mostrar el día actual en text_day
        }
    }

    document.getElementById('last_month').addEventListener('click', function() {
        currentMonth -= 1;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear -= 1;
        }
        renderCalendar();
    });

    document.getElementById('next_month').addEventListener('click', function() {
        currentMonth += 1;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear += 1;
        }
        renderCalendar();
    });

    renderCalendar(); // Inicializar el calendario
});
