<?php
/**
 * @author Stardiggers Team
 * @author Evgeni Obukhovsky <eobuhovsky@gmail.com>
 * @copyright Copyright (c) 2017 Stardiggers (https://www.stardiggers.com)
 * @package Stardiggers_Googlesurvey
 */

class Stardiggers_Googlesurvey_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLE = 'starsurvey/general/enable';
    const XML_PATH_MERCHANT_ID = 'starsurvey/general/merchant_id';

    public function getMerchantId()
    {
        return Mage::getStoreConfig(self::XML_PATH_MERCHANT_ID);
    }

    public function isEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLE);
    }
}