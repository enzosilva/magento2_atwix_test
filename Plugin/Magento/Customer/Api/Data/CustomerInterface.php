<?php
/**
 * @author Enzo Silva <enzovaughan@gmail.com>
 * @link   https://github.com/enzosilva
 */

 declare(strict_types=1);

namespace Atwix\Customer\Plugin\Magento\Customer\Api\Data;

use Magento\Customer\Api\Data\CustomerInterface as Subject;
use Atwix\Customer\Model\Config;

class CustomerInterface
{
	/**
     * @var Config
     */
    private Config $atwixCustomerConfig;

    /**
     * @param Config $atwixCustomerConfig
     */
    public function __construct(Config $atwixCustomerConfig)
    {
        $this->atwixCustomerConfig = $atwixCustomerConfig;
    }

    /**
     * Plugin to remove whitespaces in customer firstname
     * 
     * @param Subject $subject
     * @param string $firstname
     *
     * @return array
     */
    public function beforeSetFirstname(
        Subject $subject,
        string $firstname
    ): array {
    	if ($this->atwixCustomerConfig->isActiveCustomerFirstnameTrim()) {
        	return [trim($firstname)];
        }

        return [$firstname];
    }
}
