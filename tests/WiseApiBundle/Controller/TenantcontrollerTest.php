<?php

namespace tests\WiseApiBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Wise\CoreBundle\Tests\WebTestCase;

class TenantcontrollerTest extends WebTestCase
{
    private $client;
    private $em;

    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $this->client = static::createClient();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testIndexAction()
    {
        $this->loadFixtures(self::$kernel);

        $clientSimple = static::createClient();
        $crawler = $clientSimple->request('GET', '/api/tenant/list');

        $this->assertContains("BRAU", $clientSimple->getResponse()->getContent());
        $this->assertEquals(Response::HTTP_OK, $clientSimple->getResponse()->getStatusCode());
    }
}