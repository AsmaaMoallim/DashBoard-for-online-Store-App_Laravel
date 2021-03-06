<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdHasMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_has_media', function (Blueprint $table) {
            $table->foreignId('prod_id')
                ->references('prod_id')
                ->on('product')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('medl_id')
                ->references('medl_id')
                ->on('media_library')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('fakeId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod_has_media');
    }
}
