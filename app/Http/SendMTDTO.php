<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 9/27/2020
 * Time: 9:02 PM
 */

namespace App\Http;

class SendMTDTO implements \JsonSerializable
{
    private $requestId, $code, $inError, $responseData;

    public function __construct($arr)
    {
        if (isset($arr['requestId'])) {
            $this->requestId = $arr['requestId'];
        } else {
            $this->requestId = '';
        }

        if (isset($arr['code'])) {
            $this->code = $arr['code'];
        } else {
            $this->code = '';
        }

        if (isset($arr['inError'])) {
            $this->inError = $arr['inError'];
        } else {
            $this->inError = false;
        }

        if (isset($arr['responseData'])) {
            $this->responseData = $arr['responseData'];
        } else {
            $this->responseData = new \stdClass();
        }
    }

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

    /**
     * @param string $requestId
     */
    public function setRequestId(string $requestId): void
    {
        $this->requestId = $requestId;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return bool
     */
    public function isInError(): bool
    {
        return $this->inError;
    }

    /**
     * @param bool $inError
     */
    public function setInError(bool $inError): void
    {
        $this->inError = $inError;
    }

    /**
     * @return object
     */
    public function getResponseData(): object {
        return $this->responseData;
    }

    /**
     * @param array $responseData
     */
    public function setResponseData(object $responseData): void
    {
        $this->responseData = $responseData;
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
