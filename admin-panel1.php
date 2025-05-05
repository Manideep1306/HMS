<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin Panel - Global Hospital</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <!-- Bootstrap & FontAwesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <style>
    .bg-primary {
      background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    }
    .col-md-4 {
      max-width: 20% !important;
    }
    .list-group-item.active {
      z-index: 2;
      color: #fff;
      background-color: #342ac1;
      border-color: #007bff;
    }
    .text-primary {
      color: #342ac1 !important;
    }
    #cpass {
      display: -webkit-box;
    }
    #list-app {
      font-size: 15px;
    }
    .btn-primary {
      background-color: #3c50c1;
      border-color: #3c50c1;
    }
    button:hover, #inputbtn:hover {
      cursor: pointer;
    }
  </style>

  <script>
    function check() {
      if (document.getElementById('dpassword').value === document.getElementById('cdpassword').value) {
        document.getElementById('message').style.color = '#5dd05d';
        document.getElementById('message').innerHTML = 'Matched';
      } else {
        document.getElementById('message').style.color = '#f55252';
        document.getElementById('message').innerHTML = 'Not Matching';
      }
    }

    function alphaOnly(event) {
      var key = event.keyCode;
      return ((key >= 65 && key <= 90) || key == 8 || key == 32);
    }
  </script>

</head>
<body style="padding-top:70px;">

<?php
  $con = mysqli_connect("localhost", "root", "", "hmsproject");
  include('newfunc.php');

  if (isset($_POST['docsub'])) {
    $doctor = $_POST['doctor'];
    $dpassword = $_POST['dpassword'];
    $demail = $_POST['demail'];
    $spec = $_POST['special'];
    $docFees = $_POST['docFees'];
    
    $query = "INSERT INTO doctb(username, password, email, spec, docFees) 
              VALUES ('$doctor', '$dpassword', '$demail', '$spec', '$docFees')";
    
    $result = mysqli_query($con, $query);
    if ($result) {
      echo "<script>alert('Doctor added successfully!');</script>";
    } else {
      echo "<script>alert('Failed to add doctor.');</script>";
    }
  }

  if (isset($_POST['docsub1'])) {
    $demail = $_POST['demail'];
    $query = "DELETE FROM doctb WHERE email='$demail'";
    $result = mysqli_query($con, $query);
    
    if ($result) {
      echo "<script>alert('Doctor removed successfully!');</script>";
    } else {
      echo "<script>alert('Unable to delete!');</script>";
    }
  }
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> Global Hospital</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="logout1.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Content Container -->
<div class="container-fluid" style="margin-top:50px;">
  <h3 class="text-center" style="font-family: 'IBM Plex Sans', sans-serif;">WELCOME RECEPTIONIST</h3>

  

  <div class="row">
    <div class="col-md-4" style="max-width:25%;margin-top: 3%;">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list" href="#list-dash" role="tab">Dashboard</a>
        <a class="list-group-item list-group-item-action" id="list-doc-list" data-toggle="list" href="#list-doc" role="tab">Doctor List</a>
        <a class="list-group-item list-group-item-action" id="list-pat-list" data-toggle="list" href="#list-pat" role="tab">Patient List</a>
        <a class="list-group-item list-group-item-action" id="list-nurse-list" data-toggle="list" href="#list-nurse" role="tab">Nurse List</a>
        <a class="list-group-item list-group-item-action" id="list-app-list" data-toggle="list" href="#list-app" role="tab">Appointment Details</a>
        <a class="list-group-item list-group-item-action" id="list-pres-list" data-toggle="list" href="#list-pres" role="tab">Prescription List</a>
        <a class="list-group-item list-group-item-action" id="list-adoc-list" data-toggle="list" href="#list-settings" role="tab">Add Doctor</a>
        <a class="list-group-item list-group-item-action" id="list-ddoc-list" data-toggle="list" href="#list-settings1" role="tab">Delete Doctor</a>
        <a class="list-group-item list-group-item-action" id="list-mes-list" data-toggle="list" href="#list-mes" role="tab">Queries</a>
        <a class="list-group-item list-group-item-action" id="list-tools-list" data-toggle="list" href="#list-tools" role="tab">Admin Tools</a>

      </div><br>
    </div>

    <div class="col-md-8" style="margin-top: 3%;">
      <div class="tab-content" id="nav-tabContent" style="width: 950px;">

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script>
      function clickDiv(tabSelector) {
        var tab = $(tabSelector);
        if (tab.length) {
          tab.tab('show');
        }
      }
    </script>
      
      <!-- Dashboard Panel -->
