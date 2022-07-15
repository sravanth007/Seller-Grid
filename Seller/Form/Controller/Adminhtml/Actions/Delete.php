<?php
declare(strict_types=1);
namespace Seller\Form\Controller\Adminhtml\Actions;
class Delete extends \Seller\Form\Controller\Adminhtml\Actions
{
    
    public function execute()
    {
        
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Seller\Form\Model\Seller::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Customform.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Customform to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
