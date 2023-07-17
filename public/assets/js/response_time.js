document.addEventListener('DOMContentLoaded', function () {
    fetch('/dashboard/index/response-time')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('tbody');
            data.forEach(chat => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${chat.id_pengirim}</td>
                    <td>${chat.id_penerima}</td>
                    <td>${chat.created_at}</td>
                    <td>${chat.response_time}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching response time:', error));
});
