<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Services extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id', 60)->unique()->nullable();
            $table->string('service_name')->nullable();
            $table->string('service_name_eng')->nullable();
            $table->string('short_code')->nullable();
            $table->string('description')->nullable();
            $table->string('price_point_per_frequency')->nullable();
            $table->string('micro_charging1_frequency')->nullable();
            $table->string('micro_charging2_frequency')->nullable();
            $table->string('sub_keyword')->nullable();
            $table->string('unsub_keyword')->nullable();
            $table->string('service_urls')->nullable();
            $table->string('is_it_free')->nullable();

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        // Insert some stuff
            DB::table('services')->insert([
                array(
                    'product_id' => '13659',
                    'service_name' => 'لا تحكيها لحواء (don’t say it to eva)',
                    'service_name_eng' => 'don’t say it to eva',
                    'short_code' => '95910',
                    'description' => 'هناك امور من الضروري يصرح بها الرجل لحواء وامور لا يجب ان يقولها ابدا وتتيح هذه الخدمة ان تعرفك على الامور التي لا يجب ان تقولها لحواء ',
                    'price_point_per_frequency' => '0.2/day',
                    'micro_charging1_frequency' => '0.1/day',
                    'micro_charging2_frequency' => '0.05/day',
                    'sub_keyword' => 'sub 1 to 95910',
                    'unsub_keyword' => 'unsub 1',
                    'service_urls' => '',
                    'is_it_free' => 'FREE MO',
                ),array(
                    'product_id' => '13660',
                    'service_name' => 'الجمال Beauty',
                    'service_name_eng' => 'Beauty',
                    'short_code' => '95910',
                    'description' => 'الجمال يأسر القلوب وله اهمية كبيره في حياتنا ولكن ايضا لديه اسرار يجب علينا معرفتها للمحافظه على هذا الجمال وتتيح لك هذه الخدمه معرفه هذه الاسرار وتقدم لك النصائح لجمالك ',
                    'price_point_per_frequency' => '0.2/day',
                    'micro_charging1_frequency' => '0.1/day',
                    'micro_charging2_frequency' => '0.05/day',
                    'sub_keyword' => 'sub 2 to 95910',
                    'unsub_keyword' => 'unsub 2',
                    'service_urls' => '',
                    'is_it_free' => 'FREE MO',
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
        Schema::dropIfExists('services');
    }
}
