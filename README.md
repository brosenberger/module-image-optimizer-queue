# Image Optimizer Queue - a Magento 2 queue configuration for image optimizations

This module provides a queue configuration for asynchronous image conversions in Magento 2. It is based on the [brocode/module-image-optimizer](https://github.com/brosenberger/module-image-optimizer)

**Goals of this module:**
* Use of Magento 2 basic MySQL queue framework to 
  * publish image files that need to be converted
  * consume image conversion message and asynchronously convert them to the target format


[!["Buy Me A Coffee"](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png)](https://www.buymeacoffee.com/brosenberger)

## Installation

```
composer require brocode/module-image-optimizer-queue
bin/magento module:enable BroCode_ImageQueueOptimizer
bin/magento setup:upgrade
```

## Configuration

Basically nothing has to be configured and should run out of the box. 

Any image needed to be converted is scanned with a cron job from the base module and published to the configured queue instead of a direct conversion.

To consume any conversion event published, you can manually start the queue consumer via the Magento CLI:

```
bin/magento queue:consumers:start BroCodeImageConversionConsumer
```

Consider using supervisor or any other process manager to keep the consumer running.

**Define multiprocess consumer**
Every consumer queue can be locked in Magento 2, to enable multiple conversion processes, following snippet can be added to the env.php to execute 5 conversion consumer parallel on every cron execution:

```php
    'cron_consumers_runner' => [
        'consumers' => [
            'BroCodeImageConversionConsumer'
        ],
        'multiple_processes' => [
            'BroCodeImageConversionConsumer' => 5
        ]
    ],
```