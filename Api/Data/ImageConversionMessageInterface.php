<?php

namespace BroCode\ImageQueueOptimizer\Api\Data;

interface ImageConversionMessageInterface
{
    const FIELD_IMAGE_PATH = 'image_path';
    const FIELD_CONVERTER_ID = 'converter_id';
    /**
     * @return string
     */
    public function getImagePath();

    /**
     * @param string $imagePath
     * @return \BroCode\ImageOptimizer\Api\Data\ImageConversionMessageInterface
     */
    public function setImagePath($imagePath);

    /**
     * @return string
     */
    public function getConverterId();

    /**
     * @param $converterId
     * @return \BroCode\ImageOptimizer\Api\Data\ImageConversionMessageInterface
     */
    public function setConverterId($converterId);
}
