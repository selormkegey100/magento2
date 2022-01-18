<?php

namespace ATF\Vendor\Model;

use Magento\Framework\Model\AbstractModel;

class Vendor extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('ATF\Vendor\Model\ResourceModel\Vendor');
    }

}

?>