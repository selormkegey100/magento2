<?php
declare(strict_types=1);

namespace ATF\ExchangeRate\Block;

class ExchangeRate extends \Magento\Framework\View\Element\Template
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
    public function displayRate()
    {

	$link = 'http://api.exchangeratesapi.io/v1/2013-03-16?access_key=309002212bc47919840654ebf9ae814a&symbols=USD,AUD,CAD,PLN,MXN&format=1';

        $data = json_decode(file_get_contents($link), true);	
        
        $rates_usd = $data['rates']['USD'];

        $msg = "The rate of 1 Eur to USD is $$rates_usd";
        
        return $msg;
    }
}

