<?php

namespace Wise\CoreBundle\Handler;



use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\CssSelector\Parser\Handler\HandlerInterface;
use Wise\CoreBundle\Entity\Tenant;
use Wise\CoreBundle\Manager\TenantManager;
use Wise\CoreBundle\Repository\TenantRepository;


class TenantHandler implements CoreHandlerInterface
{
    private $manager;
    private $formFactory;
    private $repository;

    public function __construct(TenantManager $manager, FormFactoryInterface $factory, TenantRepository $repository)
    {
        $this->manager = $manager;
        $this->formFactory = $factory;
        $this->repository = $repository;
    }

    /**
     * Persist and flush a tenant entity.
     *
     * @param Request $request
     * @return Tenant
     */
    public function handle(Request $request)
    {
        $data = $request->request->all();
        $tenant = $this->repository->findOneBy(['email' => $data['email']]);
        $tenantForm = $this->formFactory->create('Wise\CoreBundle\Form\TenantType', $tenant);
        // TODO faire un test si les validateur des entités se déclenchent au submit.
        $tenantForm->submit($data);

        return $this->manager->save($tenant);
    }
}