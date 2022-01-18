<?php
declare(strict_types=1);

namespace ATF\FreeGeoIp\Observer\Frontend\Customer;

class Login implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        echo "Customer Logged In!";

	$ip = $_SERVER['REMOTE_ADDR'];

	$link = "http://api.ipstack.com/$ip?access_key=cddffd00bbaa3fab86ef81dc826220c2&format=1";

	$data = json_decode(file_get_contents($link), true);	
        
	$country = $data['country_name'];

	echo "Your country : $country";
    }
}

