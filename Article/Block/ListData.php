<?php

namespace Smartosc\Article\Block;

use Magento\Framework\View\Element\Template\Context;
use Smartosc\Article\Helper\Config;
use Smartosc\Article\Model\ArticleFactory;

/**
 * Test List block
 */
class ListData extends \Magento\Framework\View\Element\Template
{
    /**
     * @var ArticleFactory
     */
    private $_test;
    public $_helper;

    public function __construct(
        Context $context,
        ArticleFactory $test,
        Config $helper
    ) {
        $this->_test = $test;
        $this->_helper=$helper;
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
                ->setAvailableLimit([
                    $this->_helper->getArticleConfig() => $this->_helper->getArticleConfig(),
                    $this->_helper->getArticleConfig()*2 => $this->_helper->getArticleConfig()*2,
                    $this->_helper->getArticleConfig()*3 => $this->_helper->getArticleConfig()*3
                ])
                ->setShowPerPage(true)
                ->setCollection($this->getTestCollection());

            $this->setChild('pager', $pager);
            $this->getTestCollection()->load();
        }
    }

    public function getTestCollection()
    {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : $this->_helper->getArticleConfig();

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
