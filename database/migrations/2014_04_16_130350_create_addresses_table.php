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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string("street");
            $table->string("area");
            $table->string("city");
            $table->string("state")->default("KPK");
            $table->string("country")->default("Pakistan");
            $table->string("mobile");
            $table->string("phone")->nullable();
            $table->decimal("latitude", 16, 8)->nullable();
            $table->decimal("longitude", 16, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
