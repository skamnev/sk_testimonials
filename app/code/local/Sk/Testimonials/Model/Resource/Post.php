<?php

class Sk_Testimonials_Model_Resource_Post extends Mage_Eav_Model_Entity_Abstract {

    /**
     * Resource initialization
     */
    public function __construct() {
        $resource = Mage::getSingleton('core/resource');
        $this->setType('sk_testimonials_post');
        $this->setConnection(
                $resource->getConnection('testimonials_read'), $resource->getConnection('testimonials_write')
        );
    }

    protected function _updateAttribute($object, $attribute, $valueId, $value) {

        $table = $attribute->getBackend()->getTable();
        if (!isset($this->_attributeValuesToSave[$table])) {
            $this->_attributeValuesToSave[$table] = array();
        }

        $entityIdField = $attribute->getBackend()->getEntityIdField();

        $data = array(
            'entity_type_id' => $object->getEntityTypeId(),
            $entityIdField => $object->getId(),
            'attribute_id' => $attribute->getId(),
            'value' => $this->_prepareValueForSave($value, $attribute)
        );
        if ($valueId) {
            $data['value_id'] = $valueId;
        }

        $this->_attributeValuesToSave[$table][] = $data;

        return $this;
    }

    /*
     * Set default attributes
     */

    protected function _getDefaultAttributes() {
        return array(
            'entity_type_id',
            'attribute_set_id',
            'created_at',
            'updated_at',
            'increment_id',
            'store_id',
            'website_id'
        );
    }

}
