<?php
namespace Smartosc\Article\Model\ResourceModel\Article;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Smartosc\Article\Model\Article',
            'Smartosc\Article\Model\ResourceModel\Article'
        );
    }
    public function loadAllArticles()
    {
        return $this->getData();
    }
}