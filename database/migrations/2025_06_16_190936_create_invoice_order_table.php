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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice');
            $table->string('no_ref');
            $table->string('pembeli_id');
            $table->date('date');
            $table->date('due_date');
            $table->string('pt_penerima');
            $table->string('alamat');
            $table->string('product');
            $table->string('description');
            $table->string('qty');
            $table->string('price');
            $table->string('total');
            $table->string('dpp');
            $table->string('vat');
            $table->string('grand_total');
            $table->string('bank_account');
            $table->string('bank_name');
            $table->date('date_kirim');
            $table->string('best_regards');
            $table->string('best_regards_signature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
