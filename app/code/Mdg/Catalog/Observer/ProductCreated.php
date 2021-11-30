<?php


namespace Mdg\Catalog\Observer;


use Magento\Framework\App\ObjectManager;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ProductCreated implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        if (!empty($product->getOrigData('sku'))) {
            return;
        }

        $objectManager = ObjectManager::getInstance();
        $productFactory = $objectManager->create('\Magento\Catalog\Model\ProductFactory');

        $newProduct = $productFactory->create();
        $newProduct->load($product->getId());
        $newProduct->setName('NEW ' . $newProduct->getName());
        $newProduct->save();
    }
}