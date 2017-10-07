<?php

namespace Wise\BoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wise\ApiBundle\WiseApiBundle;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@WiseCore/Security/login.html.twig');
    }
}
