<?php
use PHPUnit\Framework\TestCase;
use App\UserController;

class UserControllerTest extends TestCase {
    private UserController $controller;

    protected function setUp(): void {
        $this->controller = new UserController();
    }

    public function testCreateUserAndGetUser() {
        $created = json_decode($this->controller->createUser("Alice", "alice@example.com"), true);
        $this->assertArrayHasKey("id", $created);

        $fetched = json_decode($this->controller->getUser((int)$created["id"]), true);
        $this->assertEquals("Alice", $fetched["name"]);
        $this->assertEquals("alice@example.com", $fetched["email"]);
    }

    public function testUpdateUser() {
        $created = json_decode($this->controller->createUser("Bob", "bob@example.com"), true);
        $updated = json_decode($this->controller->updateUser((int)$created["id"], "Bobby", "bobby@example.com"), true);

        $this->assertEquals("Bobby", $updated["name"]);
        $this->assertEquals("bobby@example.com", $updated["email"]);
    }

    public function testDeleteUser() {
        $created = json_decode($this->controller->createUser("Charlie", "charlie@example.com"), true);
        $deleted = json_decode($this->controller->deleteUser((int)$created["id"]), true);
        $this->assertTrue($deleted["deleted"]);
    }

    public function testGetAllUsersReturnsArray() {
        $response = $this->controller->getAllUsers();
        $data = json_decode($response, true);
        $this->assertIsArray($data);
    }
}
