<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OptOutNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opt_out_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('partner_role_id', 255);
            $table->string('external_tx_id', 255)->unique()->nullable();
            $table->integer('product_id');
            $table->bigInteger('price_point_id');
            $table->string('mcc', 50);
            $table->string('mnc', 50);
            $table->string('entry_channel', 50);
            $table->string('msisdn', 50);
            $table->string('large_account', 50);
            $table->string('transaction_uuid', 50)->unique();
            $table->json('tags')->nullable();


            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opt_out_notifications');
    }
}
