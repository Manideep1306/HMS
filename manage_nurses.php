<?php
include('func.php');

echo '<!DOCTYPE html>
<html>
<head>
    <title>Manage Nurses</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: "Segoe UI", sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h2 {
            font-family: "Roboto Condensed", sans-serif;
            font-size: 2.2rem;
            color: #007bff;
            text-align: center;
        }
        h4 {
            color: #343a40;
            margin-top: 30px;
            font-weight: bold;
        }
        .btn-space {
            margin-right: 10px;
        }
        .table td {
            vertical-align: middle;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
            padding: 6px;
            font-size: 1rem;
            width: 120px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>🧑‍⚕️ Manage Nurses</h2><hr>';

// ✅ Handle Add Nurse
if (isset($_POST['add_nurse'])) {
    $name = $_POST['nurse_name'];
    $salary = $_POST['salary'];
    mysqli_query($con, "INSERT INTO nursetb (username, salary) VALUES ('$name', '$salary')");
    echo "<div class='alert alert-success'>✅ Nurse added successfully.</div>";
}

// ✅ Handle Delete Nurse
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($con, "DELETE FROM nursetb WHERE id=$id");
    echo "<div class='alert alert-danger'>🗑️ Nurse deleted.</div>";
}

// ✅ Handle Update Nurse Salary
if (isset($_POST['update_nurse'])) {
    $id = $_POST['nurse_id'];
    $salary = $_POST['updated_salary'];
    mysqli_query($con, "UPDATE nursetb SET salary='$salary' WHERE id=$id");
    echo "<div class='alert alert-info'>💰 Salary updated.</div>";
}

// ✅ Add Nurse Form
echo '<div class="form-section mt-4">
        <form method="POST">
            <h4>Add New Nurse</h4>
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="nurse_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Salary:</label>
                <input type="number" name="salary" class="form-control" required>
            </div>
            <button type="submit" name="add_nurse" class="btn btn-primary">Add Nurse</button>
        </form>
    </div><hr>';

// ✅ Show current nurses
$result = mysqli_query($con, "SELECT * FROM nursetb");

echo "<h4>Current Nurses</h4>";
echo "<table class='table table-bordered table-hover'>
        <thead class='thead-dark'>
            <tr>
                <th>Name</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['username']}</td>
            <td>₹{$row['salary']}</td>
            <td>
                <form method='POST' class='form-inline' style='display:inline-block;'>
                    <input type='hidden' name='nurse_id' value='{$row['id']}'>
                    <input type='number' name='updated_salary' placeholder='New Salary' required>
                    <button type='submit' name='update_nurse' class='btn btn-sm btn-info btn-space'>Update</button>
                </form>
                <a href='?delete={$row['id']}' onclick=\"return confirm('Delete this nurse?')\" class='btn btn-sm btn-danger'>Delete</a>
            </td>
          </tr>";
}

echo "</tbody></table></div></body></html>";
?>
