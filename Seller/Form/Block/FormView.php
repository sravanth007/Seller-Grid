<?php

namespace Seller\Form\Block;

//use Selelr\Form\Model\ResourceModel\Country\Collection;

class  FormView extends \Magento\Framework\View\Element\Template
{
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
       }

    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getFormAction()
    {

        return '/seller/FormData/Create';

    }
}
