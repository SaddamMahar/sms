<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 5/22/2020
 * Time: 2:17 AM
 */

namespace App\Http\Controllers;


use App\Http\SendMTDTO;
use App\MAProductDetails;
use App\OptInNotifications;
use App\Subscriber;
use Carbon\Carbon;
use GuzzleHttp\Client as http;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;


class OptInNotificationController extends Controller
{
    private $channel, $url, $apikey, $auth;

    public function getAuthorized(Request $request, $partnerRole)
    {
        return $this->encryptedKey();
    }

    public function createOptInNotification(Request $request, $partnerRole)
    {
        $params = $request->all();

        $exTxId = $request->header('external-tx-id');
        $params['externalTxId'] = $exTxId;

        $validator = Validator::make($params, $this->OptInRules());
        if ($validator->passes()) {
            $mo = new OptInNotifications();

            $mo->partner_role_id = $partnerRole;
            $mo->external_tx_id = $exTxId;
            if (!isset($exTxId)) {
                $mo->external_tx_id = (string)Str::uuid();
                $exTxId = $mo->external_tx_id;
            }

            $this->modelFromParams($mo, $params);

            try {

                $productDetails = MAProductDetails::where('product_id', '=', $mo->product_id)->first();
                if (!isset($productDetails)) {
                    return response()->custom(new \stdClass(), 'INVALID_PRODUCT_ID', true, $exTxId, 'Failed', '500');
                }
                $res = $this->validateProductDetails($productDetails, $mo);
                if ($res !== null) {
                    return response()->custom(new \stdClass(), $res, true, $exTxId, 'Failed', '500');
                }
                $mo->save();

                $subscriber = new Subscriber();

                $this->modelFromModel($subscriber, $mo);

                $subscriber->save();
                return response()->custom(new \stdClass(), '', false, $exTxId, 'SUCCESS', '200');

            } catch (\Exception $e) {
                return response()->custom(new \stdClass(), $e->getMessage(), true, $exTxId, 'Failed', '500');
            }
        } else {
            $errMessage = '';
            foreach ($validator->errors()->all() as $err) {
                if ($errMessage === '') {
                    $errMessage = $err;
                } else {
                    $errMessage = $errMessage . ' ' . $err;
                }
            }
            return response()->custom(new \stdClass(), $errMessage, true, $exTxId, 'Failed', '500');
        }
    }

    public function sendMT($partnerRole)
    {
        $subscribers = Subscriber::where('status', 1)->get();

        $this->channel = config('app.channel'); //'sms'
        $this->apikey = config('app.apikey');
        $this->url = 'api/external/v1/' . $this->channel . '/mt/' . $partnerRole;
        $this->auth = $this->encryptedKey();

        $headers = ['apikey' => $this->apikey, 'authentication' => $this->auth];

        foreach ($subscribers as $subscriber) {
            $uuid = (string)Str::uuid();
            $headers['external-tx-id'] = $uuid;

            $subscriberArr = $subscriber->toArray();
            $payload = [];
            $payload['productId'] = $subscriberArr['product_id'];
            $payload['pricepointId'] = $subscriberArr['price_point_id'];
            $payload['mcc'] = $subscriberArr['mcc'];
            $payload['text'] = $subscriberArr['text'];
            $payload['mnc'] = $subscriberArr['mnc'];
            $payload['msisdn'] = $subscriberArr['msisdn'];
            $payload['largeAccount'] = $subscriberArr['largeAccount'];
            $payload['priority'] = 'NORMAL';
            $payload['timezone'] = 'Asia/Amman';
            $payload['context'] = 'STATELESS';

            $re = $this->post($this->url, $payload, $headers);

            $respBody = json_decode($re->getBody());
        }
    }

