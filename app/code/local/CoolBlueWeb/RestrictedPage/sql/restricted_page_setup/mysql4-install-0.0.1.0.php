<?php
$installer = $this;
$installer->startSetup();

$conn = $installer->getConnection();
$table = $installer->getTable('cms_page');
$conn->addColumn($table, 'is_restricted', 'int(11)');
$conn->addColumn($table, 'restriction_password', 'varchar(100)');

$installer->endSetup();