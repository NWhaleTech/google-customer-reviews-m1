<?php
/**
 * @author Stardiggers Team
 * @author Evgeni Obukhovsky <eobuhovsky@gmail.com>
 * @copyright Copyright (c) 2017 Stardiggers (https://www.stardiggers.com)
 * @package Stardiggers_Googlesurvey
 */

class Stardiggers_Googlesurvey_Model_System_Config_Source_Language
{
    public function toOptionArray()
    {
        $allowedLanguages = array(
            "cs", "da", "de", "en_AU", "en_GB", "en_US", "es", "fr",
            "it", "ja", "nl", "no", "pl", "pt_BR", "ru", "sv", "tr");
        $result = array(0 => Mage::helper('starsurvey')->__('User Environment Defined'));
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
