<?php
include('func.php');
session_start();

$pid = $_SESSION['pid'];
echo "<h2 style='font-family: sans-serif;'>Patient Dashboard</h2><hr>";

// Appointment History
echo "<h3>🗓️ Appointment History</h3>";
$appointments = mysqli_query($con, "SELECT * FROM appointmenttb WHERE pid = '$pid'");
echo "<table border='1' cellpadding='8'><tr><th>Doctor</th><th>Date</th><th>Time</th><th>Fees</th><th>Status</th></tr>";
while ($row = mysqli_fetch_assoc($appointments)) {
    $status = ($row['userStatus'] == 1 && $row['doctorStatus'] == 1) ? "Active" :
              (($row['userStatus'] == 0) ? "Cancelled by Patient" : "Cancelled by Doctor");
    echo "<tr>
            <td>{$row['doctor']}</td>
            <td>{$row['appdate']}</td>
            <td>{$row['apptime']}</td>
            <td>₹{$row['docFees']}</td>
            <td>$status</td>
          </tr>";
}
echo "</table><br>";

// Prescription Records
echo "<h3>💊 Prescriptions</h3>";
$prescriptions = mysqli_query($con, "SELECT * FROM prestb WHERE pid = '$pid'");
echo "<table border='1' cellpadding='8'><tr><th>Doctor</th><th>Date</th><th>Disease</th><th>Allergy</th><th>Prescription</th></tr>";
while ($row = mysqli_fetch_assoc($prescriptions)) {
    echo "<tr>
            <td>{$row['doctor']}</td>
            <td>{$row['appdate']}</td>
            <td>{$row['disease']}</td>
            <td>{$row['allergy']}</td>
            <td>{$row['prescription']}</td>
          </tr>";
}
echo "</table><br>";

// Cabin Booking Records
echo "<h3>🛏️ Cabin Bookings</h3>";
$bookings = mysqli_query($con, "SELECT b.*, c.room_number FROM cabin_booking b JOIN cabins c ON b.cabin_id = c.cabin_id WHERE b.patient_id = '$pid'");
echo "<table border='1' cellpadding='8'><tr><th>Room</th><th>From</th><th>To</th><th>Total Paid</th></tr>";
while ($row = mysqli_fetch_assoc($bookings)) {
    echo "<tr>
            <td>{$row['room_number']}</td>
            <td>{$row['start_date']}</td>
            <td>{$row['end_date']}</td>
            <td>₹{$row['total_amount']}</td>
          </tr>";
}
echo "</table><br>";

// Total Payments Summary
echo "<h3>💰 Total Payments</h3>";
$total = 0;
$fees_result = mysqli_query($con, "SELECT SUM(docFees) AS total_fees FROM appointmenttb WHERE pid = '$pid'");
if ($row = mysqli_fetch_assoc($fees_result)) {
    $total += $row['total_fees'];
}
$book_result = mysqli_query($con, "SELECT SUM(total_amount) AS total_cabins FROM cabin_booking WHERE patient_id = '$pid'");
if ($row = mysqli_fetch_assoc($book_result)) {
    $total += $row['total_cabins'];
}
echo "<p><strong>Total Paid Across All Services: ₹$total</strong></p>";
?>
