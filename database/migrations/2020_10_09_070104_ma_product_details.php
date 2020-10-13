<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MaProductDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ma_product_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id', 60)->unique()->nullable();
            $table->string('product_name')->nullable();
            $table->string('partner_role_id')->nullable();
            $table->string('service_id')->nullable();
            $table->string('large_account')->nullable();
            $table->string('mt_price_point_id')->nullable();
            $table->string('mcc')->nullable();
            $table->string('mnc')->nullable();
            $table->string('mo_price_point_id')->nullable();
            $table->string('billing_price_point_id')->nullable();

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        // Insert some stuff
        DB::table('ma_product_details')->insert([
                array(
                    'product_id' => '13659',
                    'product_name' => 'don’t say it to eva',
                    'partner_role_id' => '3403',
                    'service_id' => '3168',
                    'large_account' => '95910',
                    'mt_price_point_id' => '49919',
                    'mcc' => '416',
                    'mnc' => '03',
                    'mo_price_point_id' => '49920',
                    'billing_price_point_id' => '49921',
                ), array(
                    'product_id' => '13660',
                    'product_name' => 'Beauty',
                    'partner_role_id' => '3403',
                    'service_id' => '3168',
                    'large_account' => '95910',
                    'mt_price_point_id' => '49919',
                    'mcc' => '416',
                    'mnc' => '03',
                    'mo_price_point_id' => '49920',
                    'billing_price_point_id' => '49921',
                )]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ma_product_details');
    }
}
