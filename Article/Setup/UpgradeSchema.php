<?php

namespace Smartosc\Article\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('sm_article'),
                'updated_at',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    'length' => null,
                    ['nullable' => false],
                    'comment' => 'Updated_at'
                ]
            );
        }

        $installer->endSetup();
    }
}