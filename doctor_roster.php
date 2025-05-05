<?php
include('func.php');

// Build doctor-to-room mapping (latest entry)
$doctorRooms = [];
$roomQuery = mysqli_query($con, "
    SELECT doctor_username, consultation_room 
    FROM doctor_roster 
    WHERE id IN (
        SELECT MAX(id) 
        FROM doctor_roster 
        GROUP BY doctor_username
    )
");
while ($row = mysqli_fetch_assoc($roomQuery)) {
    $doctorRooms[$row['doctor_username']] = $row['consultation_room'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor = $_POST['doctor_username'];
    $date = $_POST['date'];
    $shift = $_POST['shift'];
    $room = $_POST['room'];

    $insert = "INSERT INTO doctor_roster (doctor_username, date, shift, consultation_room)
               VALUES ('$doctor', '$date', '$shift', '$room')";
    if (mysqli_query($con, $insert)) {
        echo "<div class='alert alert-success'>✅ Roster entry added successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>❌ Error adding roster: " . mysqli_error($con) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Roster Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Roboto Condensed', sans-serif;
            background-color: #f5f9fc;
        }
        .container {
            margin-top: 40px;
        }
        .card {
            border-radius: 12px;
        }
        h2 {
            font-size: 2.5rem;
            color: #003366;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">🩺 Doctor Roster Management</h2>

    <form method="POST" class="card p-4 shadow-sm mb-5">
        <h4 class="mb-3">Assign Shift</h4>

        <div class="form-group">
            <label for="doctor">Select Doctor</label>
            <select name="doctor_username" id="doctor" class="form-control" onchange="fillRoom()" required>
                <option value="" disabled selected>-- Choose Doctor --</option>
                <?php
                $doctors = mysqli_query($con, "SELECT username FROM doctb");
                while ($doc = mysqli_fetch_assoc($doctors)) {
                    echo "<option value='{$doc['username']}'>{$doc['username']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Shift</label>
            <select name="shift" class="form-control" required>
                <option value="Morning">Morning (8AM - 2PM)</option>
                <option value="Evening">Evening (2PM - 8PM)</option>
                <option value="Night">Night (8PM - 8AM)</option>
            </select>
        </div>

        <div class="form-group">
            <label>Consultation Room</label>
            <input type="text" name="room" id="room" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Roster Entry</button>
    </form>

    <h4>📅 Current Week's Roster</h4>
    <div class="card p-3">
        <?php
        $today = date('Y-m-d');
        $end = date('Y-m-d', strtotime('+6 days'));
        $result = mysqli_query($con, "
            SELECT r.date, r.shift, r.consultation_room, r.doctor_username 
            FROM doctor_roster r 
            WHERE r.date BETWEEN '$today' AND '$end'
            ORDER BY r.date, r.shift
        ");

        $current_day = "";
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['date'] !== $current_day) {
                $current_day = $row['date'];
                echo "<h5 class='text-primary mt-3'>$current_day</h5>";
            }
            echo "<p><strong>{$row['doctor_username']}</strong> - {$row['shift']} - Room {$row['consultation_room']}</p>";
        }
        ?>
    </div>
</div>

<script>
    const roomMap = <?php echo json_encode($doctorRooms); ?>;
    function fillRoom() {
        const doctor = document.getElementById("doctor").value;
        const room = roomMap[doctor] || "";
        document.getElementById("room").value = room;
    }
</script>

</body>
</html>
