<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

class NWhale_Googlesurvey_Model_System_Config_Source_Badgeposition
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