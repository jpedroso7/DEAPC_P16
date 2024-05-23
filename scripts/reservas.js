document.addEventListener('DOMContentLoaded', function() {
    fetch('/reservations')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#reservationsTable tbody');
            data.forEach(reservation => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${reservation.id}</td>
                    <td>${reservation.trip}</td>
                    <td>${reservation.date}</td>
                `;
                tableBody.appendChild(row);
            });
        });
});