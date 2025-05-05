<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    protected $db;

    protected function setUp(): void {
        $this->db = new mysqli("localhost", "root", "", "hmsproject");
    }

    public function testAdminLoginWorks() {
        $username = 'admin';
        $password = 'test1234'; // updated to match DB
    
        $result = $this->db->query("SELECT * FROM admintb WHERE username='$username' AND password='$password'");
        $this->assertGreaterThan(0, $result->num_rows, "Admin login should succeed with correct credentials.");
    }
    

    public function testWrongLoginFails() {
        $username = 'fakeuser';
        $password = 'wrongpass';

        $result = $this->db->query("SELECT * FROM admintb WHERE username='$username' AND password='$password'");
        $this->assertEquals(0, $result->num_rows, "Login should fail for invalid credentials.");
    }
}