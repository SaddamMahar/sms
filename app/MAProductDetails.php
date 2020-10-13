<?php
/**
 * Developed by Saddam Hussain.
 * Email: engrsaddammahar@gmail.com
 * Autour: Saddam Hussain
 * Date: 10/9/2020
 * Time: 12:28 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class MAProductDetails extends Model
{
    protected $table = 'ma_product_details';

    protected $casts = [
        'tags' => 'array'
    ];

    protected $fillable = [
        'product_id', 'product_name', 'partner_role_id', 'service_id', 'large_account',
        'mt_price_point_id', 'mcc', 'mnc', 'mo_price_point_id', 'billing_price_point_id'
    ];
}
