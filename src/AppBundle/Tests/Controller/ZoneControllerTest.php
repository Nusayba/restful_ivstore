<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ZoneControllerTest extends WebTestCase
{
    public function testRemovezone()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/removeZone');
    }

}
