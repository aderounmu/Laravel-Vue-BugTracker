<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugs', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();
            $table->text('Title');
            $table->longText('Description');
            $table->text('Category');
            $table->enum('Priority',array('Closed','Open','Processing'));
            $table->text('Sprint')->nullable();
            $table->text('Version')->nullable();
            $table->text('Environment')->nullable();
            $table->text('Components')->nullable();
            $table->text('Labels')->nullable();
 
            //foreign keys
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('created_by');

            //index
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bugs');
    }
}
