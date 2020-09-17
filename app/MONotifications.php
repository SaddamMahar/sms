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

class MONotifications extends Model
{
    protected $table = 'mo_notifications';
    protected $casts = [
            'tags' => 'array'
        ];
    protected $fillable = [
        'partner_role_id', 'product_id', 'price_point_id', 'mcc', 'mnc', 'text', 'msisdn', 'tags', 'large_account',
        'transaction_uuid', 'external_tx_id', 'entry_channel', 'user_identifier', 'user_identifier_type',
        'mno_delivery_code'
    ];
}
