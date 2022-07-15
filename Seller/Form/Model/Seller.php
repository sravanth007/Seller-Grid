<?php


namespace Seller\Form\Model;


use Magento\Framework\Model\AbstractModel;
use Seller\Form\Model\ResourceModel\Seller as SellerResourceModel;

class Seller  extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(SellerResourceModel::class);
    }
}

