<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 5/22/2020
 * Time: 2:17 AM
 */

namespace App\Http\Controllers;


use App\Http\OptInNotificationDTO;
use App\OptInNotifications;
use App\Subscriber;
use Carbon\Carbon;
use GuzzleHttp\Client as http;
use Illuminate\Database\Query\Processors\PostgresProcessor;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Unset_;
use Validator;
use Illuminate\Support\Str;


class OptInNotificationController extends Controller
{
    private $channel, $url, $apikey, $auth;

    public function getAuthorized(Request $request, $partnerRole) {
        $this->sendMT($partnerRole);
        return 'eqmsLG5p7T8NsMjLRqB8x4wFAVqYo/DumDhizmF/+zQ=';
    }

    public function createOptInNotification(Request $request, $partnerRole)
    {
        $params = $request->all();

        $exTxId = $request->header('external-tx-id');
        if (isset($exTxId)) {}
        $params['externalTxId'] = $exTxId;

        $validator = Validator::make($params, $this->OptInRules());
        if ($validator->passes()) {
            $mo = new OptInNotifications();

            $mo->partner_role_id = $partnerRole;
            $mo->external_tx_id = $exTxId;

            $this->modelFromParams($mo, $params);

            try {
                $mo->save();

                $subscriber = new Subscriber();

                $this->modelFromModel($subscriber, $mo);

                $subscriber->save();

                $this->sendTimweePostReq($mo);

                $dto = new OptInNotificationDTO($mo);

                return response()->custom($dto, 'Saved', false, $exTxId, '201');

            } catch (\Exception $e) {
                return response()->custom($params, $e->getMessage(), true, $exTxId, '500');
            }
        } else {
            return response()->custom($params, $validator->errors()->all(), true, $exTxId, '500');
        }
    }

    public function sendMT($partnerRole)
    {
        $subscribers = Subscriber::where('status', 1)->get();

        $this->channel = config('app.channel'); //'sms'
        $this->apikey = config('app.apikey');
        $this->auth = 'eqmsLG5p7T8NsMjLRqB8x4wFAVqYo/DumDhizmF/+zQ=';
        $this->url = 'api/external/v1/' . $this->channel . '/mt/' . $partnerRole;

        $headers = ['apikey' => $this->apikey, 'authentication' => $this->auth];

        foreach ($subscribers as $subscriber) {
            $uuid = (string) Str::uuid();
            $headers['external-tx-id'] = $uuid;

            $subscriberArr = $subscriber->toArray();
            $payload = [];
            $payload['productId'] = $subscriberArr['product_id'];
            $payload['pricepointId'] = $subscriberArr['price_point_id'];
            $payload['mcc'] = $subscriberArr['mcc'];
            $payload['text'] = $subscriberArr['text'];
            $payload['mnc'] = '03';
            $payload['msisdn'] = '962795156077';
            $payload['largeAccount'] = '95910';
            $payload['priority'] = 'NORMAL';
            $payload['timezone'] = 'Asia/Amman';
            $payload['context'] = 'STATELESS';

            $re = $this->post($this->url, $payload, $headers);

            $respBody = json_decode($re->getBody());
            echo '<pre>';print_r($respBody);echo '</pre>';
        }
    }

    public function notifyFirstCharge(Request $request, $partnerRole)
    {
        $params = $request->all();
        $exTxId = $request->header('external-tx-id');
        $params['externalTxId'] = $exTxId;

        if(isset($params['mnoDeliveryCode'])) {
            if ($params['mnoDeliveryCode'] == 'not DELIVERED' || $params['mnoDeliveryCode'] == 'NOT DELIVERED' ) {

                $this->channel = config('app.channel'); //'sms'
                $this->apikey = config('app.apikey');
                $this->auth = 'eqmsLG5p7T8NsMjLRqB8x4wFAVqYo/DumDhizmF/+zQ=';
                $this->url = 'api/external/v1/' . $this->channel . '/mt/';

                $headers = ['apikey' => $this->apikey, 'authentication' => $this->auth];
                $urlSendMT = $this->url . $partnerRole;
                $uuid = (string) Str::uuid();
                $headers['external-tx-id'] = $uuid;

                $params['text'] = 'ÑÕíÏß ÛíÑ ßÇÝ¡ ÇáÑÌÇÁ ÔÍä ÇáÎØ ááÇÓÊÝÇÏÉ ãä ÇáÎÏãÉ';

                $re = $this->post($urlSendMT, $params, $headers);

                $respBody = json_decode($re->getBody());
                return response()->custom($respBody, 'OK', false, $exTxId, '200');
            }
        }
    }

    private function modelFromParams($mo, $params) {
        $mo->product_id = $params['productId'];
        $mo->price_point_id = $params['pricepointId'];
        $mo->mcc = $params['mcc'];
        $mo->mnc = $params['mnc'];
        $mo->text = $params['text'];
        $mo->entry_channel = $params['entryChannel'];
        $mo->msisdn = $params['msisdn'];
        $mo->tags = $params['tags'];
        $mo->large_account = $params['largeAccount'];
        $mo->transaction_uuid = $params['transactionUUID'];
    }

    private function modelFromModel($mo1, $mo2) {
        $mytime = Carbon::now();

        $mo1->subscribe_date = $mytime->toDateTimeString();
        $mo1->status = 1;

        $mo1->msisdn = $mo2->msisdn;
        $mo1->product_id = $mo2->product_id;
        $mo1->price_point_id = $mo2->price_point_id;
        $mo1->mcc = $mo2->mcc;
        $mo1->text = $mo2->text;
    }

    private function sendTimweePostReq($mo) {
        $this->channel = config('app.channel'); //'sms'
        $this->apikey = config('app.apikey');
        $this->auth = 'eqmsLG5p7T8NsMjLRqB8x4wFAVqYo/DumDhizmF/+zQ=';
        $this->url = 'api/external/v1/' . $this->channel . '/mt/';

        $payload = [];

        $payload['productId'] = $mo->product_id;
        $payload['pricepointId'] = $mo->price_point_id;
        $payload['mcc'] = $mo->mcc;
        $payload['mnc'] = $mo->mnc;
        $payload['text'] = $mo->text;
        $payload['msisdn'] = $mo->msisdn;
        $payload['largeAccount'] = $mo->large_account;

        $payload['priority'] = 'NORMAL';
        $payload['timezone'] = 'Asia/Amman';
        $payload['context'] = 'STATELESS';
        $uuid = (string) Str::uuid();
        $headers = ['apikey' => $this->apikey, 'authentication' => $this->auth, 'external-tx-id' => $uuid];

        $re = $this->post($this->url . $mo->partner_role_id, $payload, $headers);
        $respBody = json_decode($re->getBody());
        echo '<pre>';print_r($respBody);echo '</pre>';
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
            'pricepointId' => 'required',
            'mcc' => 'required',
            'mnc' => 'required',
            'text' => 'required',
            'entryChannel' => 'required',
            'msisdn' => 'required',
            'largeAccount' => 'required',
            'transactionUUID' => 'required',
        ];
    }
}
