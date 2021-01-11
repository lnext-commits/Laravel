<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('art_id');
            $table->unsignedBigInteger('outgo_id');
            $table->integer('cash');
            $table->tinyInteger('run');
            $table->date('d')->nullable();  // $table->dateTime('d')->useCurrent();
            $table->string('comment',255)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('art_id')
                ->references('id')
                ->on('art');

            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices');

            $table->foreign('outgo_id')
                ->references('id')
                ->on('outgo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main', function (Blueprint $table) {
            if (Schema::hasColumn('main','user_id')) {
                $table->dropForeign(['user_id']);
            }
            if (Schema::hasColumn('main','art_id')) {
                $table->dropForeign(['art_id']);
            }
            if (Schema::hasColumn('main','invoice_id')) {
                $table->dropForeign(['invoice_id']);
            }
            if (Schema::hasColumn('main','outgo_id')) {
                $table->dropForeign(['outgo_id']);
            }

        });
        Schema::dropIfExists('main');
    }
}
