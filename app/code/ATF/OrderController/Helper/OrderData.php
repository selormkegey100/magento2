<?php

namespace ATF\OrderController\Helper;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class OrderData extends \Magento\Framework\App\Helper\AbstractHelper 
{

    protected $_orderRepositoryInterface;
    protected $_searchCriteriaBuilder;

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
    	\Magento\Sales\Api\OrderRepositoryInterface $orderRepositoryInterface,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\App\Helper\Context $context
    ) 
    {
        $this->_orderRepositoryInterface = $orderRepositoryInterface;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context);
    }

    public function getOrderInfo($orderId) 
    {

        $this->_searchCriteriaBuilder->addFilter('increment_id', $orderId);
        $orders = $this->_orderRepositoryInterface->getList(
            $this->_searchCriteriaBuilder->create()
        )->getItems();
        if (count($orders)) {
            $order = reset($orders);
	    
	    $status = $order->getState();
            $total = $order->getGrandTotal();
	    $invoiced = $order->getInvoiceCollection();

	    $items = $order->getAllItems();

	    foreach($items as $item) {
	    	 
	     	$item_sku = $item->getSku();
                $item_id = $item->getId();
                $item_price = $item->getPrice();
                
		$item_array = array('item_sku'=>$item_sku, 'item_id'=>$item_id, 'item_price'=>$item_price);

            }

	    $data = array('order_status'=>$status, 'order_total'=>$total, 'order_invoiced'=>$invoiced);
            $data['items'] = $item_array;  
            $data = json_encode($data);
            
        }
        return $data;
    }
}