<?php
/**
 * Created by PhpStorm.
 *
 * doctrine-bundle
 * (c) 2019 Craig Rayner <craig@craigrayner.com>
 *
 * User: craig
 * Date: 22/03/2019
 * Time: 14:53
 */
namespace Crayner\Doctrine\DependencyInjection;

use Crayner\Doctrine\Listener\TablePrefixSubscriber;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class CraynerDoctrineExtension
 * @package Crayner\Doctrine\DependencyInjection
 */
class CraynerDoctrineExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config        = $this->processConfiguration($configuration, $configs);

        $locator = new FileLocator(__DIR__ . '/../Resources/config');
        $loader  = new YamlFileLoader(
            $container,
            $locator
        );
        $loader->load('services.yaml');

        if (!empty($config['prefix']) && $container->has(TablePrefixSubscriber::class))
        {
            $container
                ->getDefinition(TablePrefixSubscriber::class)
                ->addMethodCall('setPrefix', [$config['prefix']]);
        }
    }

}