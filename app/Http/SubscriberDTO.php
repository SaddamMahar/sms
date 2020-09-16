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
        }
        if (isset($arr['msisdn'])) {
            $this->msisdn = $arr['msisdn'];
        }
        if (isset($arr['product_id'])) {
            $this->productId = $arr['product_id'];
        }
        if (isset($arr['price_point_id'])) {
            $this->pricePointId = $arr['price_point_id'];
        }
        if (isset($arr['mcc'])) {
            $this->mcc = $arr['mcc'];
        }
        if (isset($arr['text'])) {
            $this->text = $arr['text'];
        }
        if (isset($arr['subscribe_date'])) {
            $this->subscribeDate = $arr['subscribe_date'];
        }
        if (isset($arr['unsubscribe_date'])) {
            $this->unsubscribeDate = $arr['unsubscribe_date'];
        }
        if (isset($arr['status'])) {
            $this->status = $arr['status'];
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
        return $this->msisdn;
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
        return $this->productId;
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
        return $this->pricePointId;
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
        return $this->mcc;
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
        return $this->text;
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
        return $this->subscribeDate;
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
        return $this->unsubscribeDate;
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
        return $this->status;
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
