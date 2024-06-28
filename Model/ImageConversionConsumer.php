<?php

namespace BroCode\ImageQueueOptimizer\Model;

use BroCode\ImageOptimizer\Model\ImageConverterService;
use BroCode\ImageQueueOptimizer\Api\Data\ImageConversionMessageInterface;
use Psr\Log\LoggerInterface;

class ImageConversionConsumer
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var ImageConverterService
     */
    private $imageConverterService;

    public function __construct(
        LoggerInterface $logger,
        ImageConverterService $imageConverterService
    ) {
        $this->logger = $logger;
        $this->imageConverterService = $imageConverterService;
    }

    public function processConversion(ImageConversionMessageInterface $imageConversionMessage)
    {
        $this->logger->debug('got image to convert: ' . $imageConversionMessage->getImagePath() . ' with converter id: ' . $imageConversionMessage->getConverterId());
        $converter = $this->imageConverterService->getImageConverter($imageConversionMessage->getConverterId());
        if ($converter == null) {
            $this->logger->critical('BroCode - ImageOptimizer: Converter ' . $imageConversionMessage->getConverterId() . ' not configured.');
            return;
        }
        $converter->convert($imageConversionMessage->getImagePath());
    }
}
