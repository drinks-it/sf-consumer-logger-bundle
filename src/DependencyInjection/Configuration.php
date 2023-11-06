<?php
/*
 *     This file is part of Consumer Logger Symfony Bundle.
 *     © 2010-2023 DRINKS | Silverbogen AG
 */

declare(strict_types=1);

namespace DrinksIt\SfConsumerLoggerBundle\DependencyInjection;

use Psr\Log\LogLevel;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $configurationBuilder = new TreeBuilder('sf_consumer_logger');

        $configurationBuilder->getRootNode()
            ->children()
            ->scalarNode('on_start')->defaultValue(LogLevel::INFO)->end()
            ->scalarNode('on_running')->defaultNull()->end()
            ->scalarNode('on_stop')->defaultValue(LogLevel::INFO)->end()
            ->scalarNode('on_start_message')->defaultValue('Consumer started')->end()
            ->scalarNode('on_running_message')->defaultValue('Consumer running')->end()
            ->scalarNode('on_stop_message')->defaultValue('Consumer stopped')->end()
            ->end();

        return $configurationBuilder;
    }
}