<div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
  <div class="container-fluid container-fullw bg-white">
    <div class="row">
      <!-- Doctor -->
      <div class="col-sm-4">
        <div class="panel panel-white no-radius text-center">
          <div class="panel-body">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-users fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="StepTitle">Doctor List</h4>
            <p class="links cl-effect-1">
            <a href="javascript:void(0);" onclick="clickDiv('#list-doc-list')">View Doctors</a>

            </p>
          </div>
        </div>
      </div>

      <!-- Patient -->
      <div class="col-sm-4">
        <div class="panel panel-white no-radius text-center">
          <div class="panel-body">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-users fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="StepTitle">Patient List</h4>
            <p class="cl-effect-1">
              <a href="#list-pat" onclick="clickDiv('#list-pat-list')">View Patients</a>
            </p>
          </div>
        </div>
      </div>

      <!-- Nurse -->
      <div class="col-sm-4">
        <div class="panel panel-white no-radius text-center">
          <div class="panel-body">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-users fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="StepTitle">Nurse List</h4>
            <p class="cl-effect-1">
              <a href="#list-nurse" onclick="clickDiv('#list-nurse-list')">View Nurses</a>
            </p>
          </div>
        </div>
      </div>

      <!-- Appointments -->
      <div class="col-sm-4 mt-4">
        <div class="panel panel-white no-radius text-center">
          <div class="panel-body">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="StepTitle">Appointment Details</h4>
            <p class="cl-effect-1">
              <a href="#list-app" onclick="clickDiv('#list-app-list')">View Appointments</a>
            </p>
          </div>
        </div>
      </div>

      <!-- Prescriptions -->
      <div class="col-sm-4 mt-4">
        <div class="panel panel-white no-radius text-center">
          <div class="panel-body">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="StepTitle">Prescription List</h4>
            <p class="cl-effect-1">
              <a href="#list-pres" onclick="clickDiv('#list-pres-list')">View Prescriptions</a>
            </p>
          </div>
        </div>
      </div>

      <!-- Manage Doctors -->
      <div class="col-sm-4 mt-4">
        <div class="panel panel-white no-radius text-center">
          <div class="panel-body">
            <span class="fa-stack fa-2x">
              <i class="fa fa-square fa-stack-2x text-primary"></i>
              <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="StepTitle">Manage Doctors</h4>
            <p class="cl-effect-1">
              <a href="#list-settings" onclick="clickDiv('#list-adoc-list')">Add Doctors</a>
              &nbsp;|&nbsp;
              <a href="#list-settings1" onclick="clickDiv('#list-ddoc-list')">Delete Doctors</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Doctor List -->
<div class="tab-pane fade" id="list-doc" role="tabpanel" aria-labelledby="list-doc-list">
  <div class="col-md-8">
    <form class="form-group" action="doctorsearch.php" method="post">
      <div class="row">
        <div class="col-md-10">
          <input type="text" name="doctor_contact" placeholder="Enter Email ID" class="form-control">
        </div>
        <div class="col-md-2">
          <input type="submit" name="doctor_search_submit" class="btn btn-primary" value="Search">
        </div>
      </div>
    </form>
  </div>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Doctor Name</th>
        <th>Specialization</th>
        <th>Email</th>
        <th>Password</th>
        <th>Fees</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $con = mysqli_connect("localhost", "root", "", "hmsproject");
        $query = "SELECT * FROM doctb";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>
            <td>{$row['username']}</td>
            <td>{$row['spec']}</td>
            <td>{$row['email']}</td>
            <td>{$row['password']}</td>
            <td>{$row['docFees']}</td>
          </tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<!-- Patient List -->
