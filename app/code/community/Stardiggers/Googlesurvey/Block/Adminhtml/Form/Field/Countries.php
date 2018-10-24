<?php
/**
 * @author Stardiggers Team
 * @author Evgeni Obukhovsky <eobuhovsky@gmail.com>
 * @copyright Copyright (c) 2017 Stardiggers (https://www.stardiggers.com)
 * @package Stardiggers_Googlesurvey
 */

class Stardiggers_Googlesurvey_Block_Adminhtml_Form_Field_Countries extends Mage_Core_Block_Html_Select
{
    /** @var array */
    protected $_countries;

    protected function getCountries()
    {
        if (null === $this->_countries) {
            $this->_countries = array(0 => Mage::helper('starsurvey')->__('Please Select'));
            $countries = Mage::getResourceModel('directory/country_collection')->loadData()->toOptionArray(false);
            foreach ($countries as $country) {
                $this->_countries[$country['value']] = $country['label'];
            }
        }

        return $this->_countries;
    }

    public function setInputName($value)
    {
        return $this->setName($value);
    }

    public function _toHtml()
    {
        if (!$this->getOptions()) {
            foreach ($this->getCountries() as $value => $title) {
                $this->addOption($value, $title);
            }
        }

        return parent::_toHtml();
    }
}
