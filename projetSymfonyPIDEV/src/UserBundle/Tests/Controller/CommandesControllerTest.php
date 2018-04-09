<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandesControllerTest extends WebTestCase
{
    public function testAjoutercommande()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouterCommande');
    }

}
