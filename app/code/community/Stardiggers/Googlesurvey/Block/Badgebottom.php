<?php
/**
 * @author Stardiggers Team
 * @author Evgeni Obukhovsky <eobuhovsky@gmail.com>
 * @copyright Copyright (c) 2017 Stardiggers (https://www.stardiggers.com)
 * @package Stardiggers_Googlesurvey
 */

class Stardiggers_Googlesurvey_Block_Badgebottom extends Mage_Core_Block_Template
{
    const XML_PATH_ENABLE = 'starsurvey/badge/enable';
    const XML_PATH_POSITION = 'starsurvey/badge/position';
    const XML_PATH_LANGUAGE = 'starsurvey/badge/language';

    protected function _construct()
    {
        $result = parent::_construct();
        $this->setCacheLifetime(null);
        return $result;
    }

    protected function _toHtml()
    {
        if (!Mage::helper('starsurvey')->isEnabled() || !$this->isBadgeEnabled()) {
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
        return Mage::helper('starsurvey')->getMerchantId();
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return Mage::getStoreConfig(self::XML_PATH_LANGUAGE);
    }
}