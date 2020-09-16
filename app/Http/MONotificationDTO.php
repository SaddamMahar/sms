<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 5/22/2020
 * Time: 6:47 AM
 */
namespace App\Http;

class MONotificationDTO implements \JsonSerializable
{
    private $id, $partnerRole, $productId, $pricepointId, $mcc, $mnc, $text, $msisdn, $largeAccount, $transactionUUID, $externalTxId;
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
        if (isset($arr['text'])) {
            $this->text = $arr['text'];
        }
        if (isset($arr['msisdn'])) {
            $this->msisdn = $arr['msisdn'];
        }
        if (isset($arr['transaction_uuid'])) {
            $this->transactionUUID = $arr['transaction_uuid'];
        }
        if (isset($arr['large_account'])) {
            $this->largeAccount = $arr['large_account'];
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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getMsisdn()
    {
        return $this->msisdn;
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
    public function getExternalTxId()
    {
        return $this->externalTxId;
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
