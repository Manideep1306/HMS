<?php
use PHPUnit\Framework\TestCase;

class SearchFunctionalityTest extends TestCase {
    protected $db;

    protected function setUp(): void {
        $this->db = new mysqli("localhost", "root", "", "hmsproject");
    }

    public function testDoctorSearchBySpecialization() {
        $spec = 'Cardiology';
        $result = $this->db->query("SELECT * FROM doctb WHERE spec = '$spec'");
        $this->assertIsObject($result);
    }
}