<?php
/**
 * Created by PhpStorm.
 * User: laurentbrau
 * Date: 13/08/2017
 * Time: 20:06
 */

namespace Wise\CoreBundle\Handler;


use Symfony\Component\HttpFoundation\Request;

interface CoreHandlerInterface
{
    public function handle(Request $request);
}