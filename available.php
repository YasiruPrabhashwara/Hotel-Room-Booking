<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $arrival = isset($_POST['arrival']) ? $_POST['arrival'] : '';
    $departure = isset($_POST['depature']) ? $_POST['depature'] : ''; // Fixed spelling here
    $roomName = isset($_POST['roomName']) ? $_POST['roomName'] : '';

    // Validate input (basic checks)
    if (empty($arrival) || empty($departure) || empty($roomName)) {
        echo "<script>
                alert('Please fill in all fields.');
                window.history.back(); // Go back to the form
              </script>";
        exit();
    }

    // Database Connection
    $conn = new mysqli('localhost', 'root', '', 'hotel');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Prepare SQL query to check for overlapping bookings
    $stmt = $conn->prepare("SELECT COUNT(*) FROM form 
                            WHERE `Name(R/S/E)` = ? 
                            AND ((`Check-in Date` <= ? AND `Check-out Date` >= ?) 
                            OR (`Check-in Date` >= ? AND `Check-in Date` <= ?))");
    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind the parameters for room name, arrival, and departure dates
    $stmt->bind_param("sssss", $roomName, $departure, $arrival, $arrival, $departure);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Determine availability based on the count result
    if ($count > 0) {
        $alertMessage = "The selected room is booked for the chosen dates.";
    } else {
        $alertMessage = "The selected room is available for booking.";
    }

    $conn->close();

    echo "<script>
          alert('$alertMessage');
          window.location.href = 'All.html'; // Redirect to the form page
          </script>";

    
} else {
    // Redirect if accessed without form submission
    header("Location: your_page_with_form.php");
    exit();
}
?>
