<?php
use PHPUnit\Framework\TestCase;

class ChangePasswordTest extends TestCase {
    protected $db;

    protected function setUp(): void {
        $this->db = new mysqli("localhost", "root", "", "hmsproject");
    }

    public function testChangePasswordReflectsInDatabase() {
        $username = 'admin';
        $newpass = 'test1234';

        $this->db->query("UPDATE admintb SET password = '$newpass' WHERE username = '$username'");
        $result = $this->db->query("SELECT * FROM admintb WHERE username = '$username' AND password = '$newpass'");
        $this->assertEquals(1, $result->num_rows);
    }
}