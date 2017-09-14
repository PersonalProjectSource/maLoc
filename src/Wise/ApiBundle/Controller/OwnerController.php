<?php

namespace Wise\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Wise\CoreBundle\Entity\Owner;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Owner controller.
 *
 */
class OwnerController extends FOSRestController
{
    /**
     * Lists all owner entities.
     *
     * @Rest\Get("/owner/list", name="app_owner_list")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $owners = $em->getRepository('WiseCoreBundle:Owner')->findAll();

        $view = View::create();
        $view->getFormat('json');
        $view->setData($owners);

        return $this->handleView($view);
    }

    /**
     * Creates a new owner entity.
     *
     * @Route("/new", name="owner_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $owner = new Owner();
        $form = $this->createForm('Wise\CoreBundle\Form\OwnerType', $owner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($owner);
            $em->flush();

            return $this->redirectToRoute('owner_show', array('id' => $owner->getId()));
        }

        return $this->render('owner/new.html.twig', array(
            'owner' => $owner,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a owner entity.
     *
     * @Rest\Get("/owner/{id}", name="owner_show")

     * @ParamConverter("owner", class="WiseCoreBundle:Owner")

     */
    public function showAction(Owner $owner)
    {
        $view = View::create();
        $view->getFormat('json');
        $view->setData($owner);

        return $this->handleView($view);
    }

    /**
     * Displays a form to edit an existing owner entity.
     *
     * @Route("/{id}/edit", name="owner_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Owner $owner)
    {
        $deleteForm = $this->createDeleteForm($owner);
        $editForm = $this->createForm('Wise\CoreBundle\Form\OwnerType', $owner);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('owner_edit', array('id' => $owner->getId()));
        }

        return $this->render('owner/edit.html.twig', array(
            'owner' => $owner,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a owner entity.
     *
     * @Route("/{id}", name="owner_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Owner $owner)
    {
        $form = $this->createDeleteForm($owner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($owner);
            $em->flush();
        }

        return $this->redirectToRoute('owner_index');
    }

    /**
     * Creates a form to delete a owner entity.
     *
     * @param Owner $owner The owner entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Owner $owner)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('owner_delete', array('id' => $owner->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
