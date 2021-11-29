<?php


namespace Mdg\Catalog\Model;


use Magento\Framework\Model\AbstractModel;
use Mdg\Catalog\Model\ResourceModel\Price as ResourceModel;

class Price extends AbstractModel
{
    private $scopeConfig;

    public function  __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getPriceIncrease()
    {
        return $this->scopeConfig->getValue('mdg_section/mdg_product/add_to_price',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}