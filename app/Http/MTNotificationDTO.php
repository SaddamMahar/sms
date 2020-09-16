<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 5/22/2020
 * Time: 6:48 AM
 */

namespace App\Http;

class MTNotificationDTO implements \JsonSerializable
{
    private $id, $partnerRole, $productId, $externalTxId, $pricepointId, $mcc, $mnc, $userIdentifier, $largeAccount, $transactionUUID, $mnoDeliveryCode;
    private $tags;

    public function __construct($arr)
    {
        if (isset($arr['id'])) {
            $this->id = $arr['id'];
        }
        if (isset($arr['partner_role_id'])) {
            $this->partnerRole = $arr['partner_role_id'];
        }
        if (isset($arr['product_id'])) {
            $this->productId = $arr['product_id'];
        }
        if (isset($arr['price_point_id'])) {
            $this->pricepointId = $arr['price_point_id'];
        }
        if (isset($arr['mcc'])) {
            $this->mcc = $arr['mcc'];
        }
        if (isset($arr['mnc'])) {
            $this->mnc = $arr['mnc'];
        }
        if (isset($arr['user_identifier'])) {
            $this->userIdentifier = $arr['user_identifier'];
        }
        if (isset($arr['transaction_uuid'])) {
            $this->transactionUUID = $arr['transaction_uuid'];
        }
        if (isset($arr['large_account'])) {
            $this->largeAccount = $arr['large_account'];
        }
        if (isset($arr['mno_delivery_code'])) {
            $this->mnoDeliveryCode = $arr['mno_delivery_code'];
        }
        if (isset($arr['external_tx_id'])) {
            $this->externalTxId = $arr['external_tx_id'];
        }
        if (isset($arr['tags'])) {
            $this->tags = $arr['tags'];
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPartnerRole()
    {
        return $this->partnerRole;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return mixed
     */
    public function getExternalTxId()
    {
        return $this->externalTxId;
    }

    /**
     * @return mixed
     */
    public function getPricepointId()
    {
        return $this->pricepointId;
    }

    /**
     * @return mixed
     */
    public function getMcc()
    {
        return $this->mcc;
    }

    /**
     * @return mixed
     */
    public function getMnc()
    {
        return $this->mnc;
    }

    /**
     * @return mixed
     */
    public function getUserIdentifier()
    {
        return $this->userIdentifier;
    }

    /**
     * @return mixed
     */
    public function getLargeAccount()
    {
        return $this->largeAccount;
    }

    /**
     * @return mixed
     */
    public function getTransactionUUID()
    {
        return $this->transactionUUID;
    }

    /**
     * @return mixed
     */
    public function getMnoDeliveryCode()
    {
        return $this->mnoDeliveryCode;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
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
