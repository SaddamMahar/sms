<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 10/9/2020
 * Time: 12:33 PM
 */

namespace App\Http;

class OptOutNotificationDTO implements \JsonSerializable
{
    private $id, $productId, $productName, $partnerRoleId, $serviceId, $largeAccount,
        $mtPricePointId, $mcc, $mnc, $moPricePointId, $billingPricePointId;

    public function __construct($arr)
    {
        if (isset($arr['id'])) {
            $this->id = $arr['id'];
        } else {
            $this->id = '';
        }
        if (isset($arr['product_id'])) {
            $this->productId = $arr['product_id'];
        } else {
            $this->productId = '';
        }
        if (isset($arr['product_name'])) {
            $this->productName = $arr['product_name'];
        } else {
            $this->productName = '';
        }
        if (isset($arr['partner_role_id'])) {
            $this->partnerRoleId = $arr['partner_role_id'];
        } else {
            $this->partnerRoleId = '';
        }
        if (isset($arr['service_id'])) {
            $this->serviceId = $arr['service_id'];
        } else {
            $this->serviceId = '';
        }
        if (isset($arr['large_account'])) {
            $this->largeAccount = $arr['large_account'];
        } else {
            $this->largeAccount = '';
        }
        if (isset($arr['mt_price_point_id'])) {
            $this->mtPricePointId = $arr['mt_price_point_id'];
        } else {
            $this->mtPricePointId = '';
        }
        if (isset($arr['mcc'])) {
            $this->mcc = $arr['mcc'];
        } else {
            $this->mcc = '';
        }
        if (isset($arr['mnc'])) {
            $this->mnc = $arr['mnc'];
        } else {
            $this->mnc = '';
        }
        if (isset($arr['mo_price_point_id'])) {
            $this->moPricePointId = $arr['mo_price_point_id'];
        } else {
            $this->moPricePointId = '';
        }
        if (isset($arr['billing_price_point_id'])) {
            $this->billingPricePointId = $arr['billing_price_point_id'];
        } else {
            $this->billingPricePointId = '';
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     */
    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return string
     */
    public function getPartnerRoleId(): string
    {
        return $this->partnerRoleId;
    }

    /**
     * @param string $partnerRoleId
     */
    public function setPartnerRoleId(string $partnerRoleId): void
    {
        $this->partnerRoleId = $partnerRoleId;
    }

    /**
     * @return string
     */
    public function getServiceId(): string
    {
        return $this->serviceId;
    }

    /**
     * @param string $serviceId
     */
    public function setServiceId(string $serviceId): void
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @return string
     */
    public function getLargeAccount(): string
    {
        return $this->largeAccount;
    }

    /**
     * @param string $largeAccount
     */
    public function setLargeAccount(string $largeAccount): void
    {
        $this->largeAccount = $largeAccount;
    }

    /**
     * @return string
     */
    public function getMtPricePointId(): string
    {
        return $this->mtPricePointId;
    }

    /**
     * @param string $mtPricePointId
     */
    public function setMtPricePointId(string $mtPricePointId): void
    {
        $this->mtPricePointId = $mtPricePointId;
    }

    /**
     * @return string
     */
    public function getMcc(): string
    {
        return $this->mcc;
    }

    /**
     * @param string $mcc
     */
    public function setMcc(string $mcc): void
    {
        $this->mcc = $mcc;
    }

    /**
     * @return string
     */
    public function getMnc(): string
    {
        return $this->mnc;
    }

    /**
     * @param string $mnc
     */
    public function setMnc(string $mnc): void
    {
        $this->mnc = $mnc;
    }

    /**
     * @return string
     */
    public function getMoPricePointId(): string
    {
        return $this->moPricePointId;
    }

    /**
     * @param string $moPricePointId
     */
    public function setMoPricePointId(string $moPricePointId): void
    {
        $this->moPricePointId = $moPricePointId;
    }

    /**
     * @return string
     */
    public function getBillingPricePointId(): string
    {
        return $this->billingPricePointId;
    }

    /**
     * @param string $billingPricePointId
     */
    public function setBillingPricePointId(string $billingPricePointId): void
    {
        $this->billingPricePointId = $billingPricePointId;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}
