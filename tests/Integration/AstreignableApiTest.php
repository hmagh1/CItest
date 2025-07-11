<?php
namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AstreignableApiTest extends WebTestCase
{
    public function testList(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/astreignables');
        $this->assertResponseIsSuccessful();
    }
}
