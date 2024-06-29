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
        Schema::create('delivered_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordered_product_id')
                ->constrained('ordered_products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
                $table->date('expirationdate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivered_products');
    }
};