    public function notifyFirstCharge(Request $request, $partnerRole)
    {
        $timweeParams = [];
        $params = $request->all();

        $exTxId = $request->header('external-tx-id');
        if (!isset($exTxId)) {
            $exTxId = (string)Str::uuid();
        }

        try {
            $productDetails = MAProductDetails::where('product_id', '=', $params['productId'])->first();
            if (!isset($productDetails)) {
                return response()->custom(new \stdClass(), 'INVALID_PRODUCT_ID', true, $exTxId, 'Failed', '500');
            }

            $mo = new OptInNotifications();
            $this->modelFromParams($mo, $params);
            $res = $this->validateProductDetails($productDetails, $mo);
            if ($res !== null) {
                return response()->custom(new \stdClass(), $res, true, $exTxId, 'Failed', '500');
            }
        } catch (\Exception $e) {
            return response()->custom(new \stdClass(), $e->getMessage(), true, $exTxId, 'Failed', '500');
        }
        $timweeParams['productId'] = $params['productId'];
        $timweeParams['pricepointId'] = $params['pricepointId'];
        $timweeParams['mcc'] = $params['mcc'];
        $timweeParams['mnc'] = $params['mnc'];
        $timweeParams['msisdn'] = $params['msisdn'];
        $timweeParams['largeAccount'] = $params['largeAccount'];
        $timweeParams['priority'] = 'NORMAL';
        $timweeParams['timezone'] = 'Asia/Amman';
        $timweeParams['context'] = 'STATELESS';


        if (isset($params['mnoDeliveryCode'])) {
            if ($params['mnoDeliveryCode'] == 'DELIVERED') {

                $this->channel = config('app.channel'); //'sms'
                $this->apikey = config('app.apikey');
                $this->url = 'api/external/v1/' . $this->channel . '/mt/';
                $this->auth = $this->encryptedKey();

                $headers = ['apikey' => $this->apikey, 'authentication' => $this->auth];
                $urlSendMT = $this->url . $partnerRole;
                $uuid = (string)Str::uuid();
                $headers['external-tx-id'] = $uuid;
                $timweeParams['text'] = 'مباراة الميلان ضد أتالانتا انتهت لصالح أصحاب الأرض الميلان بنتيجة 1 - 0 ';

                try {
                    $this->post($urlSendMT, $timweeParams, $headers);
                } catch (\Exception $ex) {
                    return response()->custom(new \stdClass(), '', false, $exTxId,
                        'SUCCESS', '200');
                }
                return response()->custom(new \stdClass(), '', false, $exTxId,
                    'SUCCESS', '200');
            }
            if ($params['mnoDeliveryCode'] == 'NO_BALANCE') {

                $this->channel = config('app.channel'); //'sms'
                $this->apikey = config('app.apikey');
                $this->url = 'api/external/v1/' . $this->channel . '/mt/';
                $this->auth = $this->encryptedKey();

                $headers = ['apikey' => $this->apikey, 'authentication' => $this->auth];
                $urlSendMT = $this->url . $partnerRole;
                $uuid = (string)Str::uuid();
                $headers['external-tx-id'] = $uuid;

                $timweeParams['text'] = 'رصيدك غير كاف، الرجاء شحن الخط للاستفادة من الخدمة';

                try {
                    $this->post($urlSendMT, $timweeParams, $headers);
                } catch (\Exception $ex) {
                    return response()->custom(new \stdClass(), '', false, $exTxId,
                        'SUCCESS', '200');
                }
                return response()->custom(new \stdClass(), '', false, $exTxId,
                    'SUCCESS', '200');
            }
            if ($params['mnoDeliveryCode'] == 'NOT_ DELIVERED') {
                return response()->custom(new \stdClass(), '', false, $exTxId,
                    'SUCCESS', '200');
            }
        }
    }

    private function modelFromParams($mo, $params)
    {
        if (isset($params['productId'])) {
            $mo->product_id = $params['productId'];
        } else {
            $mo->product_id = '';
        }

        if (isset($params['pricepointId'])) {
            $mo->price_point_id = $params['pricepointId'];
        } else {
            $mo->price_point_id = '';
        }

        if (isset($params['mcc'])) {
            $mo->mcc = $params['mcc'];
        } else {
            $mo->mcc = '';
        }

        if (isset($params['mnc'])) {
            $mo->mnc = $params['mnc'];
        } else {
            $mo->mnc = '';
        }

        if (isset($params['text'])) {
            $mo->text = $params['text'];
        } else {
            $mo->text = '';
        }
        if (isset($params['entryChannel'])) {
            $mo->entry_channel = $params['entryChannel'];
        } else {
            $mo->entry_channel = '';
        }
        if (isset($params['msisdn'])) {
            $mo->msisdn = $params['msisdn'];
        } else {
            $mo->msisdn = '';
        }
        if (isset($params['tags'])) {
            $mo->tags = $params['tags'];
        } else {
            $mo->tags = [];
        }

        if (isset($params['largeAccount'])) {
            $mo->large_account = $params['largeAccount'];
        } else {
            $mo->large_account = '';
        }

        if (isset($params['transactionUUID'])) {
            $mo->transaction_uuid = $params['transactionUUID'];
        } else {
            $mo->transaction_uuid = '';
        }
        if (isset($params['userIdentifier'])) {
            $mo->user_identifier = $params['userIdentifier'];
        } else {
            $mo->user_identifier = '';
        }
        if (isset($params['userIdentifierType'])) {
            $mo->user_identifier_type = $params['userIdentifierType'];
        } else {
            $mo->user_identifier_type = '';
        }

        if (isset($params['mnoDeliveryCode'])) {
            $mo->mno_delivery_code = $params['mnoDeliveryCode'];
        } else {
            $mo->mno_delivery_code = '';
        }
    }

    private function modelFromModel($mo1, $mo2)
    {
        $mytime = Carbon::now();

        $mo1->subscribe_date = $mytime->toDateTimeString();
        $mo1->status = 1;

        $mo1->msisdn = $mo2->msisdn;
        $mo1->product_id = $mo2->product_id;
        $mo1->price_point_id = $mo2->price_point_id;
        $mo1->mcc = $mo2->mcc;
        $mo1->text = $mo2->text;
    }

