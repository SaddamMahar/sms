<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 5/22/2020
 * Time: 2:17 AM
 */

namespace App\Http\Controllers;


use App\RenewalNotifications;
use App\MAProductDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class RenewalNotificationController extends Controller
{


    public function createRenewalNotification(Request $request, $partnerRole)
    {
        $params = $request->all();

        $exTxId = $request->header('external-tx-id');
        $params['externalTxId'] = $exTxId;

        $validator = Validator::make($params, $this->RenewalNotificationRules());
        if ($validator->passes()) {

            $mo = new RenewalNotifications();

            $mo->partner_role_id = $partnerRole;
            $mo->external_tx_id = $exTxId;
            if (!isset($exTxId)) {
                $mo->external_tx_id = (string)Str::uuid();
                $exTxId = $mo->external_tx_id;
            }

            $this->modelFromParams($mo, $params);

            try {
                $productDetails = MAProductDetails::where('product_id', '=', $params['productId'])->first();
                if (!isset($productDetails)) {
                    return response()->custom(new \stdClass(), 'INVALID_PRODUCT_ID', true, $exTxId, 'Failed', '500');
                }

                $res = $this->validateProductDetails($productDetails, $mo);
                if ($res !== null) {
                    return response()->custom(new \stdClass(), $res, true, $exTxId, 'Failed', '500');
                }

                $mo->save();
            } catch (\Exception $e) {
                return response()->custom(new \stdClass(), $e->getMessage(), true, $exTxId, 'Failed', '500');
            }
            return response()->custom(new \stdClass(), '', false, $exTxId, 'SUCCESS', '200');
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

    public function RenewalNotificationRules()
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

        if (isset($params->large_account) && $params->large_account !== $productDetails['large_account']) {
            return 'INVALID_LARGE_ACCOUNT';
        }

        return null;
    }

}
