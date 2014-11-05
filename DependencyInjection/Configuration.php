<?php

namespace Clippingbook\BingMapsImageryBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
       $treeBuilder = new TreeBuilder();
       $rootNode = $treeBuilder->root('clippingbook_bing_maps_imagery');

       $rootNode
           ->children()
               ->scalarNode('key')->isRequired()->cannotBeEmpty()->end()
               ->scalarNode('map_type')->defaultValue('Road')->end()
               ->scalarNode('base_url')->defaultValue('')->end()
               ->arrayNode('class')
                   ->addDefaultsIfNotSet()
                   ->children()
                       ->scalarNode('api_client')->defaultValue('Clippingbook\\BingMapsImageryBundle\\Api\\ApiClient')->end()
                       ->scalarNode('client')->defaultValue('Guzzle\\Http\\Client')->end()
                   ->end()
               ->end()
           ->end();

       return $treeBuilder;
    }
}
