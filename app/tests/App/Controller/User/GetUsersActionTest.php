<?php

namespace App\Tests\App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetUsersActionTest extends WebTestCase
{
    public function testGetUsers(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/users');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = $client->getResponse()->getContent();
        $data = json_decode($content, true);
        $this->assertIsArray($data);
        $this->assertCount(10, $data);
        $this->assertMatchesRegularExpression('/Test\sUser\d/', $data[0]['name']);
        $this->assertMatchesRegularExpression('/\dtest@test\.com/', $data[0]['email']);
    }
}
