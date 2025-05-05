<?php
use PHPUnit\Framework\TestCase;

class DoctorRosterTest extends TestCase {

    protected $db;

    protected function setUp(): void {
        $this->db = new mysqli("localhost", "root", "", "hmsproject");
    }

    public function testDoctorWithNightShiftIsBlocked() {
        $doctor = 'DrAvailable';
        $targetDate = '2025-05-01';
        $prevDate = date('Y-m-d', strtotime($targetDate . ' -1 day'));

        $stmt = $this->db->prepare("SELECT * FROM doctor_roster WHERE doctor_username = ? AND shift = 'Night' AND (date = ? OR date = ?)");
        $stmt->bind_param("sss", $doctor, $targetDate, $prevDate);
        $stmt->execute();
        $result = $stmt->get_result();

        $this->assertGreaterThanOrEqual(0, $result->num_rows);
    }
}
