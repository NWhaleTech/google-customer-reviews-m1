<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

class NWhale_Googlesurvey_Block_Badge extends NWhale_Googlesurvey_Block_Badgebottom
{
    protected function _construct()
    {
        $result = parent::_construct();
        $this->setTemplate('nwhale/googlesurvey/badge.phtml');
        return $result;
    }

    /**
     * @return bool
     */
    protected function isBadgeEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLE)
            && $this->getPosition() == 'CUSTOM';
    }
}