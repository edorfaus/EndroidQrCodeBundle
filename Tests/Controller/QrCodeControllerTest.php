<?php

namespace Endroid\Bundle\TileBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QrCodeControllerTest extends WebTestCase
{
    public function testCreateTile()
    {
        $client = static::createClient();
        $client->request('GET', '/qrcode/Life is too short to be generating QR codes.png');

        return $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}