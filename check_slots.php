<?php
include('func.php');

if (isset($_POST['doctor']) && isset($_POST['appdate'])) {
    $doctor = $_POST['doctor'];
    $appdate = $_POST['appdate'];

    $result = mysqli_query($con, "SELECT apptime FROM appointmenttb WHERE doctor='$doctor' AND appdate='$appdate'");
    $times = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $times[] = $row['apptime'];
    }

    echo json_encode($times);
}
?>
