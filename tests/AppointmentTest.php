<?php
use PHPUnit\Framework\TestCase;

class AppointmentTest extends TestCase {

    protected $db;

    protected function setUp(): void {
        $this->db = new mysqli("localhost", "root", "", "hmsproject");
    }

    public function testDoctorNotAvailableDueToNightShift() {
        $doctor = 'DrAvailable';
        $appDate = '2025-05-01';
        $prevDate = date('Y-m-d', strtotime($appDate . ' -1 day'));

        $stmt = $this->db->prepare("SELECT * FROM doctor_roster 
                                    WHERE doctor_username = ? AND shift = 'Night' AND (date = ? OR date = ?)");
        $stmt->bind_param("sss", $doctor, $appDate, $prevDate);
        $stmt->execute();
        $result = $stmt->get_result();

        $this->assertGreaterThan(0, $result->num_rows, "Doctor should be unavailable due to night shift.");
    }

    public function testDoctorIsAvailableWhenNoNightShift() {
        $doctor = 'DrFree';
        $appDate = '2025-05-05';
        $prevDate = date('Y-m-d', strtotime($appDate . ' -1 day'));

        $stmt = $this->db->prepare("SELECT * FROM doctor_roster 
                                    WHERE doctor_username = ? AND shift = 'Night' AND (date = ? OR date = ?)");
        $stmt->bind_param("sss", $doctor, $appDate, $prevDate);
        $stmt->execute();
        $result = $stmt->get_result();

        $this->assertEquals(0, $result->num_rows, "Doctor should be available as there is no night shift.");
    }
}
