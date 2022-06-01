<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDueDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('due_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('due_id')->constrained('dues')->onDelete('cascade');
            $table->unsignedInteger('amount');
            $table->tinyInteger('due_type');
            $table->string('details')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('due_details');
    }
}
