<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

class NWhale_Googlesurvey_Block_Badgebottom extends Mage_Core_Block_Template
{
    const XML_PATH_ENABLE = 'nwhale_google_reviews/badge/enable';
    const XML_PATH_POSITION = 'nwhale_google_reviews/badge/position';
    const XML_PATH_LANGUAGE = 'nwhale_google_reviews/badge/language';

    protected function _construct()
    {
        $result = parent::_construct();
        $this->setCacheLifetime(null);
        return $result;
    }

    protected function _toHtml()
    {
        if (!Mage::helper('nwhale_google_reviews')->isEnabled() || !$this->isBadgeEnabled()) {
            return '';
        }

        return parent::_toHtml();
    }

    /**
     * @return bool
     */
    protected function isBadgeEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLE)
            && in_array($this->getPosition(), array('BOTTOM_RIGHT', 'BOTTOM_LEFT'));
    }

    public function getPosition()
    {
        return Mage::getStoreConfig(self::XML_PATH_POSITION);
    }

    public function getMerchantId()
    {
        return Mage::helper('nwhale_google_reviews')->getMerchantId();
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return Mage::getStoreConfig(self::XML_PATH_LANGUAGE);
    }
}