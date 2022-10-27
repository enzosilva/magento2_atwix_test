<?php
/**
 * @author Enzo Silva <enzovaughan@gmail.com>
 * @link   https://github.com/enzosilva
 */

declare(strict_types=1);

namespace Atwix\Customer\Logger;

use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

/**
 * Handler to customer registration logger
 */
class Handler extends Base
{
    /**
     * @inheritdoc
     */
    protected $loggerType = Logger::INFO;

    /**
     * @inheritdoc
     */
    protected $fileName;

    /**
     * @inheritdoc
     */
    public function __construct(
        DriverInterface $filesystem,
        ?string $filePath = null
    ) {
        $currentDate = date("Y-m-d");
        $this->fileName = "/var/log/atwix-customer-registration_{$currentDate}.log";
        parent::__construct($filesystem, $filePath);
    }
}
