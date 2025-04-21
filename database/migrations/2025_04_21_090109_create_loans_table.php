<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    public function up()
{
    Schema::create('loans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->date('borrow_date');
        $table->date('return_date')->nullable(); // Tanggal pengembalian
        $table->enum('status', ['borrowed', 'returned'])->default('borrowed');
        $table->integer('fine')->default(0); // Denda (jika terlambat)
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
