<?php

namespace ATF\OrderController\Controller\Path;

class Action extends \Magento\Framework\App\Action\Action 
{
	
    protected $_context;
    protected $_pageFactory;
    protected $_jsonEncoder;
    protected $_orderHelper;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Json\EncoderInterface $encoder,
        \ATF\OrderController\Helper\OrderData $orderHelper,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->_context = $context;
        $this->_pageFactory = $pageFactory;
        $this->_orderHelper = $orderHelper; 
		$this->_jsonEncoder = $encoder;        
        parent::__construct($context);
    }
    
	
    public function execute() 
    {    	
    	$oid = $this->getRequest()->getParam('oid');
        $orderData = ['response'=>null];
        if ($oid) {
            $orderData['response'] = $this->_orderHelper->getOrderInfo($oid);
        } else {
            $orderData = array('error' => 'This order does not exist');
        }

        $this->getResponse()->representJson($this->_jsonEncoder->encode($orderData));
    	return;
    }
}