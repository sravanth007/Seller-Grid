<?php
declare(strict_types=1);

namespace Seller\Form\Block\Adminhtml\SellerForm\Edit;

use Magento\Backend\Block\Widget\Context;

abstract class GenericButton
{

    protected $context;

   
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * Return model ID
     *
     * @return int|null
     */
    public function getModelId()
    {
        return $this->context->getRequest()->getParam('id');
    }

    
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
