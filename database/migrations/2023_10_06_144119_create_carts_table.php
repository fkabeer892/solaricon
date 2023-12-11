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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
                $table->foreign("user_id")->on("users")->references("id");
            $table->decimal("discount", 10, 2);
            $table->decimal("total", 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("carts", function (Blueprint $table){
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('carts');
    }
};
