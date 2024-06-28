<?php

namespace BroCode\ImageQueueOptimizer\Model\Data;

use BroCode\ImageQueueOptimizer\Api\Data\ImageConversionMessageInterface;
use Magento\Framework\DataObject;

class ImageConversionMessage extends DataObject implements ImageConversionMessageInterface
{

    /**
     * @inheritDoc
     */
    public function getImagePath()
    {
        return $this->getData(self::FIELD_IMAGE_PATH);
    }

    /**
     * @inheritDoc
     */
    public function setImagePath($imagePath)
    {
        return $this->setData(self::FIELD_IMAGE_PATH, $imagePath);
    }

    public function getConverterId()
    {
        return $this->getData(self::FIELD_CONVERTER_ID);
    }

    public function setConverterId($converterId)
    {
        return $this->setData(self::FIELD_CONVERTER_ID, $converterId);
    }
}
