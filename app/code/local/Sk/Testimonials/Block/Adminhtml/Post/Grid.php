<?php

class Sk_Testimonials_Block_Adminhtml_Post_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('skTestimonialsGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('sk_testimonials/post')->getCollection()
                ->addAttributeToSelect('comment')
                ->addAttributeToSelect('user_id')
                ->addAttributeToSelect('status');

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('entity_id', array(
            'header' => Mage::helper('sk_testimonials')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'entity_id',
        ));

        $this->addColumn('comment', array(
            'header' => Mage::helper('sk_testimonials')->__('Comment'),
            'align' => 'left',
            'index' => 'comment',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('sk_testimonials')->__('Status'),
            'align' => 'left',
            'index' => 'status',
            'renderer' => 'Sk_Testimonials_Block_Adminhtml_Post_Grid_Renderer_Status'
        ));

        $this->addColumn('user_id', array(
            'header' => Mage::helper('sk_testimonials')->__('Author'),
            'align' => 'left',
            'index' => 'user_id',
            'renderer' => 'Sk_Testimonials_Block_Adminhtml_Post_Grid_Renderer_Author'
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('entity_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('sk_testimonials/post')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('sk_testimonials/post')->__('Are you sure?')
        ));

        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
