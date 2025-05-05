<?php
use PHPUnit\Framework\TestCase;

class AdminSummaryTest extends TestCase {
    protected $db;

    protected function setUp(): void {
        $this->db = new mysqli("localhost", "root", "", "hms");
    }

    public function testTotalAppointmentsCount() {
        $result = $this->db->query("SELECT COUNT(*) as total FROM appointmenttb");
        $row = $result->fetch_assoc();
        $this->assertGreaterThanOrEqual(0, (int)$row['total']);
    }

    public function testTotalIncomeCalculation() {
        $result = $this->db->query("SELECT SUM(docFees) as total FROM appointmenttb");
        $row = $result->fetch_assoc();
        $this->assertIsNumeric($row['total']);
    }
}