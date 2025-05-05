<?php
$con = mysqli_connect("localhost", "root", "", "hmsproject")
    or die("Connection Failed: " . mysqli_connect_error());

$months = [
    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Summary Dashboard</title>

    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Libre Franklin Google Font -->
    <!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@400;600;800&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">


    <style>
        body {
            font-family: 'Libre Franklin', sans-serif;
            background-color: #f8f9fa;
        }
        h2, h3, h5 {
            font-weight: 8000;
        }
        .summary-card {
            border-radius: 10px;
            transition: 0.3s;
        }
        .summary-card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="container mt-5">
<h2 class="text-center text-primary mb-4"
    style="font-family: 'Roboto Condensed', sans-serif; font-weight: 1700; font-size: 2.5rem; letter-spacing: 1px;">
     Admin Summary Dashboard
</h2>


    <form method="POST" class="form-inline justify-content-center mb-5">
        <label class="mr-2">Select Month:</label>
        <select name="month" class="form-control mr-4" required>
            <?php
            foreach ($months as $num => $name) {
                echo "<option value='$num'>$name</option>";
            }
            ?>
        </select>

        <label class="mr-2">Year:</label>
        <select name="year" class="form-control mr-4" required>
            <?php
            for ($y = 2025; $y <= 2030; $y++) {
                echo "<option value='$y'>$y</option>";
            }
            ?>
        </select>

        <button type="submit" class="btn btn-primary">Show Summary</button>
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $month = (int)$_POST['month'];
    $year = (int)$_POST['year'];

    $doc_query = mysqli_query($con, "SELECT COUNT(*) AS total_docs FROM doctb");
    $total_doctors = mysqli_fetch_assoc($doc_query)['total_docs'];

    $active_doc_query = mysqli_query($con, "
        SELECT COUNT(DISTINCT doctor) AS active_doctors 
        FROM appointmenttb 
        WHERE MONTH(appdate) = $month AND YEAR(appdate) = $year
    ");
    $active_doctors = mysqli_fetch_assoc($active_doc_query)['active_doctors'];

    $pat_query = mysqli_query($con, "SELECT COUNT(*) AS total_pats FROM patreg");
    $total_patients = mysqli_fetch_assoc($pat_query)['total_pats'];

    $appt_query = mysqli_query($con, "
        SELECT COUNT(*) AS total_appts 
        FROM appointmenttb 
        WHERE MONTH(appdate) = $month AND YEAR(appdate) = $year
    ");
    $total_appts = mysqli_fetch_assoc($appt_query)['total_appts'];

    echo "<div class='card p-4 shadow-lg mb-5 summary-card'>";
    echo "<h3 class='text-center text-secondary mb-4'>
            📅 Summary for <strong>" . $months[$month] . " $year</strong>
          </h3>";

    echo "<div class='row text-center'>";

    // Total Registered Doctors
    echo "<div class='col-md-6 mb-4'>";
    echo "<div class='border rounded p-3 bg-light'>";
    echo "<h5><i class='fa fa-user-md text-primary'></i> Total Registered Doctors</h5>";
    echo "<h2 class='text-dark'>$total_doctors</h2>";
    echo "</div></div>";

    // Active Doctors
    echo "<div class='col-md-6 mb-4'>";
    echo "<div class='border rounded p-3 bg-light'>";
    echo "<h5><i class='fa fa-stethoscope text-success'></i> Active Doctors in $months[$month]</h5>";
    echo "<h2 class='text-dark'>$active_doctors</h2>";
    echo "</div></div>";

    // Total Patients
    echo "<div class='col-md-6 mb-4'>";
    echo "<div class='border rounded p-3 bg-light'>";
    echo "<h5><i class='fa fa-wheelchair text-info'></i> Total Registered Patients</h5>";
    echo "<h2 class='text-dark'>$total_patients</h2>";
    echo "</div></div>";

    // Appointments this Month
    echo "<div class='col-md-6 mb-4'>";
    echo "<div class='border rounded p-3 bg-light'>";
    echo "<h5><i class='fa fa-calendar-check-o text-warning'></i> Appointments in $months[$month]</h5>";
    echo "<h2 class='text-dark'>$total_appts</h2>";
    echo "</div></div>";

    echo "</div>"; // end row
    echo "</div>"; // end card
}
?>

</div>
</body>
</html>
