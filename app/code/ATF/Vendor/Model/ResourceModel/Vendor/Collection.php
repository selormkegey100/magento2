<?php

namespace ATF\Vendor\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    public function _construct()
    {
        $this->_init('ATF\Vendor\Model\Vendor', 'ATF\Vendor\Model\ResourceModel\Vendor');
    }

}


?>