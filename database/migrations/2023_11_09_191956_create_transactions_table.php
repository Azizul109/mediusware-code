<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing bigint
            $table->unsignedBigInteger('user_id');
            $table->enum('transaction_type', ['deposit', 'withdrawal']); // Enum for transaction type
            $table->double('amount');
            $table->decimal('fee', 8, 2)->default(0); // Decimal for fee with 8 digits in total, 2 after the decimal point
            $table->date('date');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
