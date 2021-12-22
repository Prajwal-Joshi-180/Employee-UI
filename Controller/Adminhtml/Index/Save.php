<?php

namespace Codilar\HelloWorld\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Action;
use Codilar\Employee\Model\EmployeeFactory as ModelFactory;
use Codilar\Employee\Model\ResourceModel\Employee as ResourceModel;
use Magento\Framework\App\Action\Context;

class Save extends Action
{
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
        ModelFactory $modelFactory,
        ResourceModel $resourceModel
    )
    {
        parent::__construct($context);
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $emptyEmployee = $this->modelFactory->create();
        if(!empty($data['entity_id'])){
        $this->resourceModel->load($emptyEmployee,$data['entity_id']);
        }
        $emptyEmployee->setName($data['name'] ?? null);
        $emptyEmployee->setEmail($data['email'] ?? null);
        $emptyEmployee->setMobile($data['mobile'] ?? null);
        $emptyEmployee->setDob($data['dob'] ?? null);
        $emptyEmployee->setAddress($data['address'] ?? null);
        $emptyEmployee->setDoj($data['doj'] ?? null);

        try {
            
            $this->resourceModel->save($emptyEmployee);
            $this->messageManager->addSuccessMessage(__('Employee %1 saved successfully', $emptyEmployee->getName()));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__("Error saving Employee"));
        }
        
        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }
}