<?php


namespace Mdg\Catalog\Plugin;


use Mdg\Catalog\Model\Price;

class Product
{
    private $price;

    public function __construct(Price $price)
    {
        $this->price = $price;
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result + $this->price->getPriceIncrease();
    }
}