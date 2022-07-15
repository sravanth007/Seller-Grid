<?php
declare(strict_types=1);

namespace Seller\Form\Controller\Adminhtml\Actions;

class Edit extends \Seller\Form\Controller\Adminhtml\Actions
{

    protected $resultPageFactory;

   
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\Seller\Form\Model\Seller::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Sellerfrorm no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('seller_form', $model);

        
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Customform') : __('New Sellerform'),
            $id ? __('Edit Customform') : __('New Sellerform')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Sellerforms'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Sellerform %1', $model->getId()) : __('New Customform'));
        return $resultPage;
    }
}
