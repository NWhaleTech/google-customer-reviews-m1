<?php
/**
 * @author Stardiggers Team
 * @author Evgeni Obukhovsky <eobuhovsky@gmail.com>
 * @copyright Copyright (c) 2017 Stardiggers (https://www.stardiggers.com)
 * @package Stardiggers_Googlesurvey
 */

class Stardiggers_Googlesurvey_Model_System_Config_Backend_Customdelivery extends Mage_Core_Model_Config_Data
{
    const SHIPPING_METHOD = 'shipping_method';
    const COUNTRY = 'country';
    const DELIVERY_WEEKENDS = 'delivery_weekends';
    const DELIVERY_TIME = 'delivery_time';

    protected function _afterLoad()
    {
        $value = $this->getValue();
        $value = Mage::helper('starsurvey/customdelivery')->makeArrayFieldValue($value);
        $this->setValue($value);
    }

    protected function _beforeSave()
    {
        $value = $this->getValue();
        $value = Mage::helper('starsurvey/customdelivery')->makeStorableArrayFieldValue($value);
        $this->setValue($value);
    }
}
