<?php

namespace Wise\BoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wise\ApiBundle\WiseApiBundle;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $cont = $this->container->get('ApiController');
        $cont->test();
        return $this->render('WiseBoBundle:Default:index.html.twig');
    }
}
