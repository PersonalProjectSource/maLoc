<?php

namespace tests\WiseCoreBundle\Handler;


use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Wise\CoreBundle\Entity\Bail;
use Wise\CoreBundle\Form\BailType;
use Wise\CoreBundle\Handler\BailHandler;
use Wise\CoreBundle\Manager\BailManager;
use Wise\CoreBundle\Repository\BailRepository;

class BailHandlerTest extends WebTestCase
{
    private $bailHandler;
    private $formFactory;
    private $manager;
    private $repository;

    public function setUp()
    {
        $this->formFactory = $this->getMockBuilder(FormFactory::class)
            ->setMethods(['create'])
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $this->manager = $this->getMockBuilder(BailManager::class)
            ->setMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $this->repository = $this->getMockBuilder(BailRepository::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $this->bailHandler = new BailHandler($this->manager, $this->formFactory, $this->repository);
    }

    /**
     * public function handle(Request $request)
    {
        $bail = new Bail();
        $form = $this->formFactory->create(BailType::class, $bail);
        $form->handleRequest($request);
        $view = View::create();
        $view->setFormat('json');
        try {
            if ($form->isSubmitted() && $form->isValid()) {
                $this->manager->save($bail);
                $view->setData(['message' => "Le bail a bien été enregistré"]); // TODO faire la gestion des traductions.
            }
        } catch(\Exception $e) {
            $view->setData(['message' => sprintf('Une exception est levée %s', $e->getMessage())]);
        }
            if ($form->isSubmitted() && $form->isValid()) {
                $this->manager->save($bail);
                $view->setData(['message' => "Le bail a bien été enregistré"]); // TODO faire la gestion des traductions.
            }

        return $view;
    }
     * {
            "wise_corebundle_bail":
            {
                "loyer":"999",
                "meuble": true,
                "caution": 2500,
                "dateDebut": "2018-02-17",
                "dateBailEnded": "2018-04-16 00:00:00",
                "type": 1,
                "actif": false
            }
        }
     */
    public function testHandle()
    {
        $request = new Request(
            [],
            [
                'wise_corebundle_bail' => [
                    'loyer' => 'brau',
                    'prenom' => 'laurent',
                    'pseudo' => 'lolo',
                    'email' => 'laurent.brau@gmail.com'
                ]
            ]
        );

        $bail = new Bail();

        $form = $this->getMockBuilder(Form::class)
            ->setMethods(['handleRequest', 'isSubmitted', 'isValid'])
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $form
            ->expects($this->once())
            ->method('handleRequest')
            ->with($request)
            ->willReturn($form)
        ;

        $form
            ->expects($this->once())
            ->method('isSubmitted')
            ->willReturn(true)
        ;

        $form
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(true)
        ;

        $this->formFactory
            ->expects($this->once())
            ->method('create')
            ->with(BailType::class, $bail)
            ->willReturn($form)
        ;

        $this->manager
            ->expects($this->once())
            ->method('save')
            ->with($bail)
        ;

        $this->bailHandler->handle($request);
    }
}