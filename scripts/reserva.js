document.addEventListener('DOMContentLoaded', function() {
    const bookingForm = document.getElementById('bookingForm');
    const bookNowButton = document.getElementById('bookNowButton');

    bookingForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio do formulário
        alert('Your booking has been confirmed!');
    });
});
