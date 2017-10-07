<?php

namespace Wise\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function indexAction()
    {
         return $this->render("@WiseCore/Security/login.html.twig");
         //return $this->render("@WiseBo/Default/index.html.twig");
    }
}