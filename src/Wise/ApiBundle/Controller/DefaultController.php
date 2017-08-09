<?php

namespace Wise\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation as Doc;
use FOS\RestBundle\View\View;
use Wise\CoreBundle\Entity\Bail;


/**
 * Class DefaultController
 * @package Wise\ApiBundle\Controller
 * @Route(service="ApiController")
 */
class DefaultController extends FOSRestController
{
    /**
     * Return data home page.
     *
     * @param Request $request
     * @Rest\Get("/homepage", name="app_api_homepage", options={"expose"=true})
     *
     * @Doc\ApiDoc(
     *      section="Homepage",
     *      description="Show data homepage",
     * )
     */
    public function indexAction()
    {
        $view = View::create();
        $view->setData(['homepage' => 'here data homepage']);
        // Define stream format, but is json by default.
        $view->setFormat('json');

        // Create json stream.
        return $this->handleView($view);
    }
}