<div class="tab-pane fade" id="list-pat" role="tabpanel" aria-labelledby="list-pat-list">
  <div class="col-md-8">
    <form class="form-group" action="patientsearch.php" method="post">
      <div class="row">
        <div class="col-md-10">
          <input type="text" name="patient_contact" placeholder="Enter Contact" class="form-control">
        </div>
        <div class="col-md-2">
          <input type="submit" name="patient_search_submit" class="btn btn-primary" value="Search">
        </div>
      </div>
    </form>
  </div>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Patient ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Password</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $con = mysqli_connect("localhost", "root", "", "hmsproject");
        $query = "SELECT * FROM patreg";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>
                  <td>{$row['pid']}</td>
                  <td>{$row['fname']}</td>
                  <td>{$row['lname']}</td>
                  <td>{$row['gender']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['contact']}</td>
                  <td>{$row['password']}</td>
                </tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<!-- Prescription List -->
<div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
  <div class="col-md-12">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Doctor</th>
          <th>Patient ID</th>
          <th>Appointment ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Appointment Date</th>
          <th>Time</th>
          <th>Disease</th>
          <th>Allergy</th>
          <th>Prescription</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $query = "SELECT * FROM prestb";
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_array($result)) {
            echo "<tr>
                    <td>{$row['doctor']}</td>
                    <td>{$row['pid']}</td>
                    <td>{$row['ID']}</td>
                    <td>{$row['fname']}</td>
                    <td>{$row['lname']}</td>
                    <td>{$row['appdate']}</td>
                    <td>{$row['apptime']}</td>
                    <td>{$row['disease']}</td>
                    <td>{$row['allergy']}</td>
                    <td>{$row['prescription']}</td>
                  </tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Appointment Details -->
<div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-app-list">
  <div class="col-md-8">
    <form class="form-group" action="appsearch.php" method="post">
      <div class="row">
        <div class="col-md-10">
          <input type="text" name="app_contact" placeholder="Enter Contact" class="form-control">
        </div>
        <div class="col-md-2">
          <input type="submit" name="app_search_submit" class="btn btn-primary" value="Search">
        </div>
      </div>
    </form>
  </div>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Appointment ID</th>
        <th>Patient ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Doctor</th>
        <th>Fees</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $query = "SELECT * FROM appointmenttb";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
          $status = "Unknown";
          if ($row['userStatus'] == 1 && $row['doctorStatus'] == 1) {
            $status = "Active";
          } elseif ($row['userStatus'] == 0 && $row['doctorStatus'] == 1) {
            $status = "Cancelled by Patient";
          } elseif ($row['userStatus'] == 1 && $row['doctorStatus'] == 0) {
            $status = "Cancelled by Doctor";
          }

          echo "<tr>
                  <td>{$row['ID']}</td>
                  <td>{$row['pid']}</td>
                  <td>{$row['fname']}</td>
                  <td>{$row['lname']}</td>
                  <td>{$row['gender']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['contact']}</td>
                  <td>{$row['doctor']}</td>
                  <td>{$row['docFees']}</td>
                  <td>{$row['appdate']}</td>
                  <td>{$row['apptime']}</td>
                  <td>$status</td>
                </tr>";
        }
      ?>
    </tbody>
  </table>
