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

        // Submit a raw JSON string in the request body
        $client->request(
            'POST',
            'api/bail/new',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '
            {
                "wise_corebundle_bail":
                        {
                            "loyer": 3333,
                            "meuble": true,
                            "caution": 4444,
                            "dateDebut": "2018-02-17",
                            "dateBailEnded": "2018-04-16 00:00:00",
                            "type": 1,
                            "actif": false
                        }
            }'
        );

        $content = json_decode($client->getResponse()->getContent());
        $this->assertContains("Le bail a bien été enregistré", $content->message);
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

}
