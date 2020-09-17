<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mo_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('partner_role_id', 255)->nullable();
            $table->string('external_tx_id', 255)->unique();
            $table->integer('product_id')->nullable();
            $table->bigInteger('price_point_id')->nullable();
            $table->string('mcc', 50)->nullable();
            $table->string('mnc', 50)->nullable();
            $table->string('text', 50)->nullable();
            $table->string('msisdn', 50)->nullable();
            $table->string('large_account', 50)->nullable();
            $table->string('transaction_uuid', 50)->unique()->nullable();
            $table->json('tags')->nullable();

            $table->string('entry_channel', 50)->nullable();
            $table->string('user_identifier', 50)->nullable();
            $table->string('user_identifier_type', 50)->nullable();
            $table->string('mno_delivery_code', 50)->nullable();


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
        Schema::dropIfExists('mo_notifications');
    }
}
