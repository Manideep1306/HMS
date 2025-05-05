<?php
include('func.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Payslip Generator</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f6fc;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 600px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
        }
        h2 {
            font-family: 'Roboto Condensed', sans-serif;
            font-weight: 700;
            font-size: 2.2rem;
            text-align: center;
            color: #003366;
            margin-bottom: 30px;
        }
        form label {
            font-weight: 600;
            display: block;
            margin-top: 20px;
            margin-bottom: 5px;
        }
        select, input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📄 Doctor Payslip Generator</h2>
    <form method="POST" action="generate_payslip_pdf.php">
        <label for="doctor_username">Select Doctor:</label>
        <select name="doctor_username" required>
            <option value="">-- Select Doctor --</option>
            <?php
            $doctors = mysqli_query($con, "SELECT username FROM doctb");
            while ($row = mysqli_fetch_assoc($doctors)) {
                echo "<option value='{$row['username']}'>{$row['username']}</option>";
            }
            ?>
        </select>

        <label for="month">Month:</label>
        <select name="month" required>
            <?php
            $months = [
                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
            ];
            foreach ($months as $num => $name) {
                echo "<option value='$num'>$name</option>";
            }
            ?>
        </select>

        <label for="year">Year:</label>
        <select name="year" required>
            <?php
            for ($y = 2025; $y <= 2030; $y++) {
                echo "<option value='$y'>$y</option>";
            }
            ?>
        </select>

        <input type="submit" value="Generate Payslip">
    </form>
</div>
</body>
</html>
