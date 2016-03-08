<?php
class Sk_Testimonials_Block_Testimonials_View extends Mage_Core_Block_Template {
    var $limit = 5;
    var $page = 1;
    
    protected function _construct()
    {
        if ($limit = $this->getRequest()->getParam('limit') ) {
            $this->_limit = $limit;
        }
        
        if ($page = $this->getRequest()->getParam('p') ) {
            $this->_page = $page;
        }
    }
    
    protected function _prepareLayout() {
        parent::_prepareLayout();

        $collection = $this->getTestimonialsCollection();
        
        $pager = $this->getLayout()->createBlock('page/html_pager', 'testimonials.pager');
        $pager->setAvailableLimit(array(5=>5, 15=>15, 50=>50));
        $pager->setCollection($collection);

        $this->setChild('pager', $pager);
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    
    public function getTestimonialsCollection() {
        $collection = Mage::getModel('sk_testimonials/post')->getCollection()
                ->addAttributeToSelect('comment')
                ->addAttributeToSelect('user_id');
        
        $collection->setPageSize($this->_limit)
            ->setCurPage($this->_page);
        
        $collection->addFieldToFilter('status',1);
        
        //Calculate Offset  
        $offset = ($this->_page - 1) * $this->_limit;
        
        $collection->getSelect()->limit($this->_limit,$offset);
        
        return $collection;
    }
}
