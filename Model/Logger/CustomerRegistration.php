<?php
/**
 * @author Enzo Silva <enzovaughan@gmail.com>
 * @link   https://github.com/enzosilva
 */

declare(strict_types=1);

namespace Atwix\Customer\Model\Logger;

use Atwix\Customer\Logger\CustomerRegistrationLogger;
use Magento\Customer\Api\Data\CustomerInterface;

/**
 * Customer registration log data logger
 */
class CustomerRegistration
{
    /**
     * @var CustomerRegistrationLogger
     */
    private CustomerRegistrationLogger $customerRegistrationLogger;

    /**
     * @param CustomerRegistrationLogger $customerRegistrationLogger
     */
    public function __construct(CustomerRegistrationLogger $customerRegistrationLogger)
    {
        $this->customerRegistrationLogger = $customerRegistrationLogger;
    }

    /**
     * Add custom log
     *
     * @param CustomerInterface $customer
     */
    public function log(CustomerInterface $customer): void
    {
        $this->customerRegistrationLogger->info(
            sprintf(
                "\n*** Customer Information ***\nFirstname: %s\nLastname: %s\nEmail: %s",
                $customer->getFirstname(),
                $customer->getLastname(),
                $customer->getEmail()
            )
        );
    }

    /**
     * Add custom error log
     *
     * @param CustomerInterface $customer
     */
    public function logError(string $message): void
    {
        $this->customerRegistrationLogger->error($message);
    }
}
