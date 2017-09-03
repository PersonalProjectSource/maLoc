<?php

namespace tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

class WebTestCase extends BaseWebTestCase
{
    protected function loadFixtures($kernel, $withFixtures = true)
    {
        $app = new Application($kernel);
        $app->setAutoExit(false);

        $app->run(new ArrayInput([
            'command' => 'doctrine:database:drop',
            '--force' => true,
            '--quiet' => true
        ]));
        // See http://stackoverflow.com/questions/7134469/doctrine-2-close-connection
        $kernel->getContainer()->get('doctrine')->getManager()->getConnection()->close();

        $app->run(new ArrayInput([
            'command' => 'doctrine:database:create',
            '--quiet' => true
        ]));

        $app->run(new ArrayInput([
            'command' => 'doctrine:schema:create',
            '--quiet' => true
        ]));

        if ($withFixtures) {
            $app->run(new ArrayInput([
                'command'          => 'doctrine:fixtures:load',
                '--quiet'          => true,
                '--no-interaction' => true,
            ]));
        }
    }
}