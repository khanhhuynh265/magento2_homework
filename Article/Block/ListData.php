<?php

namespace Smartosc\Article\Block;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template\Context;
use Smartosc\Article\Model\ArticleFactory;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\ScopeInterface;

/**
 * Test List block
 */
class ListData extends \Magento\Framework\View\Element\Template
{
    /**
     * @var ArticleFactory
     */
    private $_test;

    public function __construct(
        Context $context,
        ArticleFactory $test
    ) {
        $this->_test = $test;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Simple Custom Module List Page'));
        parent::_prepareLayout();

        if ($this->getTestCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'smartosc.article'
            )
                ->setAvailableLimit([5=>5,10=>10,15=>15])
                ->setShowPerPage(true)
                ->setCollection($this->getTestCollection());

            $this->setChild('pager', $pager);
            $this->getTestCollection()->load();
        }
    }

    public function getTestCollection()
    {
        $page = ($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 5;

        $test = $this->_test->create();
        $collection = $test->getCollection();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);

        return $collection;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

}