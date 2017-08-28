<?php

namespace Wise\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     * @Rest\Get("/tenant/list", name="app_tenant_list")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tenants = $em->getRepository('WiseCoreBundle:Tenant')->findAll();
        $view = View::create();
        $view->setFormat('json');
        $view->setData($tenants);

        return $this->handleView($view);
    }

    /**
     * Creates a new tenant entity.
     *
     * @Rest\Get("/tenant/new", name="app_tenant_new")
     */
    public function newAction(Request $request)
    {
        $tenant = new Tenant();
        $form = $this->createForm('Wise\CoreBundle\Form\TenantType', $tenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tenant);
            $em->flush();
        }

        $view = View::create();
        $view->setData(['message' => 'Le locataire a été ajouté avec succes']);
        $view->setFormat('json');

        return $this->handleView($view);
    }

    /**
     * Finds and displays a tenant entity.
     *
     * @Rest\Get("/tenant/{tenantId}", name="tenant_show")
     */
    public function showAction($tenantId)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Tenant::class);
        $tenant = $repository->find($tenantId); // TODO faire une gestion d'exception si pas trouvé.
        $view = View::create();
        $view->setData(['tenant' => $tenant]);
        $view->setFormat('json');

        return $this->handleView($view);
    }

    /**
     * Displays a form to edit an existing tenant entity.
     *
     * @Rest\Post("/tenant/{tenantId}/edit", name="tenant_edit")
     */
    public function editAction(Request $request, $tenantId)
    {
        $tenant = $this->get(TenantHandler::class)->handle($request);
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
        $form = $this->createDeleteForm($tenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tenant);
            $em->flush();
        }

        return $this->redirectToRoute('tenant_index');
    }

    /**
     * Creates a form to delete a tenant entity.
     *
     * @param Tenant $tenant The tenant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tenant $tenant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tenant_delete', array('id' => $tenant->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
