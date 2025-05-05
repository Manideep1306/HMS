<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "hmsproject");

if (!$con) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if (isset($_POST['patsub1'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password == $cpassword) {
        $query = "INSERT INTO patreg(fname, lname, gender, email, contact, password, cpassword) 
                  VALUES ('$fname','$lname','$gender','$email','$contact','$password','$cpassword')";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['username'] = "$fname $lname";
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['gender'] = $gender;
            $_SESSION['contact'] = $contact;
            $_SESSION['email'] = $email;

            // Get patient ID
            $query1 = "SELECT pid FROM patreg WHERE contact = '$contact' LIMIT 1";
            $result1 = mysqli_query($con, $query1);
            if ($row = mysqli_fetch_assoc($result1)) {
                $_SESSION['pid'] = $row['pid'];
            }

            header("Location:admin-panel.php");
            exit();
        }
    } else {
        header("Location:error1.php");
        exit();
    }
}

if (isset($_POST['update_data'])) {
    $contact = $_POST['contact'];
    $status = $_POST['status'];
    $query = "UPDATE appointmenttb SET payment='$status' WHERE contact='$contact'";
    $result = mysqli_query($con, $query);

    if ($result)
        header("Location:updated.php");
}

// Uncomment if needed
// function display_docs() {
//     global $con;
//     $query = "SELECT * FROM doctb";
//     $result = mysqli_query($con, $query);
//     while ($row = mysqli_fetch_array($result)) {
//         $name = $row['name'];
//         echo '<option value="' . $name . '">' . $name . '</option>';
//     }
// }

if (isset($_POST['doc_sub'])) {
    $name = $_POST['name'];
    $query = "INSERT INTO doctb(name) VALUES('$name')";
    $result = mysqli_query($con, $query);

    if ($result)
        header("Location:adddoc.php");
}

function display_admin_panel() {
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <style>
        button:hover, #inputbtn:hover { cursor: pointer; }
    </style>
</head>
<body style="padding-top:50px;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#"><i class="fa fa-user-plus"></i> Global Hospital</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
                <input class="form-control mr-sm-2" type="text" name="contact" placeholder="Enter contact number">
                <input type="submit" name="search_submit" value="Search" class="btn btn-outline-light">
            </form>
        </div>
    </nav>
    
    <div class="container-fluid" style="margin-top:80px;">
        <div class="row">
            <div class="col-md-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home">Appointment</a>
                    <a class="list-group-item list-group-item-action" href="patientdetails.php">Patient List</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile">Payment Status</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages">Prescription</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings">Doctors Section</a>
                    <a class="list-group-item list-group-item-action" id="list-attend-list" data-toggle="list" href="#list-attend">Attendance</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home">
                        <div class="card">
                            <div class="card-body">
                                <center><h4>Create an appointment</h4></center><br>
                                <form class="form-group" method="post" action="appointment.php">
                                    <div class="form-row">
                                        <div class="form-group col-md-6"><label>First Name:</label><input type="text" class="form-control" name="fname"></div>
                                        <div class="form-group col-md-6"><label>Last Name:</label><input type="text" class="form-control" name="lname"></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6"><label>Email:</label><input type="email" class="form-control" name="email"></div>
                                        <div class="form-group col-md-6"><label>Contact Number:</label><input type="text" class="form-control" name="contact"></div>
                                    </div>
                                    <div class="form-group"><label>Doctor:</label>
                                        <select name="doctor" class="form-control">
                                            <?php display_docs(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group"><label>Payment:</label>
                                        <select name="payment" class="form-control">
                                            <option value="" disabled selected>Select Payment Status</option>
                                            <option value="Paid">Paid</option>
                                            <option value="Pay later">Pay later</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="entry_submit" class="btn btn-primary">Create new entry</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="list-profile">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="func.php">
                                    <input type="text" name="contact" class="form-control" placeholder="Enter contact"><br>
                                    <select name="status" class="form-control">
                                        <option value="" disabled selected>Select Payment Status to update</option>
                                        <option value="paid">paid</option>
                                        <option value="pay later">pay later</option>
                                    </select><br>
                                    <input type="submit" value="Update" name="update_data" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Add other tab contents as needed -->

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
    <script>
        $(document).ready(function(){
            swal({
                title: "Welcome!",
                text: "Have a nice day!",
                imageUrl: "images/sweet.jpg",
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Custom image",
                animation: false
            });
        });
    </script>
</body>
</html>';
}
?>
