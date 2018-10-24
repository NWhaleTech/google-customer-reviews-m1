<?php
/**
 * @author Stardiggers Team
 * @author Evgeni Obukhovsky <eobuhovsky@gmail.com>
 * @copyright Copyright (c) 2017 Stardiggers (https://www.stardiggers.com)
 * @package Stardiggers_Googlesurvey
 */

class Stardiggers_Googlesurvey_Model_System_Config_Source_Badgeposition
{
    public function toOptionArray() 
    {
        return array(
            array('label' => 'Bottom Right', 'value' => 'BOTTOM_RIGHT'),
            array('label' => 'Bottom Left', 'value' => 'BOTTOM_LEFT'),
            array('label' => 'Custom', 'value' => 'CUSTOM'),
        );
    }
}