<?php
declare(strict_types=1);

namespace Seller\Form\Controller\Adminhtml\Actions;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

   
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');

            $model = $this->_objectManager->create(\Seller\Form\Model\Seller::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Customform no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            /*	if (isset($data['image'][0]['name']) && isset($data['image'][0]['tmp_name'])) {
                    $data['image'] =$data['image'][0]['name'];
                    $this->imageUploader = \Magento\Framework\App\ObjectManager::getInstance()->get(
                    'Magelearn\Customform\CustomformImageUpload'
                );
                    $this->imageUploader->moveFileFromTmp($data['image']);
                } elseif (isset($data['image'][0]['name']) && !isset($data['image'][0]['tmp_name'])) {
                    $data['image'] = $data['image'][0]['name'];
                } else {
                    $data['image'] = null;
                }   */
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Customform.'));
                $this->dataPersistor->clear('seller');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Customform.'));
            }

            $this->dataPersistor->set('seller', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
