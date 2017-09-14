<?php

namespace tests\WiseApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BailControllerTest extends WebTestCase
{
    public function testIndexAction()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', 'api/bail/list');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /bail/");
        $this->assertContains("La Baumette", $client->getResponse()->getContent(), "The json stream is not that expected");
    }

    public function testNewAction()
    {
        $client = static::createClient();
        $client->request('POST', 'api/bail/new',
            [
                'nom' => 'laurent',
                'prenom' => 'BRAU'
            ]
        );
        //$client->getResponse()->setCharset('UTF-8');
        //$client->getResponse()->setCharset('ISO-8859-1');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertContains("Le bail a bien été enregistré", $client->getResponse()->getContent());
    }

}
