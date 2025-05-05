<?php
include('func.php');

$months = [
    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
];

echo "<!DOCTYPE html>
<html>
<head>
    <title>Nurse Roster Management</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <link href='https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap' rel='stylesheet'>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
        }
        .container {
            background: #ffffff;
            padding: 40px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h2 {
            font-family: 'Roboto Condensed', sans-serif;
            font-size: 2.4rem;
            color: #007bff;
            text-align: center;
        }
        label {
            font-weight: 600;
        }
        .form-section {
            margin-top: 30px;
        }
        .shift-entry {
            padding-left: 10px;
            margin-bottom: 10px;
            font-size: 1rem;
        }
        .day-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 20px;
            color: #343a40;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
<div class='container'>
    <h2>👩‍⚕️ Nurse Roster Management</h2>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nurse_username = $_POST['nurse_username'];
    $date = $_POST['date'];
    $shift = $_POST['shift'];

    $insert = "INSERT INTO nurse_roster (nurse_username, date, shift)
               VALUES ('$nurse_username', '$date', '$shift')";
    if (mysqli_query($con, $insert)) {
        echo "<div class='alert alert-success mt-3'>✅ Shift assigned successfully.</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>❌ Error: " . mysqli_error($con) . "</div>";
    }
}

// Nurse selection
$nurses = mysqli_query($con, "SELECT username FROM nursetb");
echo "<div class='form-section'>
        <form method='POST'>
            <div class='form-group'>
                <label for='nurse'>Nurse:</label>
                <select class='form-control' name='nurse_username' required>";
while ($nurse = mysqli_fetch_assoc($nurses)) {
    echo "<option value='{$nurse['username']}'>{$nurse['username']}</option>";
}
echo "      </select>
            </div>

            <div class='form-group'>
                <label>Date:</label>
                <input type='date' class='form-control' name='date' required>
            </div>

            <div class='form-group'>
                <label>Shift:</label>
                <select class='form-control' name='shift' required>
                    <option value='Morning'>Morning (8AM - 2PM)</option>
                    <option value='Evening'>Evening (2PM - 8PM)</option>
                    <option value='Night'>Night (8PM - 8AM)</option>
                </select>
            </div>

            <button type='submit' class='btn btn-primary'>Assign Shift</button>
        </form>
    </div>";

echo "<div class='form-section mt-5'>
        <h4 class='text-dark'>🗓️ Current Week's Nurse Roster</h4>";

$today = date('Y-m-d');
$end = date('Y-m-d', strtotime('+6 days'));
$query = "SELECT date, shift, nurse_username 
          FROM nurse_roster
          WHERE date BETWEEN '$today' AND '$end'
          ORDER BY date, shift";
$result = mysqli_query($con, $query);

$current_day = '';
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['date'] !== $current_day) {
        $current_day = $row['date'];
        echo "<div class='day-title'>$current_day</div>";
    }
    echo "<div class='shift-entry'><b>{$row['nurse_username']}</b> - {$row['shift']}</div>";
}

echo "</div></div></body></html>";
?>
