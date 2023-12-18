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
        Schema::create('role_operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("role_id");
                $table->foreign("role_id")->on("roles")->references("id");
            $table->unsignedBigInteger("operation_id");
                $table->foreign("operation_id")->on("operations")->references("id");
            $table->string("access_level");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_operations');
    }
};
