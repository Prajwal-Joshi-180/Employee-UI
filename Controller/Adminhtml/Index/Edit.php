<?php

namespace Codilar\HelloWorld\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Codilar\Employee\Model\EmployeeFactory as ModelFactory;
use Codilar\Employee\Model\ResourceModel\Employee as ResourceModel;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;
     /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;


    public function __construct(
        Context $context,
        PageFactory $pageFactory, 
        ModelFactory $modelFactory,
        ResourceModel $resourceModel
    )
    {
        
        $this->pageFactory = $pageFactory;
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
        parent::__construct($context);
    }

    public function execute()
    {
        $page=$this->pageFactory->create();
        $data=$this->getRequest()->getParams();
        $Employee = $this->modelFactory->create();
        $Employee->load($data['entity_id']);
        $page->getConfig()->getTitle()->set('Employee '. $Employee->getName()."'s Details");
        return $page;
    }
}
