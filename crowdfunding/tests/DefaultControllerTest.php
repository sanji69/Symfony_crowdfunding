<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('h1:contains("Hello World")')->count());
    }

    public function testCheckPassword(){
        $client = static::createClient();

        $crawler = $client->request(
            'GET',
            '/register'
        );

        $form = $crawler->selectButton('Register!')->form();

        $form['users[email]'] = 'toto@email.com';
        $form['users[username]'] = 'usernametest';
        $form['users[firstname]'] = 'John';
        $form['users[lastname]'] = 'Doe';
        $form['users[password][first]'] = 'pass1';
        $form['users[password][second]'] = 'pass2';

        $crawler = $client->submit($form);

        //echo $client->getResponse()->getContent();


        $this->assertEquals(1,
            $crawler->filter('li:contains("This value is not valid.")')->count()
        );
    }
}
