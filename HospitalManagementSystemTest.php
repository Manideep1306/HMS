<?php

use PHPUnit\Framework\TestCase;

class HospitalManagementSystemTest extends TestCase
{
    protected $mysqli;

    protected function setUp(): void
    {
        // Mock MySQLi connection
        $this->mysqli = $this->createMock(mysqli::class);
    }

    public function testDisplayDoctors()
    {
        $mockResult = [
            ['name' => 'Dr. Smith'],
            ['name' => 'Dr. Jane'],
        ];

        // Mock mysqli_query and mysqli_fetch_array behavior
        $stmt = $this->createMock(mysqli_result::class);
        $stmt->method('fetch_array')->willReturnOnConsecutiveCalls(...$mockResult, false);

        $this->mysqli->method('query')->willReturn($stmt);

        ob_start();
        // Assume display_docs is rewritten to accept connection as a parameter
        display_docs($this->mysqli);
        $output = ob_get_clean();

        $this->assertStringContainsString('<option value="Dr. Smith">Dr. Smith</option>', $output);
        $this->assertStringContainsString('<option value="Dr. Jane">Dr. Jane</option>', $output);
    }

    public function testSuccessfulAdminLogin()
    {
        $username = 'admin';
        $password = 'password';

        $stmt = $this->createMock(mysqli_result::class);
        $stmt->method('num_rows')->willReturn(1);

        $this->mysqli->method('query')->willReturn($stmt);

        $result = validate_admin_login($this->mysqli, $username, $password);

        $this->assertTrue($result);
    }

    public function testFailedAdminLogin()
    {
        $username = 'wrong';
        $password = 'wrongpass';

        $stmt = $this->createMock(mysqli_result::class);
        $stmt->method('num_rows')->willReturn(0);

        $this->mysqli->method('query')->willReturn($stmt);

        $result = validate_admin_login($this->mysqli, $username, $password);

        $this->assertFalse($result);
    }

    public function testPatientRegistrationSuccess()
    {
        $patientData = [
            'fname' => 'John',
            'lname' => 'Doe',
            'gender' => 'Male',
            'email' => 'john@example.com',
            'contact' => '1234567890',
            'password' => 'test123',
            'cpassword' => 'test123',
        ];

        $this->mysqli->method('query')->willReturn(true);

        $result = register_patient($this->mysqli, $patientData);

        $this->assertTrue($result);
    }

    public function testPatientRegistrationPasswordMismatch()
    {
        $patientData = [
            'fname' => 'John',
            'lname' => 'Doe',
            'gender' => 'Male',
            'email' => 'john@example.com',
            'contact' => '1234567890',
            'password' => 'test123',
            'cpassword' => 'wrong123',
        ];

        $result = register_patient($this->mysqli, $patientData);

        $this->assertFalse($result);
    }
}

// Helper function mocks for testing
function display_docs($con)
{
    $query = "SELECT * FROM doctb";
    $result = $con->query($query);
    while ($row = $result->fetch_array()) {
        echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
    }
}

function validate_admin_login($con, $username, $password)
{
    $query = "SELECT * FROM admintb WHERE username='$username' AND password='$password';";
    $result = $con->query($query);
    return $result->num_rows === 1;
}

function register_patient($con, $data)
{
    if ($data['password'] !== $data['cpassword']) {
        return false;
    }
    $query = "INSERT INTO patreg(fname, lname, gender, email, contact, password, cpassword) 
              VALUES ('{$data['fname']}','{$data['lname']}','{$data['gender']}','{$data['email']}','{$data['contact']}','{$data['password']}','{$data['cpassword']}')";
    return $con->query($query);
}
