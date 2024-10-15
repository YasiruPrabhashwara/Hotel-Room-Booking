<?php
$name = $_POST['name'];
$email = $_POST['email'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$guests = $_POST['guests'];
$Rname = $_POST['Rname'];

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'hotel');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Prepare a statement to check for existing bookings
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM form WHERE `Name` = ? AND `Check-in Date` = ? AND `Check-out Date` = ?");
    $checkStmt->bind_param("sss", $name, $checkin, $checkout);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    // If a booking exists, show an alert
    if ($count > 0) {
        echo "<script>alert('There is an existing booking for this name, check-in date, and check-out date.Do Another Booking.Have A Nice Day!');</script>";
    } else {
        // Proceed to insert a new booking
        $stmt = $conn->prepare("INSERT INTO form (`Name`, `Email`, `Check-in Date`, `Check-out Date`, `Number of Guests`, `Name(R/S/E)`) 
        VALUES (?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($conn->error));
        }

        // Bind parameters correctly: all as strings except for the number of guests
        $stmt->bind_param("ssssis", $name, $email, $checkin, $checkout, $guests, $Rname);
        $stmt->execute();

         // Use JavaScript to show alert and clear the form
        echo "<script>
                alert('Booking Confirmed');
                window.location.href = 'All.html'; // Redirect to the form page
                </script>";

        $stmt->close();
    }

    $conn->close();
}
?>
