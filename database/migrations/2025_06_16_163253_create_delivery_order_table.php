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
        Schema::create('delivery_order', function (Blueprint $table) {
            $table->id();
            $table->string('no_do');
            $table->string('no_ref');
            $table->string('pembeli_id');
            $table->date('date');
            $table->string('pt_penerima')->nullable();
            $table->string('alamat')->nullable();
            $table->string('product')->nullable();
            $table->string('description')->nullable();
            $table->string('qty')->nullable();
            $table->string('total_qty')->nullable();
            $table->string('franco')->nullable();
            $table->string('waranty')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_signature')->nullable();
            $table->string('best_regards')->nullable();
            $table->string('best_regards_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_order');
    }
};
