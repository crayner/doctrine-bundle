<?php
/**
 * Created by PhpStorm.
 *
 * Doctrine Bundle Project
 * (c) 2019 Craig Rayner <craig@craigrayner.com>
 *
 * User: craig
 * Date: 22/03/2019
 * Time: 14:29
 */
namespace Crayner\Doctrine;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CraynerDoctrineBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }

}