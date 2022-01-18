namespace ATF\Vendor\Model;

use Magento\Framework\Model\AbstractModel;

class VendorProduct extends AbstractModel
{

protected function _construct()
{
    $this->_init('ATF\Vendor\Model\ResourceModel\VendorProduct');
}


public function getVendors($productIds)
{
    return $this->_getResource()->getVendorss($productIds);
}


public function getProducts($vendorIds)
{
    return $this->_getResource()->getProducts($vendorIds);
}
}