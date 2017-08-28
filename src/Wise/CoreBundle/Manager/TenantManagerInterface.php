<?php
/**
 * Created by PhpStorm.
 * User: laurentbrau
 * Date: 13/08/2017
 * Time: 21:17
 */

namespace Wise\CoreBundle\Manager;
use Symfony\Component\HttpFoundation\Request;
use Wise\CoreBundle\Entity\Tenant;

interface TenantManagerInterface
{
    public function save(Tenant $tenant);
}