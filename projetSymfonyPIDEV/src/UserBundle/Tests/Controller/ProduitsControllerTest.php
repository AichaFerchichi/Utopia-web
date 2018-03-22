<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitsControllerTest extends WebTestCase
{
    public function testGestionproduits()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/gestionProduits');
    }

}
