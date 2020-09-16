<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 5/22/2020
 * Time: 2:17 AM
 */

namespace App\Http\Controllers;


use App\Http\MTNotificationDTO;
use App\MTNotifications;
use Illuminate\Http\Request;
use Validator;

class MTNotificationController extends Controller
{


    public function createMTNotification(Request $request, $partnerRole)
    {
        $params = $request->all();
        $exTxId = $request->header('external-tx-id');
        $params['externalTxId'] = $exTxId;
        $validator = Validator::make($params, $this->MORules());
        if ($validator->passes()) {

            $mo = new MTNotifications();

            $mo->partner_role_id = $partnerRole;
            $mo->product_id = $params['productId'];
            $mo->price_point_id = $params['pricepointId'];
            $mo->mcc = $params['mcc'];
            $mo->mnc = $params['mnc'];
            $mo->transaction_uuid = $params['transactionUUID'];
            $mo->user_identifier = $params['userIdentifier'];
            $mo->large_account = $params['largeAccount'];
            $mo->mno_delivery_code = $params['mnoDeliveryCode'];
            $mo->tags = $params['tags'];
            $mo->external_tx_id = $exTxId;
            try {
                $mo->save();
            } catch (\Exception $e) {
                return response()->custom($params, $e->getMessage(), true, $exTxId, '500');
            }
            $dto = new MTNotificationDTO($mo);
            return response()->custom($dto, 'Saved', false, $exTxId, '201');

        } else {

            return response()->custom($params, $validator->errors()->all(), true, $exTxId, '500');
        }
    }

    public function MORules()
    {
        return [
            'productId' => 'required',
            'pricepointId' => 'required',
            'mcc' => 'required',
            'mnc' => 'required',
            'transactionUUID' => 'required',
            'userIdentifier' => 'required',
            'largeAccount' => 'required',
            'mnoDeliveryCode' => 'required',
            'tags' => 'required',
        ];
    }

}
