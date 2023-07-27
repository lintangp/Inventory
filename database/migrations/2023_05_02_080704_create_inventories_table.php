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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_name');
            $table->string('information')->unique();
            $table->integer('sum');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('room_id');
            $table->integer('inventory_code');
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
