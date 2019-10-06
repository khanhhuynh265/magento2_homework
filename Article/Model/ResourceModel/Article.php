<?php
namespace Smartosc\Article\Model\ResourceModel;
class Article extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('sm_article', 'id');
    }
}