</div>
<!-- Add Doctor -->
<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-adoc-list">
  <form class="form-group" method="post" action="admin-panel1.php">
    <div class="row">
      <div class="col-md-4"><label>Doctor Name:</label></div>
      <div class="col-md-8"><input type="text" class="form-control" name="doctor" onkeydown="return alphaOnly(event);" required></div><br><br>
      
      <div class="col-md-4"><label>Specialization:</label></div>
      <div class="col-md-8">
        <select name="special" class="form-control" required>
          <option disabled selected>Select Specialization</option>
          <option>General</option>
          <option>Cardiologist</option>
          <option>Neurologist</option>
          <option>Pediatrician</option>
        </select>
      </div><br><br>

      <div class="col-md-4"><label>Email ID:</label></div>
      <div class="col-md-8"><input type="email" class="form-control" name="demail" required></div><br><br>

      <div class="col-md-4"><label>Password:</label></div>
      <div class="col-md-8"><input type="password" class="form-control" onkeyup="check();" name="dpassword" id="dpassword" required></div><br><br>

      <div class="col-md-4"><label>Confirm Password:</label></div>
      <div class="col-md-8" id="cpass">
        <input type="password" class="form-control" onkeyup="check();" id="cdpassword" required>
        <span id="message" class="ml-2"></span>
      </div><br><br>

      <div class="col-md-4"><label>Consultancy Fees:</label></div>
      <div class="col-md-8"><input type="text" class="form-control" name="docFees" required></div><br><br>
    </div>
    <input type="submit" name="docsub" value="Add Doctor" class="btn btn-primary">
  </form>
</div>

<!-- Delete Doctor -->
<div class="tab-pane fade" id="list-settings1" role="tabpanel" aria-labelledby="list-ddoc-list">
  <form class="form-group" method="post" action="admin-panel1.php">
    <div class="row">
      <div class="col-md-4"><label>Email ID:</label></div>
      <div class="col-md-8"><input type="email" class="form-control" name="demail" required></div><br><br>
    </div>
    <input type="submit" name="docsub1" value="Delete Doctor" class="btn btn-primary" onclick="return confirm('Do you really want to delete this doctor?')">
  </form>
</div>

<!-- Queries / Messages -->
<div class="tab-pane fade" id="list-mes" role="tabpanel" aria-labelledby="list-mes-list">
  <div class="col-md-8">
    <form class="form-group" action="messearch.php" method="post">
      <div class="row">
        <div class="col-md-10"><input type="text" name="mes_contact" placeholder="Enter Contact" class="form-control"></div>
        <div class="col-md-2"><input type="submit" name="mes_search_submit" class="btn btn-primary" value="Search"></div>
      </div>
    </form>
  </div>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>User Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Message</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $query = "SELECT * FROM contact";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>
                  <td>{$row['name']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['contact']}</td>
                  <td>{$row['message']}</td>
                </tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<!-- Admin Tools -->

<!-- Admin Tools -->
<div class="tab-pane fade" id="list-tools" role="tabpanel" aria-labelledby="list-tools-list">
  <div class="container">
    <h4 class="mb-4">Admin Tools</h4>
    <div class="row">
      <div class="col-md-6 mb-3">
        <a href="generate_salary.php" class="btn btn-outline-primary btn-block">Generate Doctor Salary</a>
      </div>
      <div class="col-md-6 mb-3">
        <a href="generate_payslip.php" class="btn btn-outline-secondary btn-block">Generate Payslip</a>
      </div>
      <div class="col-md-6 mb-3">
        <a href="doctor_roster.php" class="btn btn-outline-success btn-block">Doctor Roster</a>
      </div>
      <div class="col-md-6 mb-3">
        <a href="nurse_roster.php" class="btn btn-outline-info btn-block">Nurse Roster</a>
      </div>
      <div class="col-md-6 mb-3">
        <a href="manage_nurses.php" class="btn btn-outline-warning btn-block">Manage Nurses</a>
      </div>
      <div class="col-md-6 mb-3">
        <a href="view_cabins.php" class="btn btn-outline-dark btn-block">View Cabin Bookings</a>
      </div>
      <div class="col-md-6 mb-3">
        <a href="admin_summary.php" class="btn btn-outline-primary btn-block">Admin Summary</a>
      </div>
    </div>
  </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
  </body>
</html>