<?php
require_once('func.php');
require_once('TCPDF/tcpdf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['doctor_username'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $month_label = date('F', mktime(0, 0, 0, $month, 1)) . " $year";

    $doctor = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM doctb WHERE username='$username'"));
    if (!$doctor) die("Doctor not found.");

    $basic = $doctor['basic_pay'];
    $is_visiting = $doctor['is_visiting'];
    $doctor_name = $doctor['username'];

    $appt = mysqli_fetch_assoc(mysqli_query($con, "
        SELECT COUNT(*) AS count FROM appointmenttb 
        WHERE doctor='$username' AND MONTH(appdate)=$month AND YEAR(appdate)=$year
    "))['count'];

    $variable = $appt * ($is_visiting ? 200 : 100);
    $gross = $is_visiting ? $variable : $basic + $variable;

    $insurance = round(0.04 * $basic);
    $prof_tax = round(0.04 * $basic);
    $income_tax = round(0.12 * $basic);
    $deductions = $insurance + $prof_tax + $income_tax;
    $net = $gross - $deductions;

    // Initialize TCPDF
    $pdf = new TCPDF();
    $pdf->SetMargins(15, 20, 15);
    $pdf->AddPage();

    // Header
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 12, "P A Y S L I P   " . strtoupper($month_label), 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->MultiCell(0, 6, "Global Hospital\n123 Health Street, Wellness City\nPhone: XXXXXXX | Email: info@globalhospital.org");
    $pdf->Ln(5);

    // Doctor Info Table
    $pdf->SetFont('helvetica', '', 11);
    $html = "
    <table cellpadding='6' border='1'>
        <tr><td><b>Doctor Name</b></td><td>$doctor_name</td><td><b>Emp No</b></td><td>XXXXXXX</td></tr>
        <tr><td><b>Bank</b></td><td>Bank of Antarctica</td><td><b>Bank A/C No</b></td><td>XXXXXXX</td></tr>
        <tr><td><b>PAN</b></td><td>XXXXXXX</td><td><b>UAN</b></td><td>XXXXXXX</td></tr>
        <tr><td><b>Date of Birth</b></td><td>XXXXXXX</td><td><b>Payment Mode</b></td><td>Bank Transfer</td></tr>
    </table>";
    $pdf->writeHTML($html, true, false, false, false, '');

    $pdf->Ln(5);
    $pdf->SetFont('helvetica', 'B', 13);
    $pdf->Cell(0, 10, "SALARY DETAILS", 0, 1);

    // Salary Table
    $pdf->SetFont('helvetica', '', 11);
    $salary_html = "
    <table cellpadding='6' border='1'>
        <tr style='background-color:#cfe2ff;'>
            <th width='50%'>Earnings</th>
            <th width='50%'>Deductions</th>
        </tr>
        <tr>
            <td>Basic Pay: Rs. $basic</td>
            <td>Insurance (4%): Rs. $insurance</td>
        </tr>
        <tr>
            <td>Variable Pay: Rs. $variable</td>
            <td>Professional Tax (4%): Rs. $prof_tax</td>
        </tr>
        <tr>
            <td>Total Earnings: Rs. $gross</td>
            <td>Income Tax (12%): Rs. $income_tax</td>
        </tr>
        <tr>
            <td></td>
            <td><b>Total Deductions: Rs. $deductions</b></td>
        </tr>
    </table>";
    $pdf->writeHTML($salary_html, true, false, false, false, '');

    // Net Salary
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(150, 12, "Net Salary Payable:", 1);
    $pdf->Cell(0, 12, "Rs. $net", 1, 1, 'R');

    // Footer
    $pdf->Ln(15);
    $pdf->SetFont('helvetica', 'I', 10);
    $pdf->Cell(0, 6, "Admin Signature", 0, 0, 'L');

    if (file_exists("barcode.png")) {
        $pdf->Image("barcode.png", 160, $pdf->GetY(), 30);
    }

    $pdf->Ln(20);
    $pdf->Cell(0, 6, "Note: All amounts are in INR. This payslip is system generated.", 0, 1, 'L');

    $pdf->Output("Payslip_{$doctor_name}_{$month_label}.pdf", 'I');
}
?>
