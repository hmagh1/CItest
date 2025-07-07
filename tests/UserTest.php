<?php
use PHPUnit\Framework\TestCase;
use App\User;

class UserTest extends TestCase {
    public function testGreeting() {
        $user = new User();
        $this->assertEquals("Hello, John", $user->getGreeting("John"));
    }
}
