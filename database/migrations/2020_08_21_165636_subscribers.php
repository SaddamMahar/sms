<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subscribers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('msisdn', 60);
            $table->string('shortcode', 60)->nullable();
            $table->string('product_id', 60);
            $table->string('price_point_id', 60);
            $table->string('mcc', 60);
            $table->string('text', 255);
            $table->timestamp('subscribe_date');
            $table->timestamp('unsubscribe_date')->nullable();
            $table->boolean('status')->default(0);

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
        Schema::dropIfExists('subscribers');
    }
}
