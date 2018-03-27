<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PromotionsControllerTest extends WebTestCase
{
    public function testGestionpromotions()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/gestionPromotions');
    }

    public function testSupprimerpromotion()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/supprimerPromotion');
    }

    public function testModifierpromotion()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifierPromotion');
    }

}
