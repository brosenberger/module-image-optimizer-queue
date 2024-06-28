<?php

namespace BroCode\ImageQueueOptimizer\Observer;

use BroCode\ImageQueueOptimizer\Api\Constants;
use BroCode\ImageQueueOptimizer\Api\Data\ImageConversionMessageInterface;
use BroCode\ImageQueueOptimizer\Api\Data\ImageConversionMessageInterfaceFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use Psr\Log\LoggerInterface;

class QueueConvertImageObserver implements ObserverInterface
{
    /**
     * @var PublisherInterface
     */
    private $publisher;
    private ImageConversionMessageInterfaceFactory $imageConversionMessageFactory;
    private LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        PublisherInterface $publisher,
        ImageConversionMessageInterfaceFactory $imageConversionMessageFactory
    ) {
        $this->publisher = $publisher;
        $this->imageConversionMessageFactory = $imageConversionMessageFactory;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        /** @var ImageConversionMessageInterface $message */
        $message = $this->imageConversionMessageFactory->create();
        $message->setConverterId($observer->getConverterId())
            ->setImagePath($observer->getImagePath());

        $this->publisher->publish(Constants::TOPIC_NAME, $message);
    }
}
