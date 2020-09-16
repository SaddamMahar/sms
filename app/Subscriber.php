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

class Subscriber extends Model
{
    protected $table = 'subscribers';
    protected $casts = [
        'tags' => 'array'
    ];

    protected $fillable = [
        'msisdn', 'product_id', 'price_point_id', 'mcc', 'text', 'subscribe_date', 'unsubscribe_date', 'status'
    ];

}
