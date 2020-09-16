<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 5/22/2020
 * Time: 6:48 AM
 */

namespace App\Http;

class OptOutNotificationDTO implements \JsonSerializable
{
    private $id, $partnerRole, $productId, $externalTxId, $pricepointId, $mcc, $mnc, $msisdn, $entryChannel, $largeAccount, $transactionUUID;
    private $tags;

    public function __construct($arr)
    {
        if (isset($arr['id'])) {
            $this->id = $arr['id'];
        } else {
            $this->id = '';
        }
        if (isset($arr['partner_role_id'])) {
            $this->partnerRole = $arr['partner_role_id'];
        } else {
            $this->partnerRole = '';
        }
        if (isset($arr['product_id'])) {
            $this->productId = $arr['product_id'];
        } else {
            $this->productId = '';
        }
        if (isset($arr['price_point_id'])) {
            $this->pricepointId = $arr['price_point_id'];
        } else {
            $this->pricepointId = '';
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
        if (isset($arr['msisdn'])) {
            $this->msisdn = $arr['msisdn'];
        } else {
            $this->msisdn = '';
        }
        if (isset($arr['entry_channel'])) {
            $this->entryChannel = $arr['entry_channel'];
        } else {
            $this->entryChannel = '';
        }
        if (isset($arr['transaction_uuid'])) {
            $this->transactionUUID = $arr['transaction_uuid'];
        } else {
            $this->transactionUUID = '';
        }
        if (isset($arr['large_account'])) {
            $this->largeAccount = $arr['large_account'];
        } else {
            $this->largeAccount = '';
        }
        if (isset($arr['external_tx_id'])) {
            $this->externalTxId = $arr['external_tx_id'];
        } else {
            $this->externalTxId = '';
        }
        if (isset($arr['tags'])) {
            $this->tags = $arr['tags'];
        } else {
            $this->tags = [];
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        if (isset($this->id)) {
            return $this->id;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getPartnerRole()
    {
        if (isset($this->partnerRole)) {
            return $this->partnerRole;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        if (isset($this->productId)) {
            return $this->productId;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getExternalTxId()
    {
        if (isset($this->externalTxId)) {
            return $this->externalTxId;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getPricepointId()
    {
        if (isset($this->pricepointId)) {
            return $this->pricepointId;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getMcc()
    {
        if (isset($this->mcc)) {
            return $this->mcc;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getMnc()
    {
        if (isset($this->mnc)) {
            return $this->mnc;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getMsisdn()
    {
        if (isset($this->msisdn)) {
            return $this->msisdn;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getEntryChannel()
    {
        if (isset($this->entryChannel)) {
            return $this->entryChannel;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getLargeAccount()
    {
        if (isset($this->largeAccount)) {
            return $this->largeAccount;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getTransactionUUID()
    {
        if (isset($this->transactionUUID)) {
            return $this->transactionUUID;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        if (isset($this->tags)) {
            return $this->tags;
        }
        return [];
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
