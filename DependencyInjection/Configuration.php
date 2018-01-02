<?php

declare(strict_types=1);

/*
 * This file is part of Mindy Framework.
 * (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\OrmBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('orm');
        $rootNode
            ->children()
                ->scalarNode('default_connection')
                    ->defaultValue('default')
                ->end()
                ->arrayNode('connections')
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->beforeNormalization()
                        ->ifString()
                        ->then(function ($v) {
                            return ['url' => $v];
                        })
                        ->end()
                        ->children()
                            // http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#driver
                            ->scalarNode('driver')->end()
                            ->scalarNode('dbname')->end()
                            ->scalarNode('host')->end()
                            ->scalarNode('port')->end()
                            ->scalarNode('user')->end()
                            ->scalarNode('password')->end()
                            ->scalarNode('url')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
