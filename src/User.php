<?php
namespace App;

class User {
    public function getGreeting(string $name): string {
        return "Hello, " . $name;
    }
}
