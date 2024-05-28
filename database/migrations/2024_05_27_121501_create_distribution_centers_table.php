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
        Schema::create('distribution_centers', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name_ar')->unique();
            $table->string('name_en')->unique();
            $table->foreignId('state_id')
                  ->constrained('states')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->string('street_address_ar');
            $table->string('street_address_en');
            $table->foreignId('warehouse_id')
                  ->constrained('warehouses')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribution_centers');
    }
};
