<?php

namespace Wise\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WiseCoreBundle:Default:index.html.twig');
    }
}
