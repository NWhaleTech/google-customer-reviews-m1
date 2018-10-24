<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

class NWhale_Googlesurvey_Model_System_Config_Source_Optinstyle
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