<?php
/**
 * @author Stardiggers Team
 * @author Evgeni Obukhovsky <eobuhovsky@gmail.com>
 * @copyright Copyright (c) 2017 Stardiggers (https://www.stardiggers.com)
 * @package Stardiggers_Googlesurvey
 */

class Stardiggers_Googlesurvey_Block_Adminhtml_Form_Field_Carriers extends Mage_Core_Block_Html_Select
{
    /** @var array */
    protected $_carriers;

    protected function getCarriers()
    {
        if (null === $this->_carriers) {
            $this->_carriers = array(
                0 => Mage::helper('starsurvey')->__('Please Select'),
                Stardiggers_Googlesurvey_Helper_Customdelivery::ANY_METHOD
                    => Mage::helper('starsurvey')->__('Any Method')
            );
            $carriers = Mage::getSingleton('shipping/config')->getActiveCarriers();
            foreach ($carriers as $carrierCode => $carrier) {
                if ($methods = $carrier->getAllowedMethods()) {
                    if (!$carrierTitle = Mage::getStoreConfig("carriers/$carrierCode/title"))
                        $carrierTitle = $carrierCode;
                    foreach ($methods as $methodCode => $methodTitle) {
                        $value = $carrierCode . '_' . $methodCode;
                        $this->_carriers[$value] = $carrierTitle . ' || ' . $methodTitle;
                    }
                }
            }
        }

        return $this->_carriers;
    }

    public function setInputName($value)
    {
        return $this->setName($value);
    }

    public function _toHtml()
    {
        if (!$this->getOptions()) {
            foreach ($this->getCarriers() as $value => $title) {
                $this->addOption($value, $title);
            }
        }

        return parent::_toHtml();
    }
}
