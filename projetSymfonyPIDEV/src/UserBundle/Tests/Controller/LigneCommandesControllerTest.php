<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LigneCommandesControllerTest extends WebTestCase
{
    public function testAjouterlignecommande()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouterLigneCommande');
    }

}
