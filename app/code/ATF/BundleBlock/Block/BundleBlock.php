<?php
declare(strict_types=1);

namespace ATF\BundleBlock\Block;

class BundleBlock extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function displaymsg()
    {
        
        return __('Hello World again!');
    }
}

