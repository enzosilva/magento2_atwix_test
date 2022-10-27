<?php
/**
 * @author Enzo Silva <enzovaughan@gmail.com>
 * @link   https://github.com/enzosilva
 */

declare(strict_types=1);

namespace Atwix\Customer\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Area;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\ScopeInterface;
use Atwix\Customer\Model\Logger\CustomerRegistration;

class Email extends AbstractHelper
{
    /**
     * @var StateInterface
     */
    protected StateInterface $inlineTranslation;

    /**
     * @var Escaper
     */
    protected Escaper $escaper;

    /**
     * @var TransportBuilder
     */
    protected TransportBuilder $transportBuilder;

    /**
     * @var CustomerRegistration
     */
    protected CustomerRegistration $customerRegistrationLogger;

    /**
     * @param Context $context
     * @param StateInterface $inlineTranslation
     * @param Escaper $escaper
     * @param TransportBuilder $transportBuilder
     * @param CustomerRegistration $customerRegistrationLogger
     */
    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder,
        CustomerRegistration $customerRegistrationLogger
    ) {
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->customerRegistrationLogger = $customerRegistrationLogger;
        parent::__construct($context);
    }

    /**
     * Method to send email using core transport builder
     *
     * @param CustomerInterface $customer
     */
    public function send(CustomerInterface $customer): void
    {
        try {
            $this->inlineTranslation->suspend();

            $senderName = $this->scopeConfig->getValue(
                'trans_email/ident_support/name',
                ScopeInterface::SCOPE_STORE
            );
            $senderEmail = $scopeConfig->getValue(
                'trans_email/ident_support/email',
                ScopeInterface::SCOPE_STORE
            );

            $sender = [
                'name' => $this->escaper->escapeHtml($senderName),
                'email' => $this->escaper->escapeHtml($senderEmail)
            ];

            $transport = $this->transportBuilder
                ->setTemplateIdentifier('atwix_customer_registration')
                ->setTemplateOptions(
                    [
                        'area' => Area::AREA_FRONTEND,
                        'store' => Store::DEFAULT_STORE_ID
                    ]
                )
                ->setTemplateVars([
                    'customerFirstname'  => $customer->getFirstname(),
                    'customerLastname'  => $customer->getLastname(),
                    'customerEmail'  => $customer->getEmail()
                ])
                ->setFrom($sender)
                ->addTo($senderEmail)
                ->getTransport();

            $transport->sendMessage();

            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->customerRegistrationLogger->logError($e->getMessage());
        }
    }
}
