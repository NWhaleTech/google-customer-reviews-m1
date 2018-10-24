<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

/**
 * Class NWhale_Googlesurvey_Block_Survey
 *
 * @method string getMerchantId()
 * @method string getOrderId()
 * @method string getEmail()
 * @method string getDeliveryCountry()
 * @method string getEstimatedDeliveryDate()
 * @method string getOptInStyle()
 * @method string getIsValid()
 */
class NWhale_Googlesurvey_Block_Survey extends Mage_Core_Block_Template
{
    const MERCHANT_ID = 'merchant_id';
    const ORDER_ID = 'order_id';
    const EMAIL = 'email';
    const DELIVERY_COUNTRY = 'delivery_country';
    const ESTIMATED_DELIVERY_DATE = 'estimated_delivery_date';
    const OPT_IN_STYLE = 'opt_in_style';

    const XML_PATH_OPT_IN_STYLE = 'nwhale_google_reviews/opt-in/style';
    const XML_PATH_ALL_CUSTOMERS = 'nwhale_google_reviews/opt-in/all_customers';
    const XML_PATH_CUSTOMER_GROUPS = 'nwhale_google_reviews/opt-in/customer_groups';
    const XML_PATH_DELIVERY_TIME = 'nwhale_google_reviews/general/delivery_time';
    const XML_PATH_DELIVERY_WEEKENDS = 'nwhale_google_reviews/general/delivery_weekends';
    const XML_PATH_LANGUAGE = 'nwhale_google_reviews/opt-in/language';

    protected function _construct()
    {
        $result = parent::_construct();
        $this->addSurveyData();
        $this->setCacheLifetime(null);
        return $result;
    }

    protected function _toHtml()
    {
        if (!$this->getIsValid()) {
            return '';
        }

        return parent::_toHtml();
    }

    protected function addSurveyData()
    {
        if (!Mage::helper('nwhale_google_reviews')->isEnabled()) {
            return;
        }

        if (!$this->validateUserRole()) {
            return;
        }

        $orderId = Mage::getSingleton('checkout/session')->getLastOrderId();
        if ($orderId) {
            /** @var Mage_Sales_Model_Order $order */
            $order = Mage::getModel('sales/order')->load($orderId);
            if ($order->getId()) {
                $this->addDataFromOrder($order);
            }
        }
    }

    /**
     * @return bool
     */
    protected function validateUserRole()
    {
        if (Mage::getStoreConfigFlag(self::XML_PATH_ALL_CUSTOMERS)) {
            return true;
        }

        $roleId = Mage::getSingleton('customer/session')->getCustomerGroupId();
        $groups = explode(',', Mage::getStoreConfig(self::XML_PATH_CUSTOMER_GROUPS));
        return in_array($roleId, $groups);
    }

    /**
     * @param Mage_Sales_Model_Order $order
     */
    protected function addDataFromOrder($order)
    {
        $countryCode = $order->getBillingAddress()->getCountryId();
        if ($order->getShippingAddress() && $order->getShippingAddress()->getCountryId()) {
            $countryCode = $order->getShippingAddress()->getCountryId();
        }

        $data = array(
            self::MERCHANT_ID => Mage::helper('nwhale_google_reviews')->getMerchantId(),
            self::ORDER_ID => $order->getIncrementId(),
            self::EMAIL => $order->getCustomerEmail(),
            self::DELIVERY_COUNTRY => $countryCode,
            self::ESTIMATED_DELIVERY_DATE => $this->getDate($order, $countryCode),
            self::OPT_IN_STYLE => Mage::getStoreConfig(self::XML_PATH_OPT_IN_STYLE),
        );
        if ($this->validateData($data)) {
            $this->addData($data);
            $this->setIsValid(true);
        }
    }

    /**
     * @param Mage_Sales_Model_Order $order
     * @param string $countryCode
     * @return string
     */
    protected function getDate($order, $countryCode)
    {
        $date = new \Datetime();
        $date->setTimestamp($order->getCreatedAtDate()->toString(\Zend_Date::TIMESTAMP));
        if (!$order->getIsVirtual()) {
            list($dayType, $offset) = $this->getDateOffset($order, $countryCode);
            if ($offset > 0) {
                $date->add(DateInterval::createFromDateString('+ ' . $offset . ' ' . $dayType));
            }
        }

        return $date->format('Y-m-d');
    }

    /**
     * @param Mage_Sales_Model_Order $order
     * @param string $countryCode
     * @return array
     */
    protected function getDateOffset($order, $countryCode)
    {
        $method = $order->getShippingMethod();
        $dateByRules = Mage::helper('nwhale_google_reviews/customdelivery')->getConfigValue($method, $countryCode);
        if (is_array($dateByRules) && 2 == count($dateByRules)) {
            $dateByRules[0] = $dateByRules[0] ? 'days' : 'weekdays';
            return $dateByRules;
        }

        $defaultDayType = Mage::getStoreConfigFlag(self::XML_PATH_DELIVERY_WEEKENDS)
            ? 'days' : 'weekdays';
        $defaultOffset = (int) Mage::getStoreConfig(self::XML_PATH_DELIVERY_TIME);
        return array($defaultDayType, $defaultOffset);
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function validateData($data)
    {
        foreach ($data as $value) {
            if (empty($value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return Mage::getStoreConfig(self::XML_PATH_LANGUAGE);
    }
}