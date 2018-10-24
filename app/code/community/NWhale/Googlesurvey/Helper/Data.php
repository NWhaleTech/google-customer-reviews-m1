<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

class NWhale_Googlesurvey_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLE = 'nwhale_google_reviews/general/enable';
    const XML_PATH_MERCHANT_ID = 'nwhale_google_reviews/general/merchant_id';

    public function getMerchantId()
    {
        return Mage::getStoreConfig(self::XML_PATH_MERCHANT_ID);
    }

    public function isEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLE);
    }
}