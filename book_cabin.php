<?php
include('func.php');
session_start();

$pid = $_SESSION['pid'];

echo "<h2 style='font-family: sans-serif;'>Book a Cabin</h2><hr>";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cabin_id = $_POST['cabin_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24) + 1;
    $total_amount = $days * 3000;

    // Insert booking
    $q = "INSERT INTO cabin_booking (patient_id, cabin_id, start_date, end_date, total_amount)
          VALUES ('$pid', '$cabin_id', '$start_date', '$end_date', '$total_amount')";
    $success = mysqli_query($con, $q);

    if ($success) {
        mysqli_query($con, "UPDATE cabins SET status='Booked' WHERE cabin_id='$cabin_id'");
        echo "<p style='color: green;'>Cabin booked successfully. ₹$total_amount paid.</p>";
    } else {
        echo "<p style='color: red;'>Booking failed: " . mysqli_error($con) . "</p>";
    }
}

// Show available cabins
$cabins = mysqli_query($con, "SELECT * FROM cabins WHERE status='Available'");
echo "<form method='POST'>
<h4>Select Available Cabin</h4>
<select name='cabin_id' required>";
while ($row = mysqli_fetch_assoc($cabins)) {
    echo "<option value='{$row['cabin_id']}'>Room #{$row['room_number']}</option>";
}
echo "</select><br><br>

<label>Start Date:</label> <input type='date' name='start_date' required><br><br>
<label>End Date:</label> <input type='date' name='end_date' required><br><br>

<input type='submit' value='Book Now'>
</form>";
?>
