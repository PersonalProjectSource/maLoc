<?php

namespace Wise\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Wise\CoreBundle\Entity\Tenant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation as Doc;
use Wise\CoreBundle\Handler\TenantHandler;
use Wise\CoreBundle\Manager\TenantManager;
use Wise\CoreBundle\Repository\TenantRepository;

/**
 * Tenant controller.
 *
 * @Route("tenant")
 */
class TenantController extends FOSRestController
{
    /**
     * Lists all tenant entities.
     *
     * @Rest\View()
     * @Rest\Get("/tenant/list", name="app_tenant_list")
     * @Cache(smaxage="20")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tenants = $em->getRepository('WiseCoreBundle:Tenant')->findAll();
        $view = View::create();
        $view->setFormat('json');
        $view->setData($tenants);
        //$view->getResponse()->setExpires(new \DateTime("+3 hour"));
        //$view->getResponse()->setLastModified(new \DateTime("-1 hour"));

        return $this->handleView($view);
    }

    /**
     * Creates a new tenant entity.
     *
     * @Rest\Post("/tenant/new", name="app_tenant_new")
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $tenant = new Tenant();
        $form = $this->createForm('Wise\CoreBundle\Form\TenantType', $tenant);
        // bind request to form and object references.
        $form->handleRequest($request);
        $view = View::create();
        $view->setFormat('json');
        // data validaton and registration data.
        if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($tenant);
        $em->flush();
        $view->setData(['message' => sprintf('Le locataire %d a été ajouté avec succes', $tenant->getId())]);

        return $this->handleView($view);
    }
        $view->setData(['message' => sprintf('Rien n\'a été enregistré', $tenant->getId())]);

        return $this->handleView($view);
    }

    /**
     * Finds and displays a tenant entity.
     *
     * @Rest\Get("/tenant/{tenantId}", name="tenant_show")
     * @param $tenantId
     * @return Response
     */
    public function showAction($tenantId)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Tenant::class);
        $tenant = $repository->find($tenantId);
        if (null == $tenant) {
            throw new NotFoundResourceException("Aucune ressource n'a été trouvé");
        }
        // Create View and tenant data binding.
        $view = View::create();
        $view->setData(['tenant' => $tenant]);
        $view->setFormat('json');

        return $this->handleView($view);
    }

    /**
     * Displays a form to edit an existing tenant entity.
     *
     * @Rest\Post("/tenant/{tenantId}/edit", name="tenant_edit")
     * @param Request $request
     * @return Response
     * @internal param $tenantId
     */
    public function editAction(Request $request)
    {
        // TODO pourquoi l'edit est du verbe post. Dans ce cas la, le tenantId en attribut d'uri ne sert a rien.
        try{
            $tenant = $this->get(TenantHandler::class)->handle($request);
        } catch (NotFoundResourceException $e) {
            $message = sprintf("Un probleme est survenu : %s", $e->getMessage());
            $tenant = $message;
        }
        // View creation for Json stream.
        $view = View::create();
        $view->setData([
            'tenant' => $tenant
        ]);
        $view->setFormat('json');

        return $this->handleView($view);
    }

    /**
     * Deletes a tenant entity.
     *
     * @Route("/{id}", name="tenant_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tenant $tenant)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($tenant);
        $em->flush();
        // Create view and databinding.
        $view = View::create();
        $view->setFormat('json');
        $view->setData(['message' => "L'entité a bien ete supprimée."]);
        return $this->handleView($view);
    }

}
