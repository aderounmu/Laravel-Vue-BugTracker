<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useables', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            /*$table->unsignedBigInteger('useable_id');
            $table->string('useable_type');*/
            $table->morphs('useable');
            $table->boolean('Admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('useable');
    }
}
