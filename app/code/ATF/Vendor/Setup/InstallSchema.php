<?php

namespace ATF\Vendor\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
		$installer = $setup;
		$installer->startSetup();

		
		$table = $installer->getConnection()->newTable(
			$installer->getTable('atf_vendor')
		)->addColumn(
			'vendor_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Vendor ID'
		)->addColumn(
			'name',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Name'
		)->setComment(
            'ATF Vendor Table'
        );



        $table2 = $installer->getConnection()->newTable(
			$installer->getTable('atf_vendor2product')
		)->addColumn(
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Entity ID'
        )
        ->addColumn(
            'vendor_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false, 'primary' => true, 'default' => '0'],
            'Vendor ID'
        )
        ->addColumn(
            'product_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false, 'primary' => true, 'default' => '0'],
            'Product ID'
        )
        ->addIndex(
            $installer->getIdxName('vendor_product', ['product_id']),
            ['product_id']
        )
        ->addIndex(
            $installer->getIdxName(
                'vendor_product',
                ['vendor_id', 'product_id'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['vendor_id', 'product_id'],
            ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
        )
        ->addForeignKey(
            $installer->getFkName('vendor_product', 'product_id', 'catalog_product_entity', 'entity_id'),
            'product_id',
            $installer->getTable('catalog_product_entity'),
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )
        ->addForeignKey(
            $installer->getFkName('vendor_product', 'vendor_id', 'vendor', 'vendor_id'),
            'vendor_id',
            $installer->getTable('vendor'),
            'vendor_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )
        ->setComment('Vendor to Product Many to Many');


        $installer->getConnection()->createTable($table);
	$installer->getConnection()->createTable($table2);


		$installer->endSetup();
	}
}