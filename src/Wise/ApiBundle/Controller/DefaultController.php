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
    public function test() {
        dump('voici le test');
    }

    /**
     * Return bails list.
     * @param Request $request
     * @Rest\Get("/", name="app_api_bail_list", options={"expose"=true})
     * @return View
     *
     * @Doc\ApiDoc(
     *      section="Bail",
     *      description="Show bails list",
     *      statusCodes={
     *          200="Returned if bail has been displayed",
     *          422="Returned if list has not been displayed",
     *          500="Returned if server error"
     *      }
     * )
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $bails = $em->getRepository(Bail::class)->findAll();
        $view = View::create();
        $view->setData($bails);
        // Define stream format, but is json by default.
        $view->setFormat('json');

        // Create json stream.
        return $this->handleView($view);
    }
}
