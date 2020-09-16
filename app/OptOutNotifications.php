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

class OptOutNotifications extends Model
{
    protected $table = 'opt_out_notifications';
    protected $casts = [
        'tags' => 'array'
    ];
    protected $fillable = [
        'product_id', 'partner_role_id', 'external_tx_id','price_point_id', 'mcc', 'mnc', 'entry_channel',
        'msisdn', 'transaction_uuid', 'large_account', 'tags'
    ];

}
