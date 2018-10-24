<?php
/**
 * @author Stardiggers Team
 * @author Evgeni Obukhovsky <eobuhovsky@gmail.com>
 * @copyright Copyright (c) 2017 Stardiggers (https://www.stardiggers.com)
 * @package Stardiggers_Googlesurvey
 */

class Stardiggers_Googlesurvey_Model_System_Config_Source_Customergroup
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