<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DoNotSayItToEva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('do_not_say_it_to_eva', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text')->nullable();

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });


        // Insert some stuff
            DB::table('do_not_say_it_to_eva')->insert([
                array(
                    'text' => 'إذا وجدت أن زوجتك مكروبة فيمكنك أن تحاول تعديل مزاجها بمزحة طريفة على جبينها أو تذكيرها بأحد المواقف الرومانسية التي جمعتكما من قبل'
                ),array(
                    'text' => '‬كن مرحا بشوشا ‬له قلب ‬وازرع المرح زرعا في ‬المنزل ‬ولتكن خفيف الظل والروح والدعابة المقبولة المبنية على الفهم والعقل والمحبة‬'
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
        Schema::dropIfExists('do_not_say_it_to_eva');
    }
}
