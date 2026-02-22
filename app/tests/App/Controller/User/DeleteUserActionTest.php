<?php

namespace App\Tests\App\Controller\User;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeleteUserActionTest extends WebTestCase
{
    public function testDeleteUserReturnsNoContentStatus(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get('doctrine')->getManager();
        $user = new User();
        $user->setName('User To Delete');
        $user->setEmail('delete@example.com');
        $em->persist($user);
        $em->flush();
        $id = $user->getId();


        $client->request('DELETE', '/api/users/' . $id);
        $this->assertEquals(204, $client->getResponse()->getStatusCode());

        $deletedUser = $em->getRepository(User::class)->find($id);
        $this->assertNull($deletedUser);
    }
}
