<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

class NWhale_Googlesurvey_Model_System_Config_Source_Language
{
    public function toOptionArray()
    {
        $allowedLanguages = array(
            "cs", "da", "de", "en_AU", "en_GB", "en_US", "es", "fr",
            "it", "ja", "nl", "no", "pl", "pt_BR", "ru", "sv", "tr");
        $result = array(0 => Mage::helper('nwhale_google_reviews')->__('User Environment Defined'));
        $laguagesList = Mage::app()->getLocale()->getTranslatedOptionLocales();
        foreach ($laguagesList as $language) {
            foreach ($allowedLanguages as $code => $allowed) {
                if (strpos($language['value'], $allowed) === 0) {
                    unset($allowedLanguages[$code]);
                    $label = $language['label'];
                    if (strlen($allowed) == 2) {
                        $label = preg_replace('/(.*?)\(.*?\)/', '$1', $label);
                    }

                    $result[$allowed] = $label;
                }
            }
        }

        return $result;
    }
}
