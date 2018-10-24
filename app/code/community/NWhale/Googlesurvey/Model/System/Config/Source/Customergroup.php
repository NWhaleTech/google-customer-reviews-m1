<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

class NWhale_Googlesurvey_Model_System_Config_Source_Customergroup
{
    public function toOptionArray()
    {
        $groups = Mage::getModel('customer/group')->getCollection();
        $groupArray = array();
        foreach ($groups as $group) {
            $groupArray[] = array(
                'value' => $group->getCustomerGroupId(),
                'label' => $group->getCustomerGroupCode()
            );
        }

        return $groupArray;
    }
}