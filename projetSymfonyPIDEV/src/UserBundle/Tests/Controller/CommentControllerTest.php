<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentControllerTest extends WebTestCase
{
    public function testAffichagecommentaires()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/affichageCommentaires');
    }

}
