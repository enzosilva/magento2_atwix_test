<?php
/**
 * @author Enzo Silva <enzovaughan@gmail.com>
 * @link   https://github.com/enzosilva
 */

declare(strict_types=1);

namespace Atwix\Customer\Plugin\Magento\Customer\Api;

use Magento\Customer\Api\AccountManagementInterface as Subject;
use Magento\Customer\Api\Data\CustomerInterface;
use Atwix\Customer\Model\Config;
use Atwix\Customer\Model\Logger\CustomerRegistration;
use Atwix\Customer\Helper\Email as EmailHelper;

class AccountManagementInterface
{
	/**
     * @var Config
     */
    private Config $atwixCustomerConfig;

    /**
     * @var CustomerRegistration
     */
    private CustomerRegistration $customerRegistrationLogger;

    /**
     * @var EmailHelper
     */
    private EmailHelper $emailHelper;

    /**
     * @param Config $atwixCustomerConfig
     * @param CustomerRegistration $customerRegistrationLogger
     * @param EmailHelper $emailHelper
     */
    public function __construct(
    	Config $atwixCustomerConfig,
    	CustomerRegistration $customerRegistrationLogger,
    	EmailHelper $emailHelper
    ) {
        $this->atwixCustomerConfig = $atwixCustomerConfig;
        $this->customerRegistrationLogger = $customerRegistrationLogger;
        $this->emailHelper = $emailHelper;
    }

    /**
     * Plugin to log data and send email after customer registration
     * 
     * @param Subject $subject
     * @param CustomerInterface $result
     *
     * @return CustomerInterface
     */
    public function afterCreateAccount(
        Subject $subject,
        CustomerInterface $result
    ): CustomerInterface {
    	if ($this->atwixCustomerConfig->isActiveCustomerLogData()) {
        	$this->customerRegistrationLogger->log($result);
        }

        if ($this->atwixCustomerConfig->isActiveCustomerEmailSending()) {
        	$this->emailHelper->send($result);
        }

        return $result;
    }
}
