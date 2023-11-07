<?php
/*
 *     This file is part of Consumer Logger Symfony Bundle.
 *     © 2010-2023 DRINKS | Silverbogen AG
 */

declare(strict_types=1);

namespace DrinksIt\SfConsumerLoggerBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SfConsumerLoggerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setParameter('sf_consumer_logger.log_start_level', $config['on_start']);
        $container->setParameter('sf_consumer_logger.log_running_level', $config['on_running']);
        $container->setParameter('sf_consumer_logger.log_stopped_level', $config['on_stop']);

        $container->setParameter('sf_consumer_logger.log_start_message', $config['on_start_message']);
        $container->setParameter('sf_consumer_logger.log_running_message', $config['on_running_message']);
        $container->setParameter('sf_consumer_logger.log_stopped_message', $config['on_stop_message']);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('event_listeners.xsd');
    }
}
