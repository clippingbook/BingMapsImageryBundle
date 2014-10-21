<?php

namespace Carlosromero\BingMapsImageryBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CarlosromeroBingMapsImageryExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
       $processor = new Processor();
       $configuration = new Configuration();
       $config = $processor->processConfiguration($configuration, $configs);

       $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

       $loader->load('bing_maps_imagery.xml');

       $container->setParameter('carlosromero_bing_maps_imagery.api_client.class', $config['class']['api_client']);
       $container->setParameter('carlosromero_bing_maps_imagery.client.class', $config['class']['client']);

       foreach (array('key', 'map_type', 'base_url') as $attribute) {
           $container->setParameter('carlosromero_bing_maps_imagery.'.$attribute, $config[$attribute]);
       }
    }
}
