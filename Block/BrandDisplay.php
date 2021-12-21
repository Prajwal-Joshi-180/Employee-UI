<?php
namespace Codilar\HelloWorld\Block;
class BrandDisplay extends \Magento\Framework\View\Element\Template
{    
    protected $_productCollectionFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,        
        array $data = []
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;    
        parent::__construct($context, $data);
    }

    public function getProductCollection()
    {
        $storeid = 1; 
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addStoreFilter($storeid);
        $brandcollection=[];
        foreach($collection as $coll){
            array_push($brandcollection,$coll->getAttributeText('brand'));
        }      
        return $brandcollection;
    }
}
?> 