    private function sendTimweePostReq($mo)
    {
        $this->channel = config('app.channel'); //'sms'
        $this->apikey = config('app.apikey');
        $this->url = 'api/external/v1/' . $this->channel . '/mt/';

        $payload = [];

        $payload['productId'] = $mo->product_id;
        $payload['mcc'] = $mo->mcc;
        $payload['mnc'] = $mo->mnc;
        $payload['msisdn'] = $mo->msisdn;

        if (isset($mo->price_point_id)) {
            $payload['pricepointId'] = $mo->price_point_id;
        } else {
            $payload['pricepointId'] = '';
        }

        if (isset($mo->text)) {
            $payload['text'] = $mo->text;
        } else {
            $payload['text'] = '';
        }

        if (isset($mo->large_account)) {
            $payload['largeAccount'] = $mo->large_account;
        } else {
            $payload['largeAccount'] = '';
        }

        $payload['priority'] = 'NORMAL';
        $payload['timezone'] = 'Asia/Amman';
        $payload['context'] = 'STATELESS';
        $uuid = (string)Str::uuid();
        $this->auth = $this->encryptedKey();
        $headers = ['apikey' => $this->apikey, 'authentication' => $this->auth, 'external-tx-id' => $uuid];

        $sendMtDto = new SendMTDTO([]);
        try {
            $re = $this->post($this->url . $mo->partner_role_id, $payload, $headers);
            $respBody = json_decode($re->getBody());

            $sendMtDto->setRequestId($respBody->requestId);
            $sendMtDto->setCode($respBody->code);
            $sendMtDto->setInError($respBody->inError);
            $sendMtDto->setResponseData($respBody->responseData);
            return $sendMtDto;
        } catch (\Exception $ex) {
            $responseBody = json_decode($ex->getResponse()->getBody(true));
            $sendMtDto->setRequestId($uuid);
            $sendMtDto->setCode($responseBody->message);
            $sendMtDto->setInError(true);
            $sendMtDto->setResponseData(new \stdClass());
            return $sendMtDto;

        }
    }

    /**
     * Network related calls to POST on to a remote server
     * @param $url
     * @param array $params
     * @param array $headers
     * @return bool|\Psr\Http\Message\ResponseInterface
     */
    private function post($url, $params = [], $headers = [])
    {

        // Network related
        $http = new http();
        $url = config('app.identity') . $url;

        array_push($headers, array('Content-Type' => 'application/json'));
        return $http->post($url, ['json' => $params, 'headers' => $headers]);
    }

    private function OptInRules()
    {
        return [
            'productId' => 'required',
            'userIdentifier' => 'required',
            'mcc' => 'required',
            'mnc' => 'required',
            'msisdn' => 'required',
            'transactionUUID' => 'required',
        ];
    }


    public function encryptedKey()
    {
        $method = "AES-128-ECB";
        $milliseconds = round(microtime(true) * 1000);
        $data = "3168" . "#" . $milliseconds;
        $key = "J1hboMqZ2LRB68e1";

        $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA);
        $result = Base64_encode($encrypted);

        return $result;
    }

    public function validateProductDetails($productDetails, $params)
    {
        if (isset($params->price_point_id) && $params->price_point_id != $productDetails['mt_price_point_id']) {
            return 'INVALID_PRICEPOINT_ID';
        }

        if (isset($params->mcc) && $params->mcc !== $productDetails['mcc']) {
            return 'INVALID_MCC';
        }
        if (isset($params->mnc) && $params->mnc !== $productDetails['mnc']) {
            return 'INVALID_MNC';
        }

//        if (isset($params->entry_channel) && $params->entry_channel == $productDetails['entry_channel']) {
//            return 'INVALID_ENTRY_CHANNEL';
//        }
//        if (isset($params->msisdn) && $params->msisdn == $productDetails['msisdn']) {
//            return 'INVALID_MSISDN';
//        }

        if (isset($params->large_account) && $params->large_account !== $productDetails['large_account']) {
            return 'INVALID_LARGE_ACCOUNT';
        }

//        if (isset($params->transaction_uuid) && $params->transaction_uuid == $productDetails['transaction_uuid']) {
//            return 'INVALID_TRANSACTION_UUID';
//        }
//        if (isset($params->user_identifier) && $params->user_identifier == $productDetails['user_identifier']) {
//            return 'INVALID_USER_IDENTIFIER';
//        }
//        if (isset($params->user_identifier_type) && $params->user_identifier_type == $productDetails['user_identifier_type']) {
//            return 'INVALID_USER_IDENTIFIER_TYPE';
//        }

//        if (isset($params->mno_delivery_code) && $params->mno_delivery_code == $productDetails['mno_delivery_code']) {
//            return 'INVALID_MNO_DELIVERY_CODE';
//        }
        return null;
    }
}
