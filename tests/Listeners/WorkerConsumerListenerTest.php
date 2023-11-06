<?php
/*
 *     This file is part of Consumer Logger Symfony Bundle.
 *     © 2010-2023 DRINKS | Silverbogen AG
 */

declare(strict_types=1);

namespace DrinksIt\SfConsumerLoggerBundle\Listeners;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Event\WorkerRunningEvent;
use Symfony\Component\Messenger\Event\WorkerStartedEvent;
use Symfony\Component\Messenger\Event\WorkerStoppedEvent;
use Symfony\Component\Messenger\Worker;
use Symfony\Component\Messenger\WorkerMetadata;

class WorkerConsumerListenerTest extends TestCase
{
    public function testOnRunningEvent(): void
    {
        $logger = $this->createMock(LoggerInterface::class);

        $logger->expects($this->once())->method('log')->with('info', 'Consumer running', [
            'consumer_name' => 'test',
        ]);

        $worker = $this->createMock(Worker::class);

        $metadata = new WorkerMetadata([
            'queueNames' => [__METHOD__],
            'transportNames' => ['test'],
        ]);

        $worker->expects($this->once())->method('getMetadata')->willReturn($metadata);

        $runningEvent = new WorkerRunningEvent($worker, true);

        $workerListener = new WorkerConsumerListener($logger);
        $workerListener->onRunningEvent($runningEvent);
    }

    public function testOnStartedEvent(): void
    {
        $logger = $this->createMock(LoggerInterface::class);

        $logger->expects($this->once())->method('log')->with('info', 'Consumer started', [
            'consumer_name' => 'test',
        ]);

        $worker = $this->createMock(Worker::class);

        $metadata = new WorkerMetadata([
            'queueNames' => [__METHOD__],
            'transportNames' => ['test'],
        ]);

        $worker->expects($this->once())->method('getMetadata')->willReturn($metadata);

        $startedEvent = new WorkerStartedEvent($worker);

        $workerListener = new WorkerConsumerListener($logger);
        $workerListener->onStartedEvent($startedEvent);
    }

    public function testOnStoppedEvent(): void
    {
        $logger = $this->createMock(LoggerInterface::class);

        $logger->expects($this->once())->method('log')->with('info', 'Consumer stopped', [
            'consumer_name' => 'test',
        ]);

        $worker = $this->createMock(Worker::class);

        $metadata = new WorkerMetadata([
            'queueNames' => [__METHOD__],
            'transportNames' => ['test'],
        ]);

        $worker->expects($this->once())->method('getMetadata')->willReturn($metadata);

        $stoppedEvent = new WorkerStoppedEvent($worker);

        $workerListener = new WorkerConsumerListener($logger);
        $workerListener->onStoppedEvent($stoppedEvent);
    }
}
