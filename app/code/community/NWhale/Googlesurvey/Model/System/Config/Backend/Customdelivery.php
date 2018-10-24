<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

class NWhale_Googlesurvey_Model_System_Config_Backend_Customdelivery extends Mage_Core_Model_Config_Data
{
    const SHIPPING_METHOD = 'shipping_method';
    const COUNTRY = 'country';
    const DELIVERY_WEEKENDS = 'delivery_weekends';
    const DELIVERY_TIME = 'delivery_time';

    protected function _afterLoad()
    {
        $value = $this->getValue();
        $value = Mage::helper('nwhale_google_reviews/customdelivery')->makeArrayFieldValue($value);
        $this->setValue($value);
    }

    protected function _beforeSave()
    {
        $value = $this->getValue();
        $value = Mage::helper('nwhale_google_reviews/customdelivery')->makeStorableArrayFieldValue($value);
        $this->setValue($value);
    }
}
