<?php

namespace Wise\CoreBundle\Handler;


use Doctrine\ORM\Repository\RepositoryFactory;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Wise\CoreBundle\Entity\Bail;
use Wise\CoreBundle\Form\BailType;
use Wise\CoreBundle\Manager\BailManager;
use Wise\CoreBundle\Repository\BailRepository;

class BailHandler implements CoreHandlerInterface
{
    private $manager;
    private $formFactory;
    private $repository;

    public function __construct(BailManager $manager, FormFactory $formFactory, BailRepository $repositoryFactory)
    {
        $this->manager = $manager;
        $this->formFactory = $formFactory;
        $this->repository = $repositoryFactory;
    }

    /**
     * Handle bail request for generate view.
     *
     * @param Request $request
     * @return View
     */
    public function handle(Request $request)
    {
        //$form = $this->createForm(BailType::class, $bail);
        $bail = new Bail();
        $form = $this->formFactory->create(BailType::class, $bail);
        $form->handleRequest($request);
        $view = View::create();
        $view->setFormat('json');
        /*try {
            // Is valid n'acceptait pas la soumission car il a fallu modifier un peu le formulaire.
            if ($form->isSubmitted() && $form->isValid()) {
                $this->manager->save($bail);
                $view->setData(['message' => "Le bail a bien été enregistré"]); // TODO faire la gestion des traductions.
            }
        } catch(\Exception $e) {
            $view->setData(['message' => sprintf('Une exception est levée %s', $e->getMessage())]);
        }*/

        // Is valid n'acceptait pas la soumission car il a fallu modifier un peu le formulaire.
        if ($form->isSubmitted() && $form->isValid()) {
            dump('pass');
            $this->manager->save($bail);
            $view->setData(['message' => "Le bail a bien été enregistré"]); // TODO faire la gestion des traductions.
        }
        dump('passpa');

        return $view;
    }
}