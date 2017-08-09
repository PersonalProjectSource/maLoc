<?php

namespace Wise\ApiBundle\Controller;


use Wise\CoreBundle\Entity\Bail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation as Doc;



/**
 * Bail controller.
 * Class BailController
 * @package Wise\ApiBundle\Controller
 */
class BailController extends FOSRestController
{
    /**
     * Lists all bail entities.
     *
     * @Rest\Get("/bail/list", name="app_api_bail_list")
     * @Rest\Get("/", name="app_api_bail_list_bis")
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
        $bails = $em->getRepository('WiseCoreBundle:Bail')->findAll();
        $view = new View();
        $view->setData($bails);
        $view->setFormat('json');

        return $this->handleView($view);
    }

    /**
 * Creates a new bail entity.
 *
 * @Rest\Post("/bail/new", name="app_api_bail_new")
 * @Doc\ApiDoc(
 *      section="Bail",
 *      description="Show bails list",
 *      statusCodes={
 *          200="Returned if bail has been displayed",
 *          422="Returned if list has not been displayed",
 *          500="Returned if server error"
 *      }
 *
 *
 * )
 */
    public function newAction(Request $request)
    {
        $bail = new Bail();
        $form = $this->createForm('Wise\CoreBundle\Form\BailType', $bail);
        $form->handleRequest($request);
        //dump($request, $form->getData(), $bail);die;
        $view = View::create();
        $view->setFormat('json');
        // Is valid n'acceptait pas la soumission car il a fallut modifier un peu le formulaire.
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bail);
            $em->flush();
            $view->setData(['message' => "Le bail a bien été enregistré"]);

            return $this->handleView($view);
        }
        $view->setData(['message' => "Un problème est survenue lors de la validation"]);

        return $this->handleView($view);
    }

    /**
     * Finds and displays a bail entity.
     *
     * @Rest\Get("bail/{bailId}", name="bail_show")
     */
    public function showAction($bailId)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Bail::class);
        $bail = $repository->find($bailId);
        $view = View::create();
        $view->setFormat('json');
        $view->setData($bail);

        return $this->handleView($view);
    }

    /**
     * Displays a form to edit an existing bail entity.
     *
     * @Route("/{id}/edit", name="bail_edit")
     * @Method({"GET", "POST"})
     *
     */
    public function editAction(Request $request, Bail $bail)
    {
        $deleteForm = $this->createDeleteForm($bail);
        $editForm = $this->createForm('Wise\CoreBundle\Form\BailType', $bail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bail_edit', array('id' => $bail->getId()));
        }

        return $this->render('bail/edit.html.twig', array(
            'bail' => $bail,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bail entity.
     *
     * @Route("/{id}", name="bail_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $bailId)
    {
        $em = $this->getDoctrine()->getManager();
        $bail = $em->getRepository('WiseCoreBundle:Bail')->find($bailId);
        $em->remove($bail);
        $em->flush();
        $view = View::create();
        $view->setData(['message' => 'La suppression a bien été efffectuée']);
        $view->setFormat('json');

        return $this->handleView($view);
    }
}
