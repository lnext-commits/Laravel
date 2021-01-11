<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutgoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outgo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('outgo_name', 150);
            $table->unsignedBigInteger('art_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('art_id')
                ->references('id')
                ->on('art');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outgo', function (Blueprint $table) {
            if (Schema::hasColumn('outgo','user_id')) {
                $table->dropForeign(['user_id']);
            }
            if (Schema::hasColumn('outgo','art_id')) {
                $table->dropForeign(['art_id']);
            }

        });
        Schema::dropIfExists('outgo');
    }
}
