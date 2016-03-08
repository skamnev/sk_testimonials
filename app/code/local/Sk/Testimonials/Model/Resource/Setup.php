<?php

class Sk_Testimonials_Model_Resource_Setup extends Mage_Eav_Model_Entity_Setup {
    /*
     * Setup attributes for sk_testimonials_post entity type
     * -this attributes will be saved in db if you set them
     */

    public function getDefaultEntities() {
        $entities = array(
            'sk_testimonials_post' => array(
                'entity_model' => 'sk_testimonials/post',
                'attribute_model' => '',
                'table' => 'sk_testimonials/post_entity',
                'attributes' => array(
                    'comment' => array(
                        'type' => 'text',
                        'backend' => '',
                        'frontend' => '',
                        'label' => 'Comment',
                        'input' => 'textarea',
                        'class' => '',
                        'source' => '',
                        'global' => 0,
                        'visible' => true,
                        'required' => true,
                        'user_defined' => true,
                        'default' => '',
                        'searchable' => false,
                        'filterable' => false,
                        'comparable' => false,
                        'visible_on_front' => true,
                        'unique' => false,
                    ),
                    'status' => array(
                        'type' => 'int',
                        'backend' => '',
                        'frontend' => '',
                        'label' => 'Status',
                        'input' => 'select',
                        'class' => '',
                        'source' => '',
                        'global' => 0,
                        'visible' => true,
                        'required' => true,
                        'user_defined' => true,
                        'default' => '',
                        'searchable' => false,
                        'filterable' => false,
                        'comparable' => false,
                        'visible_on_front' => true,
                        'unique' => true,
                    ),
                    'user_id' => array(
                        'type' => 'int',
                        'backend' => '',
                        'frontend' => '',
                        'label' => 'User Id',
                        'input' => 'text',
                        'class' => '',
                        'source' => '',
                        'global' => 0,
                        'visible' => true,
                        'required' => true,
                        'user_defined' => true,
                        'default' => '',
                        'searchable' => false,
                        'filterable' => false,
                        'comparable' => false,
                        'visible_on_front' => false,
                        'unique' => false,
                    ),
                ),
            )
        );
        return $entities;
    }

}
