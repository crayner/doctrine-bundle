<?php
/**
 * Created by PhpStorm.
 *
 * authentication-bundle
 * (c) 2019 Craig Rayner <craig@craigrayner.com>
 *
 * User: craig
 * Date: 23/03/2019
 * Time: 15:45
 */
namespace Crayner\Doctrine\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Crayner\Doctrine\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('crayner_doctrine');
        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('prefix')->defaultNull()->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
