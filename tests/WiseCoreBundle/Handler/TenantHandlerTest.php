<?php


namespace tests\WiseApiBundle\Handler;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Wise\CoreBundle\Entity\Tenant;
use Wise\CoreBundle\Form\TenantType;
use Wise\CoreBundle\Handler\TenantHandler;
use Wise\CoreBundle\Manager\TenantManager;
use Wise\CoreBundle\Repository\TenantRepository;


class TenantHandlerTest extends TestCase
{

    private $tenantHandler;
    private $tenantManger;
    private $formFactory;
    private $repository;

    /**
     *
     */
    public function setUp()
    {
        $this->tenantManger = $this->getMockBuilder(TenantManager::class)
            ->setMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $this->formFactory = $this->getMockBuilder(FormFactory::class)
            ->setMethods(['create'])
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->repository = $this->getMockBuilder(TenantRepository::class)
            ->setMethods(['findOneBy'])
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $this->tenantHandler = new TenantHandler($this->tenantManger, $this->formFactory, $this->repository);
    }
    /**
     * public function handle(Request $request)
        {
            $data = $request->request->all();
            $tenant = new Tenant();
            $tenantForm = $this->formFactory->create('Wise\CoreBundle\Form\TenantType', $tenant);
            // TODO faire un test si les validateur des entités se déclenchent au submit.
            $tenantForm->submit($data);
            $this->manager->save($tenant);

            return $tenant;
        }
     */
    public function testHandle()
    {
        $request = new Request(
            [],
            ['nom' => 'brau', 'prenom' => 'laurent', 'pseudo' => 'lolo', 'email' => 'laurent.brau@gmail.com']);
        $tenant = new Tenant();
        $tenant->setPseudo('lolo');
        $tenant->setPrenom('laurent');
        $tenant->setNom('brau');
        //$data = $request->request->all();

        $tenantForm = $this->getMockBuilder(Form::class)
            ->setMethods(['submit'])
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $tenantForm
            ->expects($this->once())
            ->method('submit')
            ->with(['nom' => 'brau', 'prenom' => 'laurent', 'pseudo' => 'lolo', 'email' => 'laurent.brau@gmail.com'])
        ;

        $this->repository
            ->expects($this->once())
            ->method('findOneBy')
            ->with(['email' => 'laurent.brau@gmail.com'])
            ->willReturn($tenant);
        ;

        $this->formFactory
            ->expects($this->once())
            ->method('create')
            ->with(TenantType::class, $tenant)
            ->willReturn($tenantForm)
        ;

        $this->tenantManger
            ->expects($this->once())
            ->method('save')
            ->with($tenant)
        ;

        $this->assertEquals($tenant, $this->tenantHandler->handle($request));

        //$this->assertInstanceOf(Tenant::class, $result);
        //$this->assertEquals($tenant, $result);
    }
}