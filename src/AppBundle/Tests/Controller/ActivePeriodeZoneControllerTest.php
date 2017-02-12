<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ActivePeriodeZoneControllerTest extends WebTestCase
{
    public function testGetactiveperiodes()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getActivePeriodes');
    }

    public function testPostactiveperiodes()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/postActivePeriodes');
    }

}
