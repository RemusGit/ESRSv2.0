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
        Schema::create('category_tab_2', function (Blueprint $table) {
            $table->integer('category_id')->primary()->autoIncrement();
            $table->string('category_value');
            $table->string('main_category');
            $table->integer('agentunit_id');
            $table->integer('repairtype_id');
            $table->string('category_icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_tab_2');
    }
};
