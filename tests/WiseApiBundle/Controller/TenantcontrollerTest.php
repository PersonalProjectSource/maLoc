<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;

class TenantcontrollerTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
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
        return;
    }
}