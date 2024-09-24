// Variables globales para el mes y año actuales
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
const today = new Date();

// Nombres de los meses
const monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

// Función para mostrar el calendario
function generateCalendar(month, year) {
  const calendar = document.getElementById('calendar');
  calendar.innerHTML = ''; // Limpiar el calendario
  const monthYear = document.getElementById('monthYear');
  monthYear.innerText = `${monthNames[month]} ${year}`;

  const firstDay = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  const weekdays = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
  weekdays.forEach(day => {
    const weekdayElement = document.createElement('div');
    weekdayElement.className = 'weekday';
    weekdayElement.innerText = day;
    calendar.appendChild(weekdayElement);
  });

  for (let i = 0; i < firstDay; i++) {
    const emptyCell = document.createElement('div');
    emptyCell.className = 'day';
    calendar.appendChild(emptyCell);
  }

  for (let day = 1; day <= daysInMonth; day++) {
    const dayElement = document.createElement('div');
    dayElement.className = 'day';
    dayElement.innerText = day;
    if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
      dayElement.classList.add('current-day');
    }
    calendar.appendChild(dayElement);
  }
}

function prevMonth() {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  generateCalendar(currentMonth, currentYear);
}

function nextMonth() {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  generateCalendar(currentMonth, currentYear);
}

generateCalendar(currentMonth, currentYear);

