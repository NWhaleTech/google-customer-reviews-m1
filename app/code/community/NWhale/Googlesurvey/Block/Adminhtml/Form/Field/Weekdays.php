<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

class NWhale_Googlesurvey_Block_Adminhtml_Form_Field_Weekdays extends Mage_Core_Block_Html_Select
{
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    public function _toHtml()
    {
        if (!$this->getOptions()) {
            foreach (Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray() as $value => $title) {
                $this->addOption($value, $title);
            }
        }

        return parent::_toHtml();
    }
}