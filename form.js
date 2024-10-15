
document.addEventListener('DOMContentLoaded', function() {
    // Select all buttons with id 'Btn'
    const buttons = document.querySelectorAll('#Btn');

    // Add click event listener to each button
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            window.open('form.html', 'form', 'width=600,height=600');
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('bookingForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const checkin = document.getElementById('checkin').value;
        const checkout = document.getElementById('checkout').value;
        const guests = document.getElementById('guests').value;
        const roomNumber = document.getElementById('Room-number').value;

        const confirmationMessage = document.getElementById('confirmationMessage');
        const confirmationDetails = document.getElementById('confirmationDetails');

        confirmationDetails.innerHTML = `
            Name: ${name}<br>
            Email: ${email}<br>
            Check-in Date: ${checkin}<br>
            Check-out Date: ${checkout}<br>
            Number of Guests: ${guests}<br>
            Number of Room: ${roomNumber}
        `;
        confirmationMessage.style.display = 'block';

        document.getElementById('BOoking Form').reset();
    });
});








