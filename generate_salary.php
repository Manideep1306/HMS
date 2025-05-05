<?php
$con = mysqli_connect("localhost", "root", "", "hmsproject");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Month selector
$months = [
    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Salary Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Roboto Condensed', sans-serif;
            background-color: #f4f8fb;
        }
        .container {
            margin-top: 40px;
        }
        table {
            background: #fff;
        }
        th {
            background-color: #003366;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center text-primary mb-4">💼 Doctor Salary Report</h2>

    <form method="POST" class="form-inline justify-content-center mb-4">
        <label class="mr-2">Month:</label>
        <select name="month" class="form-control mr-3" required>
            <?php foreach ($months as $num => $name) {
                echo "<option value='$num'>$name</option>";
            } ?>
        </select>

        <label class="mr-2">Year:</label>
        <select name="year" class="form-control mr-3" required>
            <?php for ($y = 2025; $y <= 2030; $y++) {
                echo "<option value='$y'>$y</option>";
            } ?>
        </select>

        <button type="submit" class="btn btn-success">Generate</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $month = (int)$_POST['month'];
        $year = (int)$_POST['year'];
        $label = $months[$month] . " $year";

        $query = "SELECT username, spec, docFees, is_visiting, basic_pay FROM doctb";
        $result = mysqli_query($con, $query);

        echo "<h5 class='mb-3'>Summary for <strong>$label</strong></h5>";
        echo "<table class='table table-bordered'>
        <thead>
        <tr>
            <th>Doctor Name</th>
            <th>Specialization</th>
            <th>Consultancy Fee</th>
            <th>Appointments</th>
            <th>Basic Pay</th>
            <th>Variable Pay</th>
            <th>Total Salary</th>
        </tr>
        </thead>
        <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['username'];
            $spec = $row['spec'];
            $fee = (int)$row['docFees'];
            $is_visiting = (int)$row['is_visiting'];
            $basic_pay = (int)$row['basic_pay'];

            // Get appointment count
            $count_q = "SELECT COUNT(*) AS appts FROM appointmenttb 
                        WHERE doctor = '$username' 
                        AND MONTH(appdate) = $month AND YEAR(appdate) = $year";
            $count_r = mysqli_query($con, $count_q);
            $appt_count = mysqli_fetch_assoc($count_r)['appts'];

            // Salary Calculation
            $variable = $appt_count * ($is_visiting ? 200 : 100);
            $total = $is_visiting ? $variable : $basic_pay + $variable;

            echo "<tr>
                <td>$username</td>
                <td>$spec</td>
                <td>₹$fee</td>
                <td>$appt_count</td>
                <td>" . ($is_visiting ? "—" : "₹$basic_pay") . "</td>
                <td>₹$variable</td>
                <td><strong>₹$total</strong></td>
            </tr>";
        }

        echo "</tbody></table>";
    }
    ?>
</div>
</body>
</html>
