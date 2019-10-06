<?php
namespace Smartosc\Article\Plugin;

use Magento\Quote\Api\Data\CartInterface;
use Magento\Framework\Message\ManagerInterface as MessageManager;

class AddMessage
{
    /**
     * @var MessageManager
     */
    private $messageManager;

    public function __construct(MessageManager $messageManager)
    {
        $this->messageManager = $messageManager;
    }

    public function afterAddProduct(CartInterface $cart, $result)
    {
        $this->messageManager->addNoticeMessage("Mua nữa đi !!!!! ");
        return $result;
    }
}
