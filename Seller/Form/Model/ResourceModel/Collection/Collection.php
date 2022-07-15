<?php


namespace Seller\Form\Model\ResourceModel\Collection;


use Seller\Form\Model\Seller as SellerModel;
use Seller\Form\Model\ResourceModel\Seller as SellerResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(SellerModel::class, SellerResourceModel::class);
    }
}

