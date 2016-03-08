<?php

$installer = $this;
$installer->startSetup();

/*
 * Create all entity tables
 */
$installer->createEntityTables(
    $this->getTable('sk_testimonials/post_entity')
);

/*
 * Add Entity type
 */
$installer->addEntityType('sk_testimonials_post',Array(
    'entity_model'          =>'sk_testimonials/post',
    'attribute_model'       =>'',
    'table'                 =>'sk_testimonials/post_entity',
    'increment_model'       =>'',
    'increment_per_store'   =>'0'
));

$installer->installEntities();

$installer->endSetup();