<?php
use PHPUnit\Framework\TestCase;

class PatientAccessTest extends TestCase {
    protected $db;

    protected function setUp(): void {
        $this->db = new mysqli("localhost", "root", "", "hmsproject");
    }

    public function testPatientAppointmentHistoryAccess() {
        $email = 'patient@example.com';

        $result = $this->db->query("SELECT * FROM appointmenttb WHERE email = '$email'");
        $this->assertIsObject($result, "Patient should be able to access their appointment history.");
    }
}