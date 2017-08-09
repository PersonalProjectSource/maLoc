<?php

namespace Wise\ApiBundle\Controller;

use Wise\CoreBundle\Entity\Tenant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

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

            //return $this->redirectToRoute('tenant_show', array('id' => $tenant->getId()));
        }

        //return $this->render('tenant/new.html.twig', array(
        //    'tenant' => $tenant,
        //    'form' => $form->createView(),
        //));
        return;
    }

    /**
     * Finds and displays a tenant entity.
     *
     * @Route("/{id}", name="tenant_show")
     * @Method("GET")
     */
    public function showAction(Tenant $tenant)
    {
        $deleteForm = $this->createDeleteForm($tenant);

        return $this->render('tenant/show.html.twig', array(
            'tenant' => $tenant,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tenant entity.
     *
     * @Route("/{id}/edit", name="tenant_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tenant $tenant)
    {
        $deleteForm = $this->createDeleteForm($tenant);
        $editForm = $this->createForm('Wise\CoreBundle\Form\TenantType', $tenant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tenant_edit', array('id' => $tenant->getId()));
        }

        return $this->render('tenant/edit.html.twig', array(
            'tenant' => $tenant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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
