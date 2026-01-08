<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actiontaken_tab_2', function (Blueprint $table) {
            $table->integer('action_id')->primary()->autoIncrement();
            $table->string('request_refid');
            $table->text('action_taken')->nullable();
            $table->dateTime('action_datetime')->nullable();
            $table->tinyInteger('deleted');
            $table->dateTime('deleted_datetime')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actiontaken_tab_2');
    }
};
