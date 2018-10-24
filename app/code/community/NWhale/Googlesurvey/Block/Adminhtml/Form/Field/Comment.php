<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

class NWhale_Googlesurvey_Block_Adminhtml_Form_Field_Comment extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $html = $element->getElementHtml();
        $html .= '<input id="nwhale_google_reviews_badge_custom_comment" name="groups[badge][fields][custom_comment][value]" 
            value="" class=" input-text" type="hidden">';
        return $html;
    }
}