<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 5/22/2020
 * Time: 2:17 AM
 */

namespace App\Http\Controllers;


use App\Http\OptOutNotificationDTO;
use App\OptOutNotifications;
use App\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class OptOutNotificationController extends Controller
{


    public function createOptOutNotification(Request $request, $partnerRole)
    {
        $params = $request->all();

        $exTxId = $request->header('external-tx-id');
        $params['externalTxId'] = $exTxId;

        $validator = Validator::make($params, $this->OptOutRules());
        if ($validator->passes()) {

            $mo = new OptOutNotifications();

            $mo->partner_role_id = $partnerRole;
            $mo->external_tx_id = $exTxId;
            if (!isset($exTxId)) {
                $mo->external_tx_id = (string)Str::uuid();
                $exTxId = '';
            }

            $this->modelFromParams($mo, $params);

            try {
                $mo->save();

                $mytime = Carbon::now();

                $subscriber = Subscriber::where('msisdn', $mo->msisdn)->first();

                $subscriber->unsubscribe_date = $mytime->toDateTimeString();
                $subscriber->status = 0;

                $subscriber->save();
            } catch (\Exception $e) {
                return response()->custom($params, $e->getMessage(), true, $exTxId, '500');
            }
            $dto = new OptOutNotificationDTO($mo);
            return response()->custom($dto, 'Saved', false, $exTxId, '201');

        } else {

            return response()->custom($params, $validator->errors()->all(), true, $exTxId, '500');
        }
    }

    public function OptOutRules()
    {
        return [
            'productId' => 'required',
            'mcc' => 'required',
            'mnc' => 'required',
            'msisdn' => 'required',
            'transactionUUID' => 'required',
        ];
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

}
