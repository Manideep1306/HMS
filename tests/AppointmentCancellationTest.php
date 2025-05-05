<?php
use PHPUnit\Framework\TestCase;

class AppointmentCancellationTest extends TestCase {
    protected $db;
    
    protected function setUp(): void {
        $this->db = new mysqli("localhost", "root", "", "hmsproject");
    }

    public function testCancelAppointmentStatusChange() {
        $appointmentId = 1;
        $this->db->query("UPDATE appointmenttb SET userStatus = 0 WHERE ID = $appointmentId");
        $result = $this->db->query("SELECT userStatus FROM appointmenttb WHERE ID = $appointmentId");
        $row = $result->fetch_assoc();
        $this->assertEquals(0, $row['userStatus']);
    }
}