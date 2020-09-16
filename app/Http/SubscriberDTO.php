<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 5/22/2020
 * Time: 6:48 AM
 */

namespace App\Http;

class SubscriberDTO implements \JsonSerializable
{
    private $id, $msisdn, $productId, $pricePointId, $mcc, $text, $subscribeDate, $unsubscribeDate, $status;

    public function __construct($arr)
    {
        if (isset($arr['id'])) {
            $this->id = $arr['id'];
        } else {
            $this->id = '';
        }
        if (isset($arr['msisdn'])) {
            $this->msisdn = $arr['msisdn'];
        } else {
            $this->msisdn = '';
        }
        if (isset($arr['product_id'])) {
            $this->productId = $arr['product_id'];
        } else {
            $this->productId = '';
        }
        if (isset($arr['price_point_id'])) {
            $this->pricePointId = $arr['price_point_id'];
        } else {
            $this->pricePointId = '';
        }
        if (isset($arr['mcc'])) {
            $this->mcc = $arr['mcc'];
        } else {
            $this->mcc = '';
        }
        if (isset($arr['text'])) {
            $this->text = $arr['text'];
        } else {
            $this->text = '';
        }
        if (isset($arr['subscribe_date'])) {
            $this->subscribeDate = $arr['subscribe_date'];
        } else {
            $this->subscribeDate = '';
        }
        if (isset($arr['unsubscribe_date'])) {
            $this->unsubscribeDate = $arr['unsubscribe_date'];
        } else {
            $this->unsubscribeDate = '';
        }
        if (isset($arr['status'])) {
            $this->status = $arr['status'];
        } else {
            $this->status = '';
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
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
     * @param mixed $msisdn
     */
    public function setMsisdn($msisdn): void
    {
        $this->msisdn = $msisdn;
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
     * @param mixed $productId
     */
    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getPricePointId()
    {
        if (isset($this->pricePointId)) {
            return $this->pricePointId;
        }
        return '';
    }

    /**
     * @param mixed $pricePointId
     */
    public function setPricePointId($pricePointId): void
    {
        $this->pricePointId = $pricePointId;
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
     * @param mixed $mcc
     */
    public function setMcc($mcc): void
    {
        $this->mcc = $mcc;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        if (isset($this->text)) {
            return $this->text;
        }
        return '';
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getSubscribeDate()
    {
        if (isset($this->subscribeDate)) {
            return $this->subscribeDate;
        }
        return '';
    }

    /**
     * @param mixed $subscribeDate
     */
    public function setSubscribeDate($subscribeDate): void
    {
        $this->subscribeDate = $subscribeDate;
    }

    /**
     * @return mixed
     */
    public function getUnsubscribeDate()
    {
        if (isset($this->unsubscribeDate)) {
            return $this->unsubscribeDate;
        }
        return '';
    }

    /**
     * @param mixed $unsubscribeDate
     */
    public function setUnsubscribeDate($unsubscribeDate): void
    {
        $this->unsubscribeDate = $unsubscribeDate;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        if (isset($this->status)) {
            return $this->status;
        }
        return '';
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
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
