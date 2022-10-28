<?php
/**
 * @author Enzo Silva <enzovaughan@gmail.com>
 * @link   https://github.com/enzosilva
 */

declare(strict_types=1);

namespace Atwix\Customer\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    public const PATH_ATWIX_CUSTOMER_FIRSTNAME_TRIM_IS_ACTIVE = 'atwix/customer/is_active_firstname_trim';

    public const PATH_ATWIX_CUSTOMER_LOG_DATA_IS_ACTIVE = 'atwix/customer/is_active_log_data';

    public const PATH_ATWIX_CUSTOMER_EMAIL_SENDING_IS_ACTIVE = 'atwix/customer/is_active_email_sending';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get 'is_active' customer firstname trim
     *
     * @param string $scopeType
     * @param string|null $storeId
     *
     * @return bool
     */
    public function isActiveCustomerFirstnameTrim(
        string $scopeType = ScopeInterface::SCOPE_STORE,
        ?string $storeId = null
    ): bool {
        return $this->getScopeConfigFlag(self::PATH_ATWIX_CUSTOMER_FIRSTNAME_TRIM_IS_ACTIVE);
    }

    /**
     * Get 'is_active' customer log data
     *
     * @param string $scopeType
     * @param string|null $storeId
     *
     * @return bool
     */
    public function isActiveCustomerLogData(
        string $scopeType = ScopeInterface::SCOPE_STORE,
        ?string $storeId = null
    ): bool {
        return $this->getScopeConfigFlag(self::PATH_ATWIX_CUSTOMER_LOG_DATA_IS_ACTIVE);
    }

    /**
     * Get 'is_active' customer email sending
     *
     * @param string $scopeType
     * @param string|null $storeId
     *
     * @return bool
     */
    public function isActiveCustomerEmailSending(
        string $scopeType = ScopeInterface::SCOPE_STORE,
        ?string $storeId = null
    ): bool {
        return $this->getScopeConfigFlag(self::PATH_ATWIX_CUSTOMER_EMAIL_SENDING_IS_ACTIVE);
    }

    /**
     * Get scope config set flag
     * 
     * @param string $path
     * @param string $scopeType
     * @param string|null $storeId
     *
     * @return bool
     */
    private function getScopeConfigFlag(
        string $path,
        string $scopeType = ScopeInterface::SCOPE_STORE,
        ?string $storeId = null
    ): bool {
        return $this->scopeConfig->isSetFlag(
            $path,
            $scopeType,
            $storeId
        );
    }
}
