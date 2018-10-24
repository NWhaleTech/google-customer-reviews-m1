<?php
/**
 * @author Stardiggers Team
 * @author Evgeni Obukhovsky <eobuhovsky@gmail.com>
 * @copyright Copyright (c) 2017 Stardiggers (https://www.stardiggers.com)
 * @package Stardiggers_Googlesurvey
 */

class Stardiggers_Googlesurvey_Model_System_Config_Source_Optinstyle
{
    public function toOptionArray() 
    {
        return array(
            array('label' => 'Center Dialog', 'value' => 'CENTER_DIALOG'),
            array('label' => 'Bottom Right Dialog', 'value' => 'BOTTOM_RIGHT_DIALOG'),
            array('label' => 'Bottom Left Dialog', 'value' => 'BOTTOM_LEFT_DIALOG'),
            array('label' => 'Top Right Dialog', 'value' => 'TOP_RIGHT_DIALOG'),
            array('label' => 'Top Left Dialog', 'value' => 'TOP_LEFT_DIALOG'),
            array('label' => 'Bottom Tray', 'value' => 'BOTTOM_TRAY'),
        );
    }

}