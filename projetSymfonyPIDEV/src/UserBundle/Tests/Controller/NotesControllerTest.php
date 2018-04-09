<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NotesControllerTest extends WebTestCase
{
    public function testAjouterrating()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouterRating');
    }

}
