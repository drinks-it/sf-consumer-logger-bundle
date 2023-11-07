<?php
/*
 *     This file is part of Consumer Logger Symfony Bundle.
 *     © 2010-2023 DRINKS | Silverbogen AG
 */

declare(strict_types=1);

namespace DrinksIt\SfConsumerLoggerBundle\Listeners;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\Messenger\Event\WorkerRunningEvent;
use Symfony\Component\Messenger\Event\WorkerStartedEvent;
use Symfony\Component\Messenger\Event\WorkerStoppedEvent;

class WorkerConsumerListener
{
    public function __construct(
        private readonly LoggerInterface $consumerLogger,
        private readonly ?string $logLevelStart = LogLevel::INFO,
        private readonly ?string $logLevelRunning = LogLevel::INFO,
        private readonly ?string $logLevelStopped = LogLevel::INFO,
        private readonly ?string $logLevelStartMessage = 'Consumer started',
        private readonly ?string $logLevelRunningMessage = 'Consumer running',
        private readonly ?string $logLevelStoppedMessage = 'Consumer stopped',
    ) {
    }

    public function onRunningEvent(WorkerRunningEvent $workerRunningEvent): void
    {
        if (!$this->logLevelRunning) {
            return;
        }

        $this->consumerLogger->log($this->logLevelRunning, $this->logLevelRunningMessage, [
            'transport_names' => $workerRunningEvent->getWorker()->getMetadata()->getTransportNames(),
        ]);
    }

    public function onStartedEvent(WorkerStartedEvent $workerStartedEvent): void
    {
        if (!$this->logLevelStart) {
            return;
        }

        $this->consumerLogger->log($this->logLevelStart, $this->logLevelStartMessage, [
            'transport_names' => $workerStartedEvent->getWorker()->getMetadata()->getTransportNames(),
        ]);
    }

    public function onStoppedEvent(WorkerStoppedEvent $workerStoppedEvent): void
    {
        if (!$this->logLevelStopped) {
            return;
        }

        $this->consumerLogger->log($this->logLevelStopped, $this->logLevelStoppedMessage, [
            'transport_names' => $workerStoppedEvent->getWorker()->getMetadata()->getTransportNames(),
        ]);
    }
}
