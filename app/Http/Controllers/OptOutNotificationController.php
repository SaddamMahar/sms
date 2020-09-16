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
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

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
            $mo->product_id = $params['productId'];
            $mo->price_point_id = $params['pricepointId'];
            $mo->mcc = $params['mcc'];
            $mo->mnc = $params['mnc'];
            $mo->msisdn = $params['msisdn'];
            $mo->entry_channel = $params['entryChannel'];
            $mo->msisdn = $params['msisdn'];
            $mo->tags = $params['tags'];
            $mo->large_account = $params['largeAccount'];
            $mo->transaction_uuid = $params['transactionUUID'];
            $mo->external_tx_id = $exTxId;
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
            'pricepointId' => 'required',
            'mcc' => 'required',
            'mnc' => 'required',
            'entryChannel' => 'required',
            'msisdn' => 'required',
            'largeAccount' => 'required',
            'transactionUUID' => 'required',
            'tags' => 'required',
        ];
    }

}
