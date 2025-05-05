<?php
include('func.php');

echo "<h2 style='font-family: sans-serif;'>Cabin Booking Overview</h2><hr>";

// Cabin Availability
echo "<h4>Cabin Availability</h4>";

$cabin_result = mysqli_query($con, "SELECT * FROM cabins");
echo "<table border='1' cellpadding='8'><tr><th>Room Number</th><th>Status</th></tr>";
while ($row = mysqli_fetch_assoc($cabin_result)) {
    $status_color = $row['status'] === 'Available' ? 'green' : 'red';
    echo "<tr>
            <td>{$row['cabin_no']}</td>
            <td style='color: $status_color;'>{$row['status']}</td>
          </tr>";
}
echo "</table><br>";

// Cabin Booking History
echo "<h4>Cabin Booking History</h4>";

$booking_result = @mysqli_query($con, "
    SELECT b.*, p.fname, p.lname, c.cabin_no 
    FROM cabin_booking b 
    JOIN patreg p ON b.patient_id = p.pid 
    JOIN cabins c ON b.cabin_id = c.cabin_no 
    ORDER BY b.start_date DESC
");

if ($booking_result) {
    echo "<table border='1' cellpadding='8'>
            <tr>
                <th>Patient</th>
                <th>Room</th>
                <th>From</th>
                <th>To</th>
                <th>Total Amount</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($booking_result)) {
        $name = $row['fname'] . " " . $row['lname'];
        echo "<tr>
                <td>$name</td>
                <td>{$row['cabin_no']}</td>
                <td>{$row['start_date']}</td>
                <td>{$row['end_date']}</td>
                <td>₹{$row['total_amount']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p style='color: red;'>Booking history not available — table missing.</p>";
}
?>
