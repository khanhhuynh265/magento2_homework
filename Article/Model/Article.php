<?php
namespace Smartosc\Article\Model;
use Magento\Framework\Model\AbstractModel;
class Article extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Smartosc\Article\Model\ResourceModel\Article');
    }
}