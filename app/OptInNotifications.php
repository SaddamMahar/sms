<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 5/22/2020
 * Time: 3:36 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptInNotifications extends Model
{
    protected $table = 'opt_in_notifications';
    protected $casts = [
        'tags' => 'array'
    ];
    protected $fillable = [
        'partner_role_id', 'external_tx_id', 'product_id', 'price_point_id', 'mcc', 'mnc', 'text', 'entry_channel',
        'msisdn', 'large_account', 'transaction_uuid', 'user_identifier', 'user_identifier_type', 'mno_delivery_code',
        'tags'
    ];
}
