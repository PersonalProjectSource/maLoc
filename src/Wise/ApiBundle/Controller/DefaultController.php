<?php

namespace Wise\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation as Doc;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Wise\CoreBundle\Entity\Bail;
use Wise\CoreBundle\Entity\Tenant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;


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
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param Request $request
     * @Rest\Get("/", name="app_api_homepage", options={"expose"=true})
     *
     * @Doc\ApiDoc(
     *      section="Homepage",
     *      description="Show data homepage",
     * )
     */
    public function indexAction(Request $request)
    {
        $view = View::create();
        $tenants = $this->getDoctrine()->getManager()->getRepository(Tenant::class)->findAll();
        $view->setData(['tenants' => $tenants]);
        // Define stream format, but is Json by default.
        $view->setFormat('json');

        // With John.
        $response = $this->handleView($view);
        $response->setEtag(md5($response->getContent()));
        if ($response->isNotModified($request)) {
            // envoie la réponse 304 tout de suite
            return $response;
        }

        // Create json stream.
        return $response;
    }
}
