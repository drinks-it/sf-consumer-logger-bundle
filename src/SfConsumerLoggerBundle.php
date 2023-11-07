<?php
/*
 *     This file is part of Consumer Logger Symfony Bundle.
 *     © 2010-2023 DRINKS | Silverbogen AG
 */

declare(strict_types=1);

namespace DrinksIt\SfConsumerLoggerBundle;

use DrinksIt\SfConsumerLoggerBundle\DependencyInjection\SfConsumerLoggerExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @codeCoverageIgnore
 */
class SfConsumerLoggerBundle extends Bundle
{
    public function getContainerExtensionClass(): string
    {
        return SfConsumerLoggerExtension::class;
    }
}
