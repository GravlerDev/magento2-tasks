<?php


namespace Mdg\Catalog\Observer;


use Magento\Framework\App\ObjectManager;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ProductUpdated implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        if (empty($product->getOrigData('sku'))) {
            return;
        }

        $objectManager = ObjectManager::getInstance();
        $productFactory = $objectManager->create('\Magento\Catalog\Model\ProductFactory');

        $newProduct = $productFactory->create();
        $newProduct->load($product->getId());

        $newName = str_starts_with($product->getOrigData('name'), 'NEW ')
            ? substr($product->getOrigData('name'), 4)
            : $product->getOrigData('name');

        if(!str_starts_with($product->getOrigData('name'), 'EDITED ')) {
            $newProduct->setName('EDITED ' . $newName);
        }
        $newProduct->save();
    }
}