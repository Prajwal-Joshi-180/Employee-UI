<?php

namespace Codilar\HelloWorld\Block;

use Magento\Framework\View\Element\Template;


class HelloWorld extends Template
{
    public function getTitle()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $productBlock = $objectManager->create('\Magento\Catalog\Block\Product\View\AbstractView');
        $product = $productBlock->getProduct();
        $value =$product->getResource()->getAttribute('brand')->getFrontend()->getValue($product);
        return $value;
    }
    public function getquantity(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $StockState = $objectManager->get('\Magento\InventorySalesAdminUi\Model\GetSalableQuantityDataBySku');
        $productBlock = $objectManager->create('\Magento\Catalog\Block\Product\View\AbstractView');
        $product = $productBlock->getProduct();
        $qty = $StockState->execute($product->getSku());
        return ($qty[0]['qty']);
    }
}