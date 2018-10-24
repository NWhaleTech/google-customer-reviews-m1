<?php
/**
 * @author NWhale Team
 *
 * @copyright Copyright (c) 2018 NWhale (https://www.nwhaletech.com)
 * @package NWhale_Googlesurvey
 */

use NWhale_Googlesurvey_Model_System_Config_Backend_Customdelivery as Delivery;

class NWhale_Googlesurvey_Helper_Customdelivery
{
    const ANY_METHOD = 'any_method';

    const XML_PATH_DELIVERY_CUSTOM_TIME = 'nwhale_google_reviews/general/custom_time';

    /**
     * @param mixed $offset
     * @return mixed
     */
    protected function fixDeliveryOffset($offset)
    {
        return max(0, (int) $offset);
    }

    /**
     * @param mixed $value
     * @return string
     */
    protected function serializeValue($value)
    {
        if (is_numeric($value)) {
            $result = (float)$value;
            return (string)$result;
        } else if (is_array($value)) {
            $result = array();
            foreach ($value as $shipmethod => $country) {
                if (!array_key_exists($shipmethod, $result)) {
                    $result[$shipmethod] = array();
                }

                foreach ($country as $code => $data) {
                    if (!array_key_exists($code, $result[$shipmethod])) {
                        $result[$shipmethod][$code] = $data;
                    }
                }
            }

            return serialize($result);
        } else {
            return '';
        }
    }

    /**
     * @param mixed $value
     * @return array
     */
    protected function unserializeValue($value)
    {
       if (is_string($value) && !empty($value)) {
            try {
                return Mage::helper('core/unserializeArray')->unserialize($value);
            } catch (Exception $e) {
                return array();
            }
       } else {
            return array();
       }
    }

    /**
     * @param mixed $value
     * @return bool
     */
    protected function isEncodedArrayFieldValue($value)
    {
        if (!is_array($value)) {
            return false;
        }

        unset($value['__empty']);
        foreach ($value as $row) {
            if (!is_array($row)
                || !array_key_exists(Delivery::SHIPPING_METHOD, $row)
                || !array_key_exists(Delivery::COUNTRY, $row)
                || !array_key_exists(Delivery::DELIVERY_WEEKENDS, $row)
                || !array_key_exists(Delivery::DELIVERY_TIME, $row)
            ) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $value
     * @return array
     */
    protected function encodeArrayFieldValue(array $value)
    {
        $result = array();
        foreach ($value as $shipmethod => $countryData) {
            foreach ($countryData as $country => $data) {
                $id = Mage::helper('core')->uniqHash('_');
                $result[$id] = array(
                    Delivery::SHIPPING_METHOD => $shipmethod,
                    Delivery::COUNTRY =>$country,
                    Delivery::DELIVERY_WEEKENDS => $data[0],
                    Delivery::DELIVERY_TIME =>$this->fixDeliveryOffset($data[1])
                );
            }
        }

        return $result;
    }

    /**
     * @param array $value
     * @return array
     */
    protected function decodeArrayFieldValue(array $value)
    {
        $result = array();
        unset($value['__empty']);
        foreach ($value as $row) {
            if (!is_array($row)
                || !array_key_exists(Delivery::SHIPPING_METHOD, $row)
                || !array_key_exists(Delivery::COUNTRY, $row)
                || !array_key_exists(Delivery::DELIVERY_WEEKENDS, $row)
                || !array_key_exists(Delivery::DELIVERY_TIME, $row)
            ) {
                continue;
            }

            if ('0' === $row[Delivery::SHIPPING_METHOD] || '0' === $row[Delivery::COUNTRY]) {
                continue;
            }

            $result[$row[Delivery::SHIPPING_METHOD]][$row[Delivery::COUNTRY]] = array(
                boolval($row[Delivery::DELIVERY_WEEKENDS]),
                $this->fixDeliveryOffset($row[Delivery::DELIVERY_TIME])
            );
        }

        // Push any_method last.
        if (isset($result[self::ANY_METHOD])) {
            $anyMethod = array(self::ANY_METHOD => $result[self::ANY_METHOD]);
            unset($result[self::ANY_METHOD]);
            $result = array_merge($result, $anyMethod);
        }

        return $result;
    }

    /**
     * @param string $shippingMethod
     * @param string $country
     * @return array|null
     */
    public function getConfigValue($shippingMethod, $country)
    {
        $value = Mage::getStoreConfig(self::XML_PATH_DELIVERY_CUSTOM_TIME);
        $value = $this->unserializeValue($value);
        if ($this->isEncodedArrayFieldValue($value)) {
            $value = $this->decodeArrayFieldValue($value);
        }

        if (isset($value[$shippingMethod])) {
            if (isset($value[$shippingMethod][$country])) {
                return $value[$shippingMethod][$country];
            }
        }

        if (isset($value[self::ANY_METHOD])) {
            if (isset($value[self::ANY_METHOD][$country])) {
                return $value[self::ANY_METHOD][$country];
            }
        }

        return null;
    }

    /**
     * @param string $value
     * @return array
     */
    public function makeArrayFieldValue($value)
    {
        $value = $this->unserializeValue($value);
        if (!$this->isEncodedArrayFieldValue($value)) {
            $value = $this->encodeArrayFieldValue($value);
        }

        return $value;
    }

    /**
     * @param $value
     * @return array|string
     */
    public function makeStorableArrayFieldValue($value)
    {
        if ($this->isEncodedArrayFieldValue($value)) {
            $value = $this->decodeArrayFieldValue($value);
        }

        $value = $this->serializeValue($value);
        return $value;
    }
}
