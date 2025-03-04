<?php

namespace App\Tests\App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateUserActionTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/users',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'name'  => 'New User',
                'email' => 'newuser@example.com'
            ])
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());

        $content = $client->getResponse()->getContent();
        $data = json_decode($content, true);
        $this->assertArrayHasKey('id', $data);
        $this->assertEquals('New User', $data['name']);
        $this->assertEquals('newuser@example.com', $data['email']);
    }
}
