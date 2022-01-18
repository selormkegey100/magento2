<?php


namespace ATF\Vendor\Block;


class Vendor extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context
    ) {
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('ATF Vendor Module'));
        
        return parent::_prepareLayout();
    }
}
