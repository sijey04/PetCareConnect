<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->string('image');
            $table->decimal('rating', 2, 1)->default(0.0);
            $table->string('address');
            $table->text('description')->nullable();
            $table->string('tin');
            $table->enum('vat_status', ['registered', 'non_registered']);
            $table->string('bir_certificate');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shops');
    }
}; 