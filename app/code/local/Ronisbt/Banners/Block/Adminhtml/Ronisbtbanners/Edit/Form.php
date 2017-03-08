<?php

class Ronisbt_Banners_Block_Adminhtml_Ronisbtbanners_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    
    public function __construct()
    {
        parent::__construct();
        $this->setId('banner_form');
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('ronisbtbanners_banner');
        $list = Mage::helper('ronisbtbanners/data')->PositionList();
        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save',array('banner_id'=>$this->getRequest()->getParam('banner_id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            )
        );

        $form->setHtmlIdPrefix('banner_');

        $fieldset = $form->addFieldset('base_fieldset',
            array(
                'legend'=>Mage::helper('ronisbtbanners')->__('General Information'),
                'class' => 'fieldset-wide')
        );

        if ($model->getBannerId()) {
            $fieldset->addField('banner_id', 'hidden', array(
                'name' => 'banner_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('ronisbtbanners')->__('Block Title'),
            'title'     => Mage::helper('ronisbtbanners')->__('Block Title'),
            'required'  => true,
        ));


        $fieldset->addField('banner_status', 'select', array(
            'label'     => Mage::helper('ronisbtbanners')->__('Status'),
            'title'     => Mage::helper('ronisbtbanners')->__('Status'),
            'name'      => 'banner_status',
            'required'  => true,
            'options'   => Mage::getModel('ronisbtbanners/source_status')->toArray(),
        ));

        $fieldset->addField('url', 'text', array(
            'label'     => 'URL',
            'title'     => 'URL',
            'name'      => 'url',
            'required'  => true,
        ));

        $fieldset->addField('position', 'select', array(
            'label'     => Mage::helper('ronisbtbanners')->__('Position'),
            'title'     => Mage::helper('ronisbtbanners')->__('Position'),
            'name'      => 'position',
            'required'  => 'true',
            'options'   => $list,
        ));
        $fieldset->addType('myimage','Ronisbt_Banners_Block_Adminhtml_Ronisbtbanners_Edit_Renderer_Myimage');
        $fieldset->addField('image', 'myimage', array(
            'label'     => Mage::helper('ronisbtbanners')->__('Banner image'),
            'title'     => Mage::helper('ronisbtbanners')->__('Banner image'),
            'name'      => 'image',
            'required'  => true
        ));

        $fieldset->addField('content', 'textarea', array(
            'name'      => 'content',
            'label'     => Mage::helper('ronisbtbanners')->__('Content'),
            'title'     => Mage::helper('ronisbtbanners')->__('Content'),
            'style'     => 'height:36em',
            'required'  => true,

        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}