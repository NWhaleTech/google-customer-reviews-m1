<?php
/**
 * @author Stardiggers Team
 * @author Evgeni Obukhovsky <eobuhovsky@gmail.com>
 * @copyright Copyright (c) 2017 Stardiggers (https://www.stardiggers.com)
 * @package Stardiggers_Googlesurvey
 */

class Stardiggers_Googlesurvey_Block_Badge extends Stardiggers_Googlesurvey_Block_Badgebottom
{
    protected function _construct()
    {
        $result = parent::_construct();
        $this->setTemplate('stardiggers/googlesurvey/badge.phtml');
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