<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

use NWhale_Googlesurvey_Model_System_Config_Backend_Customdelivery as Delivery;

class NWhale_Googlesurvey_Block_Adminhtml_Form_Field_Customdelivery
    extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    /** @var  NWhale_Googlesurvey_Block_Adminhtml_Form_Field_Carriers */
    protected $_carriersRenderer;

    /** @var  NWhale_Googlesurvey_Block_Adminhtml_Form_Field_Countries */
    protected $_countriesRenderer;

    /** @var  NWhale_Googlesurvey_Block_Adminhtml_Form_Field_Weekdays */
    protected $_weekdaysRenderer;

    protected function getCarriersRenderer()
    {
        if (!$this->_carriersRenderer) {
            $this->_carriersRenderer = $this->getLayout()->createBlock(
                'nwhale_google_reviews/adminhtml_form_field_carriers', '',
                array('is_render_to_js_template' => true)
            );
            $this->_carriersRenderer->setClass('carriers_select');
        }

        return $this->_carriersRenderer;
    }

    protected function getCountriesRenderer()
    {
        if (!$this->_countriesRenderer) {
            $this->_countriesRenderer = $this->getLayout()->createBlock(
                'nwhale_google_reviews/adminhtml_form_field_countries', '',
                array('is_render_to_js_template' => true)
            );
            $this->_countriesRenderer->setClass('countries_select');
            $this->_countriesRenderer->setExtraParams('style="width:150px"');
        }

        return $this->_countriesRenderer;
    }

    protected function getWeekdaysRenderer()
    {
        if (!$this->_weekdaysRenderer) {
            $this->_weekdaysRenderer = $this->getLayout()->createBlock(
                'nwhale_google_reviews/adminhtml_form_field_weekdays', '',
                array('is_render_to_js_template' => true)
            );
            $this->_weekdaysRenderer->setClass('weekdays_select');
            $this->_weekdaysRenderer->setExtraParams('style="width:100px"');
        }

        return $this->_weekdaysRenderer;
    }

    protected function _prepareToRender()
    {
        $this->addColumn(
            Delivery::SHIPPING_METHOD, array(
                'label' => Mage::helper('nwhale_google_reviews')->__('Shipping Method'),
            'renderer' => $this->getCarriersRenderer()
            )
        );
        $this->addColumn(
            Delivery::COUNTRY, array(
                'label' => Mage::helper('nwhale_google_reviews')->__('Country'),
            'renderer' => $this->getCountriesRenderer()
            )
        );
        $this->addColumn(
            Delivery::DELIVERY_WEEKENDS, array(
                'label' => Mage::helper('nwhale_google_reviews')->__('Include Weekends'),
            'renderer' => $this->getWeekdaysRenderer()
            )
        );
        $this->addColumn(
            Delivery::DELIVERY_TIME, array(
            'label' => Mage::helper('cataloginventory')->__('Days to Deliver'),
            'style' => 'width:100px',
            )
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('cataloginventory')->__('Add Delivery Time Rule');
    }

    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_'
                . $this->getCarriersRenderer()->calcOptionHash($row->getData(Delivery::SHIPPING_METHOD)),
            'selected="selected"'
        )->setData(
            'option_extra_attr_' . $this->getCountriesRenderer()->calcOptionHash($row->getData(Delivery::COUNTRY)),
            'selected="selected"'
        )->setData(
            'option_extra_attr_'
                . $this->getWeekdaysRenderer()->calcOptionHash($row->getData(Delivery::DELIVERY_WEEKENDS)),
            'selected="selected"'
        );
    }
}